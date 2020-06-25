<?php 
namespace  Onu\Gitblog;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
class GitBlogServiceProvider extends ServiceProvider
{
    public function boot() {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/views','Gitblog');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
       
    }
    public function register() {
        
    }
}
