<?php


namespace Onu\Gitblog\Helpers;
use Illuminate\Support\Str;
use Onu\Gitblog\Models\Post;

class helper
{
    public static function createSlug($title,$id)
    {

        $slug=self::make_slug($title);
        $post = Post::where('slug',$slug)->first();
        if($post){
            $slug=$slug."-".$id;
        }
        return $slug;
    }

    public static function make_slug($string) {
        return preg_replace('/\s+/u', '-', trim($string));
    }
    public static function editResponseProcess($edit_lists){
        $edit_obj=[];
        for($i=0;$i<sizeof($edit_lists);$i++){
            if(!isset($edit_obj[strval($edit_lists[$i]->start).strval($edit_lists[$i]->end)][$edit_lists[$i]->body])) {
                $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][] = $edit_lists[$i]->start;
                $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][] = $edit_lists[$i]->end;
                $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][] = $edit_lists[$i]->user_id;
                $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][3] = 1;
            }else{
                $edit_obj[strval($edit_lists[$i]->start) . strval($edit_lists[$i]->end)][$edit_lists[$i]->body][3] ++;
            }
        }
        return $edit_obj;
    }

    public static function articleSuggestion($article){
        $count=0;
        while(strpos($article,"+++")!== false){
            $count++;
            if($count%2==1){
                $article=str_replace("+++","<suggest>",$article);
            }else{
                $article=str_replace("+++","</suggest>",$article);
            }
        }
        $count=0;
        while(strpos($article,"---")!== false){
            $count++;
            if($count%2==1){
                $article=str_replace("---","<remove>",$article);
            }else{
                $article=str_replace("---","</remove>",$article);
            }
        }
        return $article;
    }
    public static function articleReverseSuggestion($article){
        $count=0;
        while(strpos($article,"<suggest>")!== false){
            $count++;
            if($count%2==1){
                $article=str_replace("<suggest>","+++",$article);
            }else{
                $article=str_replace("</suggest>","+++",$article);
            }
        }
        $count=0;
        while(strpos($article,"<remove>")!== false){
            $count++;
            if($count%2==1){
                $article=str_replace("<remove>","---",$article);
            }else{
                $article=str_replace("</remove>","---",$article);
            }
        }
        return $article;
    }
}

