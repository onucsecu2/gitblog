<?php
namespace Onu\Gitblog\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Onu\Gitblog\Helpers\helper;
use Onu\Gitblog\Models\Contribution;
use Onu\Gitblog\Models\SecondaryContribution;

class GitblogSecondaryContributionController extends Controller
{

    public function getAllRequestedContributions($id) {
        $posts=SecondaryContribution::where('contribution_for_id',$id)->paginate(10);
        return view('Gitblog::secondaryContribution.showAllContributions',['posts'=>$posts,'id'=>$id]);
    }
    public function showContribution($id){
        $post = Contribution::where('id', $id)->firstOrFail();
        return view('Gitblog::secondaryContribution.contributionDetails',['post'=>$post]);
    }
    public function setContribution($id) {

        $posts = DB::table('contributions')
            ->Join('secondary_contributions', 'contributions.id', '=', 'secondary_contributions.contribution_for_id')
            ->select('contributions.*')
            ->where('secondary_contributions.contribution_for_id','=',$id)
            ->where('contributions.user_id','=',Auth::id())
            ->first();

        if($posts==null){
            $posts=Contribution::find($id);
        }
        $posts->body=helper::articleReverseSuggestion($posts->body);

        return view('Gitblog::secondaryContribution.writeContribution',['post'=>$posts]);
    }

    public function sendContributionRequest(Request $request) {
        $article=helper::articleSuggestion($request->article);
        $contribution=Contribution::create([
            'user_id' => Auth::id(),
            'body' => $article,
            'status' => 'PENDING',
        ]);
        SecondaryContribution::create([
            'contribution_for_id'=> $request->id,
            'contribution_id' => $contribution->id,
        ]);

        return  redirect('/home');
    }
}
