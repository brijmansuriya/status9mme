<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Visit;
use App\Services\YoutubeUrlServices;

class PopularPost extends Controller
{
    //cuntrcter
    public function __construct(protected YoutubeUrlServices $youtubeUrlServices)
    {}

    //home page popular post list page
    public function allPopularPostList()
    {
        $posts = Post::orderByViews('desc')->latest()->paginate(10);

        return view('web.post_list', compact('posts'));
    }

    //singl post popular post page
    public function popularPostShow($slug)
    {

        $posts = Post::whereSlug($slug)->active()->with('categorie:id,name')->first();

        //fiend $posts->url to /shorts/

        $this->youtubeUrlServices->urlSet($posts);

        //Tranding post
        $trandings = Post::with('categorie')->active()->latest()->take(config('app.home-post'))->get();

        return view('web.post', compact('posts', 'trandings'));
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
