<?php

namespace Onu\Gitblog\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use http\Message\Body;
use Onu\Gitblog\Models\Comment;
use Onu\Gitblog\Models\CommentReply;
use Onu\Gitblog\Models\LockArticle;
use Onu\Gitblog\Models\Post;
use Onu\Gitblog\Models\PostComment;
use Onu\Gitblog\Models\SavedArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Onu\Gitblog\Models\PostResponseEdit;
use Onu\Gitblog\Models\PostResponseVote;
use Onu\Gitblog\Helpers\helper;
use Onu\Gitblog\Models\PostVote;
use Onu\Gitblog\Models\UserVote;
use Symfony\Component\Console\Helper\Table;


class GitblogApiResponseController extends Controller
{

       public function test() {

//           if(!$user= auth()->user()){
//               return response()->json(['error' => 'Access Denied']);
//
//           }
//           $token =auth('api')->login($user);
//           return $token;
           $query= DB::table('post_comments')
               ->where('post_id',4)
               ->leftjoin('comments', 'post_comments.comment_id', '=', 'comments.id')
               ->leftjoin('users','post_comments.user_id','=','users.id')
               ->leftjoin(DB::raw('(SELECT comment_id,COUNT(*) AS cnt FROM comment_replies GROUP BY comment_id) X'),function ( $join )
               {
                   $join->on('X.comment_id','=','post_comments.comment_id');
               }
               )
               ->select('body','name','post_comments.comment_id',DB::raw('COALESCE(X.cnt, 0) AS replies'))
               ->simplePaginate(5);
//           SELECT
//    `body`,
//    `name`,
//    COALESCE(X.cnt, 0) AS replies,
//    post_comments.comment_id
//FROM
//    `post_comments`
//LEFT JOIN `comments` ON `post_comments`.`comment_id` = `comments`.`id`
//LEFT JOIN `users` ON `post_comments`.`user_id` = `users`.`id`
//LEFT JOIN(
//               SELECT
//        comment_id,
//        COUNT(*) AS cnt
//    FROM
//        `comment_replies`
//    GROUP BY
//        `comment_id`
//) X
//ON
//    `post_comments`.`comment_id` = X.comment_id
//WHERE
//    `post_id` = 4
//LIMIT 6 OFFSET 1

           return $query;
       }
        public function getInfo($post_id){
           $user_id=Auth::id();
           $pull = $this->getPullCount($post_id);
           $vote_status=$this->getVoteStatus($user_id,$post_id);
           $vote=$this->getVoteCount($post_id);
           $view=$this->getViewCount($post_id);
           $edit=$this->getEditCount($post_id);
           $save=$this->getSavedStatus($post_id,$user_id);
           $lock=$this->getLockStatus($post_id);
           $edit_lists=$this->getEditsList($post_id);
           $edit_lists_obj=helper::editResponseProcess($edit_lists);

           return response()->json(['vote' => $vote,
                                    'vote_status'=>$vote_status,
                                    'pull'=>$pull,
                                    'view'=>$view,
                                    'save'=>$save,
                                    'edit'=>$edit,
                                    'secure'=>$lock,
                                    'edit_lists'=>$edit_lists_obj
           ]);
       }
        public function readComments($post_id){
            $comments=$this->getComments($post_id);
            return response()->json([
                'comments'=>$comments
            ]);
        }
        public function postVoteResponse(Request $request) {
           PostResponseVote::create([
               'user_id' => Auth::id(),
               'post_id'=>$request->post_id,
               'start' => $request->start,
               'end'=>$request->end,
               'vote'=>$request->vote,
           ]);
           return response()->json(['success' => 'OK']);
       }
        public function postEditResponse(Request $request) {
           PostResponseEdit::create([
               'user_id' => Auth::id(),
               'post_id'=>$request->post_id,
               'start' => $request->start,
               'end'=>$request->end,
               'body'=>$request->body,
               'ref'=>$request->ref,
           ]);
           return response()->json(['success' => 'OK']);
       }
        public function voteContributionArticle(Request $request) {

            return response()->json(['success' => 'OK']);
        }
        public function voteOriginalArticle(Request $request) {
           if($request->vote==1){
               return $this->addVote($request->post_id);

           }else{
              return $this->deleteVote($request->post_id);
           }
        }
        public function viewsOriginalArticle(Request $request) {
           DB::table('post_views')->increment('views',1);
           return response()->json(['success' => 'OK']);
        }
        public function savedOriginalArticle(Request $request) {
            if($request->command==1){
                return $this->addSaveArticle($request->post_id);
            }else{
                return $this->deleteSaveArticle($request->post_id);
            }
        }
        public function secureOriginalArticle(Request $request){
            $post=Post::find($request->post_id)->first();

            if($post->user_id==Auth::id()){
                if($request->command==1){
                    return $this->lockArticle($request->post_id);
                }else{
                    return $this->unlockArticle($request->post_id);
                }
            }else{
                return response()->json(['success' => $request]);
            }
        }
        public function viewsContributionArticle(Request $request) {
            return response()->json(['success' => 'OK']);
        }
        public function addCommentArticle(Request $request){
            $comment=Comment::create([
                'body'=>$request->body
            ]);
            PostComment::create([
                'post_id'=>$request->post_id,
                'user_id'=>Auth::id(),
                'comment_id'=>$comment->id
            ]);
            return response()->json(['success' => 'Comment OK']);
        }
        public function  addCommentReply(Request $request){
            $comment=Comment::create([
                'body'=>$request->body
            ]);
            CommentReply::create([
                'user_id'=>Auth::id(),
                'comment_id'=>$request->comment_id,
                'reply_id'=>$comment->id
            ]);
            return response()->json(['success' => 'Comment OK']);
        }
        public function readReplies($comment_id){
            $replies=$this->getReplies($comment_id);
            return response()->json([
                'replies'=>$replies
            ]);
        }
        /**
         private methods section
         **/
        private function addVote($post_id){
           UserVote::create([
               'user_id'=>Auth::id(),
               'post_id'=> $post_id
           ]);
           $this->updateVote(1,$post_id);
           return response()->json(['success' => 'Vote Updated']);
        }
        private function deleteVote($post_id){
            DB::table('user_votes')->where('user_id',Auth::id())->where('post_id',$post_id)->delete();
            $this->updateVote(-1,$post_id);
            return response()->json(['success' => 'Unvoted']);
        }
        private function updateVote($val,$post_id){
            if($val==1){
                DB::table('post_votes')->where('post_id',$post_id)->increment('vote',1);
            }else{
                DB::table('post_votes')->where('post_id',$post_id)->decrement('vote',1);

            }
        }
        private function addSaveArticle($post_id)
        {
            SavedArticle::create([
                'post_id'=>$post_id,
                'user_id'=>Auth::id()
            ]);
            return response()->json(['success' => 'Bookmarked']);
        }
        private function deleteSaveArticle($post_id)
        {
            DB::table('saved_articles')->where('post_id',$post_id)->where('user_id',Auth::id())->delete();
            return response()->json(['success' => 'Bookmark Removed']);
        }
        private function unlockArticle($post_id)
        {
            DB::table('lock_articles')->where('post_id',$post_id)->delete();
            return response()->json(['success' => 'Unlocked']);
        }
        private function lockArticle($post_id)
        {
            LockArticle::create([
                'post_id'=>$post_id
            ]);
            return response()->json(['success' => 'Locked']);
        }
        private function getPullCount($post_id)
        {
        DB::table('contributions')
            ->Join('primary_contributions', 'contributions.id', '=', 'primary_contributions.contribution_id')
            ->select('contributions.*')
            ->where('primary_contributions.post_id','=',$post_id)
            ->count();
        }
        private function getVoteStatus($user_id, $post_id)
        {
            if(UserVote::where('user_id',$user_id)->where('post_id',$post_id)->exists()) {
                return true;
            }else{
                return false;
            }
        }
        private function getVoteCount($post_id)
        {
            if(!$votes=DB::select("SELECT vote FROM post_votes WHERE post_id=".$post_id)){
                return 0;
            }else{
                return $votes[0]->vote;
            }
        }
        private function getViewCount($post_id)
        {
            if(!$views=DB::select("SELECT views FROM post_views WHERE post_id=".$post_id)){
                return 0;
            }else{
                return $views[0]->views;
            }
        }
        private function getEditCount($post_id)
        {
            if(!$edits=DB::select("SELECT count(post_id) AS cnt FROM `post_response_edits` WHERE post_id=".$post_id)){
                return 0;
            }else{
                return $edits[0]->cnt;
            }
        }
        private function getSavedStatus($post_id,$user_id)
        {
            if(DB::table('saved_articles')->where('post_id',$post_id)->where('user_id',$user_id)->exists()){
                return true;
            }else{
                return false;
            }
        }
        private function getLockStatus($post_id)
        {
            if(DB::table('lock_articles')->where('post_id',$post_id)->exists()){
                return true;
            }else{
                return false;
            }
        }
        private function getEditsList($post_id)
        {
           return DB::table('post_response_edits')->where('post_id',$post_id)->orderBy('start', 'ASC')->get();
        }
        private function getComments($post_id)
        {
            return DB::table('post_comments')
                ->where('post_id',$post_id)
                ->join('comments', 'post_comments.comment_id', '=', 'comments.id')
                ->join('users','post_comments.user_id','=','users.id')
                ->leftjoin(DB::raw('(SELECT comment_id,COUNT(*) AS cnt FROM comment_replies GROUP BY comment_id) X'),function ( $join )
                {
                    $join->on('X.comment_id','=','post_comments.comment_id');
                }
                )
                ->select('body','name','post_comments.comment_id',DB::raw('COALESCE(X.cnt, 0) AS replies'))
                ->simplePaginate(15);
        }
        private function getReplies($comment_id)
        {
           return DB::table('comment_replies')
                ->where('comment_id',$comment_id)
                ->leftjoin('comments','comments.id','=','comment_replies.reply_id')
                ->leftjoin('users','users.id','=','comment_replies.user_id')
                ->select('comments.body','users.name')
                ->simplePaginate(15);
        }
}
