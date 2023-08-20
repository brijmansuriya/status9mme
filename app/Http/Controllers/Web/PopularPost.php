<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use App\Models\Visit;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class PopularPost extends Controller
{
    // public function index()
    // {
    //     $categorys = Category::active()->latest()->take(config('app.home-category'))->get();
    //     // $post = Post::active()->latest()->take(config('app.home-post'))->get();

    //     $post = Post::query();

    //     //Featured post
    //     $featureds = $post->with('category')->latest()->take(config('app.home-post'))->get();

    //     //Popular post
    //     $populars = $post->with('category')->latest()->take(config('app.home-post'))->get();

    //     //Latest post
    //     $latests = $post->with('category')->latest()->take(config('app.home-post'))->get();

    //     //Tranding post
    //     $trandings = $post->with('category')->latest()->take(config('app.home-post'))->get();

    //     return view('web.home',compact('categorys','trandings','latests','populars','featureds'));
    // }

    //home page popular post list page 
    public function allPopularPostList()
    {
        $posts = Post::popularAllTime()->latest()->paginate(10);
        return view('web.post_list',compact('posts'));
    }

    //singl post popular post page 
    public function popularPostShow($slug)
    {
        $posts = Post::whereSlug($slug)->with('category:id,name')->first();
        $posts->visit();

         //Tranding post
        $trandings = Post::with('category')->latest()->take(config('app.home-post'))->get();
        
        return view('web.post',compact('posts','trandings'));
    }

    //home page latest post list page 
    public function allLatestPostList()
    {
        $posts = Post::latest()->paginate(10);
        return view('web.post_list',compact('posts'));
    }

    //singl post latest post page 
    public function LatestPostShow($slug)
    {
        $posts = Post::whereSlug($slug)->with('category:id,name')->first();
        $posts->visit();
        //Tranding post
        $trandings = Post::with('category')->latest()->take(config('app.home-post'))->get();
        return view('web.post',compact('posts','trandings'));
    }
}