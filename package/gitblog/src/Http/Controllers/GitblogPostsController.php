<?php
namespace Onu\Gitblog\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Onu\Gitblog\Models\ArticleEpisode;
use Onu\Gitblog\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Onu\Gitblog\Helpers\helper;
use Onu\Gitblog\Models\PostView;
use Onu\Gitblog\Models\PostVote;

class GitblogPostsController extends Controller
{
    public function post(Request $request) {
        $id=(int)DB::select("SELECT MAX(id) FROM posts;")+1;
        $slug=helper::createSlug( $request->title,$id);

        $post=Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug'=>$slug,
            'body' => $request['article'],
        ]);
        PostView::create([
            'post_id'=>$post->id,
            'views'=>0,
        ]);
        PostVote::create([
            'post_id'=>$post->id,
            'vote'=>0,
        ]);
        if($request->episode!=null){
            ArticleEpisode::create([
                'post_id'=>$request->episode,
                'episode_post_id'=>$post->id,
                'state'=>'PENDING',
            ]);
        }
        return redirect('/home');
    }
    public function createStory() {
        return view('Gitblog::create');
    }
    public function createEpisode($post_id) {
        return view('Gitblog::addEpisode',['episode_post'=>$post_id]);
    }

}
