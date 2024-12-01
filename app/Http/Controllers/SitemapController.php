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

        // Crawl the entire site to gather all available URLs
        collect(
            SitemapGenerator::create(config('app.url'))
                ->hasCrawled(function (Url $url) {
                    return $url->setPriority(0.9);
                })
                ->getSitemap()
                ->getTags()
        )->each(function (Url $url) use ($sitemap) {
            $sitemap->add($url);
        });
        
        $sitemap->writeToFile(public_path('sitemap.xml'));

        return '<h1>Sitemap Generated Successfully</h1>';

        /**
         * method 2 - without using Spatie\Sitemap\SitemapGenerator
         */
        // method 2

        // Add posts to the sitemap
        // $posts = Post::all();
        // foreach ($posts as $post) {
        //     $sitemap->add(
        //         Url::create(route('web.popularpost', $post->slug))
        //             ->setPriority(1.0)
        //             ->setLastModificationDate($post->updated_at)
        //     );
        // }

        // add tools to the sitemap
        // foreach (config('app.tools') as $tool) {
        //     $sitemap->add(
        //         Url::create(route($tool['route']))
        //             ->setPriority(0.8)
        //     );
        // }

        //add about us to the sitemap
        // $sitemap->add(
        //     Url::create(route('web.aboutus'))
        //         ->setPriority(0.5)
        // );

        //add privacy policy to the sitemap
        // $sitemap->add(
        //     Url::create(route('web.privacypolicy'))
        //         ->setPriority(0.5)
        // );

        //add contact us to the sitemap
        // $sitemap->add(
        //     Url::create(route('web.contactus'))
        //         ->setPriority(0.5)
        // );

        //add dmca to the sitemap
        // $sitemap->add(
        //     Url::create(route('web.dmca'))
        //         ->setPriority(0.5)
        // );

        // end method 2 


        // return response()->view('sitemap.generated');    
    }
}
