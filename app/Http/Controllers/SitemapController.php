<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{


    public function generate()
    {

        //3
        // --------------------------------------------------------------
        set_time_limit(120);

        // Initialize the sitemap
        $sitemap = Sitemap::create();

        SitemapGenerator::create(config('app.url'))
            ->hasCrawled(function (Url $url) {
                return $url->setPriority(0.9);
            })
            ->getSitemap()
            ->getTags();
        // ->each(function (Url $url) use ($sitemap) {
        //     $sitemap->add($url);
        // });

        // Add posts to the sitemap
        $posts = Post::all();
        foreach ($posts as $post) {
            $sitemap->add(
                Url::create(route('web.popularpost', $post->slug))
                    ->setPriority(0.8)
                    ->setLastModificationDate($post->updated_at)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));
        return '<h1>DONE</h1>';
        // return response()->view('sitemap.generated');    
    }
}
