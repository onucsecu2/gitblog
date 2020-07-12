<?php

namespace Onu\Gitblog\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Onu\Gitblog\Models\PostResponseEdit;
use Onu\Gitblog\Models\PostResponseVote;




class GitblogApiResponseController extends Controller
{

       public function test() {

           if(!$user= auth()->user()){
               return response()->json(['error' => 'Access Denied']);

           }

           $token =auth('api')->login($user);
           return $token;
       }
       public function getInfo($postId){

           $pull= DB::table('request_contributions')->where('postId',$postId)->count();
           if(!$votes=DB::select("SELECT vote FROM post_votes WHERE postId=".$postId)){
               $vote=0;
           }else{
               $vote=$votes[0]->vote;
           }
           if(!$views=DB::select("SELECT views FROM post_views WHERE postId=".$postId)){
               $view=0;
           }else{
               $view=$views[0]->views;
           }
           if(!$edits=DB::select("SELECT count(postId) AS cnt FROM `post_response_edits` WHERE postId=".$postId)){
               $edit=0;
           }else{
               $edit=$edits[0]->cnt;
           }
           $edit_lists=DB::table('post_response_edits')->where('postId',$postId)->get();

           return response()->json(['vote' => $vote,
                                    'pull'=>$pull,
                                    'view'=>$view,
                                    'edit'=>$edit,
                                    'edit_lists'=>$edit_lists
           ]);
       }

       public function postVoteResponse(Request $request) {
           PostResponseVote::create([
               'userId' => Auth::id(),
               'postId'=>$request->postId,
               'start' => $request->start,
               'end'=>$request->end,
               'vote'=>$request->vote,
           ]);
           return response()->json(['success' => 'OK']);
       }
       public function postEditResponse(Request $request) {
           PostResponseEdit::create([
               'userId' => Auth::id(),
               'postId'=>$request->postId,
               'start' => $request->start,
               'end'=>$request->end,
               'body'=>$request->body,
               'ref'=>$request->ref,
           ]);
           return response()->json(['success' => 'OK']);
       }

}
