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
    
}