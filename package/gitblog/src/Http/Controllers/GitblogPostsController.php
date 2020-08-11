<?php
namespace Onu\Gitblog\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
        return redirect('/home');

    }
    public function createStory() {
        return view('Gitblog::create');
    }

}
