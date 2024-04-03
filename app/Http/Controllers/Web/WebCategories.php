<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use App\Models\Visit;
use App\Models\Categorie;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;

class WebCategories extends Controller
{
    public function index()
    {
        $categorys = Categorie::active()->available()->latest()->paginate(10);
        return view('web.category_list', compact('categorys'));
    }

    public function show($slug)
    {
        $posts = Post::active()
                ->whereRelation('categorie', 'slug', $slug)
                // ->withHas('categorie')
                // ->take(config('app.home-categorie'))
                ->latest()
                ->paginate(10);

        return view('web.category_post_list', compact('posts'));
    }
}
