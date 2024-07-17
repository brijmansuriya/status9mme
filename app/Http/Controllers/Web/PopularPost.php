<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Visit;
use App\Services\YoutubeUrlServices;
use InvalidArgumentException;

class PopularPost extends Controller
{
    //cuntrcter
    public function __construct(protected YoutubeUrlServices $youtubeUrlServices)
    {
    }

    //home page popular post list page
    public function allPopularPostList()
    {
        $posts = Post::orderByViews('desc')->latest()->paginate(10);

        return view('web.post_list', compact('posts'));
    }

    //singl post popular post page
    public function popularPostShow($slug)
    {

        $post = Post::whereSlug($slug)->active()->with('categorie:id,name')->first();

        //fiend $posts->url to /shorts/

        // $this->youtubeUrlServices->urlSet($post);
        
        $post->url = $this->youtubeEmbedUrl($post->url);;

        // return $post;
        //Tranding post
        $trandings = Post::with('categorie')->active()->latest()->take(config('app.home-post'))->get();

        return view('web.post', compact('post', 'trandings'));
    }

    function youtubeEmbedUrl(string $youtubeUrl): string
    {
        $videoId = preg_match('/v=([^&]+)/', $youtubeUrl, $matches) ? $matches[1] : null;
        if (!$videoId) {
            throw new InvalidArgumentException('Invalid YouTube URL format.');
        }
        return "https://www.youtube.com/embed/$videoId";
    }


    function getYoutubeEmbedUrl($url)
    {
        return  $parsedUrl = str_replace('https://www.youtube.com/watch?v=', 'https://www.youtube.com/embed/', $url);
    }
    //home page latest post list page
    public function allLatestPostList()
    {
        $posts = Post::latest()->active()->paginate(10);

        return view('web.post_list', compact('posts'));
    }

    //singl post latest post page
    public function LatestPostShow($slug)
    {
        $posts = Post::whereSlug($slug)->active()->with('categorie:id,name')->first();

        $posts->visit();

        //Tranding post
        $trandings = Post::with('categorie')->latest()->active()->take(config('app.home-post'))->get();

        return view('web.post', compact('posts', 'trandings'));
    }
}
