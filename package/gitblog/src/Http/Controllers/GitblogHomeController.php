<?php
namespace Onu\Gitblog\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Onu\Gitblog\Models\Post;
use Onu\Gitblog\Models\PrimaryContribution;


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

        return view('Gitblog::showArticle',['post'=>$post,'token'=>$token]);
    }
    public function editPost($slug){
        $post = Post::where('slug', $slug)->firstOrFail();
        $user= auth()->user();
        $token =auth('api')->login($user);
        return view('Gitblog::editPost',['post'=>$post,'token'=>$token]);
    }
    public function test($postId){

//            $edit_lists=DB::table('post_response_edits')->where('postId',$postId)->orderBy('start', 'ASC')->get();
//            $edit_obj=[];
//            for($i=0;$i<sizeof($edit_lists);$i++){
//                if(!isset($edit_obj[strval($edit_lists[$i]->start).strval($edit_lists[$i]->end)][$edit_lists[$i]->body])) {
//                    $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][] = $edit_lists[$i]->start;
//                    $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][] = $edit_lists[$i]->end;
//                    $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][] = $edit_lists[$i]->userId;
//                    $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][3] = 1;
//                }else{
//                    $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][3] ++;
//                }
//            }
//            $edit_obj[strval($edit_lists[0]->start).strval($edit_lists[0]->end)]=52;
//            return $edit_obj;
        $posts=PrimaryContribution::where('post_id',1)->first();
        return $posts->contribution->user->name;
    }
}

