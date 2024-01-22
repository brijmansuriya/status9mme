<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Tag;
use App\Models\Categorie;
use Illuminate\Support\Str;
// use App\Providers\TelescopeServiceProvider;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->bind('App\Interfaces\SmsGatewayInterface', 'App\SmsGateway\TwilioSmsGateway');
        // if ($this->app->environment('local') || $this->app->environment('development')) {
        //     $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
        //     $this->app->register(TelescopeServiceProvider::class);
        // }

        if ($this->app->environment('local')) {
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer(['web.includes.footer'], function ($view) {
            $categorys =  Categorie::has('post')->whereHas('post', function ($query) {
                $query->active();
            })->active()->latest()->take(config('app.home-categorie'))->get(['id', 'name', 'slug']);
            $view->with('categorys', $categorys);
        });

        View::composer(['web.includes.footer'], function ($view) {
            $tags = Tag::active()->latest()->take(config('app.home-categorie'))->get(['id', 'name', 'slug']);
            $view->with('tags', $tags);
        });

        Builder::macro(
            'withWhereHas',
            fn ($relation, $constraint) =>
            $this->whereHas($relation, $constraint)->with([$relation => $constraint])
        );

        Builder::macro('active', function () {
            return $this->where('status', '1');
        });

        //with and has check in 1 functional function
        Builder::macro('withHas', function ($relations) {
            return $this->with($relations)->has($relations);
        });

        //titale string limit show in blade file
        Str::macro('limit', function ($title, $limit = 20, $end = '...') {
            return Str::limit($title, $limit, $end);
        });
    }
}
