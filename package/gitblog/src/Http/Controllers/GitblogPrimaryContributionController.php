<?php

namespace Onu\Gitblog\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Onu\Gitblog\Helpers\helper;
use Onu\Gitblog\Models\Contribution;
use Onu\Gitblog\Models\Post;
use Onu\Gitblog\Models\PrimaryContribution;

class GitblogPrimaryContributionController extends Controller
{
    public function setContribution($id) {


        $posts = DB::table('contributions')
            ->Join('primary_contributions', 'contributions.id', '=', 'primary_contributions.contribution_id')
            ->select('contributions.*')
            ->where('primary_contributions.post_id','=',$id)
            ->where('contributions.user_id','=',Auth::id())
            ->first();

        if($posts==null){
            $posts=Post::find($id);
        }
        $posts->body=helper::articleReverseSuggestion($posts->body);

        return view('Gitblog::primaryContribution.writeContribution',['post'=>$posts]);
    }
    public function sendContributionRequest(Request $request) {
        $article=helper::articleSuggestion($request->article);
        $contribution=Contribution::create([
            'user_id' => Auth::id(),
            'body' => $article,
            'status' => 'PENDING',
        ]);
        PrimaryContribution::create([
            'post_id'=> $request->id,
            'contribution_id' => $contribution->id,
        ]);

        return  redirect('/home');
    }
    public function getAllRequestedContributions($id) {
        $posts=PrimaryContribution::where('post_id',$id)->paginate(10);
        return view('Gitblog::primaryContribution.showAllContributions',['posts'=>$posts,'id'=>$id]);
    }
    public function showContribution($id){
        $post = Contribution::where('id', $id)->firstOrFail();
        return view('Gitblog::primaryContribution.contributionDetails',['post'=>$post]);
    }
}
