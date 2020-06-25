<?php
namespace Onu\Gitblog\Http\Controllers;
use App\Http\Controllers\Controller;
use Onu\Gitblog\Models\Post;
use Onu\Gitblog\Models\RequestContribution;
use Illuminate\Support\Facades\DB;



class GitblogHomeController extends Controller
{
    public function index() {
        $posts=Post::paginate(10);
        return view('Gitblog::home',['posts'=>$posts]);
    }
    public function readDetails($slug){
        $post = Post::where('slug', $slug)->firstOrFail(); 
        $pulls= DB::table('request_contributions')->where('postId',$post->id)->count();
          
        return view('Gitblog::details',['post'=>$post,'pulls'=>$pulls]);
    }
}
