<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use App\Models\Visit;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class WebCategories extends Controller
{
    public function index()
    {
        $categorys = Category::active()->available()->latest()->paginate(10);
        return view('web.category_list', compact('categorys'));
    }

    public function show($slug)
    {
        $posts = Post::active()
        ->withHas('category')
        ->whereRelation('category','slug',$slug)
        ->take(config('app.home-category'))
        ->latest()
        ->paginate(10);    
        return view('web.category_post_list', compact('posts'));
    }
}
