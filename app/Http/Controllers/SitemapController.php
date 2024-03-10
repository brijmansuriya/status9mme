<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Spatie\Sitemap\SitemapGenerator;

class SitemapController extends Controller
{


    public function generate()
    {
        // SitemapGenerator::create()
        //     ->add(route('home'))
        //     // ->add(route('posts'), now(), '0.9')
        //     // Add more routes as needed
        //     ->writeToDisk('public', 'sitemap.xml');

        //2
        //-----------------------------------------------------------
        // $sitemap = Sitemap::create();
        // // Add your dynamic routes here
        // $sitemap->add(Url::create(route('web.home'))->setPriority(1.0));
        // // Add more routes as needed
        // return $sitemap->writeToFile(public_path('sitemap.xml'));

        //3
        // --------------------------------------------------------------
        set_time_limit(120);
        SitemapGenerator::create(config('app.url'))->hasCrawled(function (Url $url) {
            return $url->setPriority(0.9);
        })->writeToFile(public_path('sitemap.xml'));
        // return response()->view('sitemap.generated');    
    }
}
