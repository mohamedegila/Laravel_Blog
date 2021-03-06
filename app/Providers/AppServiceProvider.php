<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $setting = Admin::select(
            'recent_limit',
            'popular_limit',
        )
        ->where('id', 1)->first();
        Paginator::useBootstrap();
        View::share('recent_posts', Post::orderBy('id', 'desc')->where('status', 1)->limit($setting->recent_limit)->get());
        
        View::share('popular_posts', Post::orderBy('views', 'desc')->where('status', 1)->limit($setting->popular_limit)->get());

        View::share('inactiveComments_count', Comment::where('status', 0)->count());
    }
}
