<?php
namespace Onu\Gitblog\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Onu\Gitblog\Models\Post;




class GitblogHomeController extends Controller
{

    public function index() {

        $posts=Post::paginate(10);
        return view('Gitblog::home',['posts'=>$posts]);
    }
    public function readDetails($slug){
        $post = Post::where('slug', $slug)->firstOrFail();
        $user= auth()->user();
        $token =auth('api')->login($user);

        return view('Gitblog::details',['post'=>$post,'token'=>$token]);
    }
    public function editPost($slug){
        $post = Post::where('slug', $slug)->firstOrFail();
        $user= auth()->user();
        $token =auth('api')->login($user);
        return view('Gitblog::editPost',['post'=>$post,'token'=>$token]);
    }
    public function test($postId){

//         $pulls= DB::table('request_contributions')->where('postId',$postId)->count();
//         return $pulls;
//         //$cars = array("Volvo", "BMW", "Toyota");
//         //return $cars[];
    }
}
