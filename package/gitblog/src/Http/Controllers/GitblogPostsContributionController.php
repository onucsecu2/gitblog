<?php
namespace Onu\Gitblog\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Onu\Gitblog\Models\Post;

use Illuminate\Support\Facades\DB;
use Onu\Gitblog\Models\RequestContribution;


class GitblogPostsContributionController extends Controller
{
    public function pull($id) {
        $posts=Post::find($id);
        return view('Gitblog::edit',['posts'=>$posts]);
    }
    public function pullRequest(Request $request) {  
        return RequestContribution::create([
            'userId' => Auth::id(),
            'postId'=> $request->id,
            'body' => $request['article'],
        ]);
    }
    public function allPullRequest($id) {
        $posts=RequestContribution::where('postId',$id)->paginate(10);
        return view('Gitblog::pullRequests',['posts'=>$posts]);
    }
    public function PullRequestDetails($id){
        $post = RequestContribution::where('id', $id)->firstOrFail();
//         $pulls= DB::table('request_contributions')->where('postId',$post->id)->count();
        
        return view('Gitblog::pullDetails',['post'=>$post]);
    }
}
