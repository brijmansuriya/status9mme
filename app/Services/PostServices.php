<?php

namespace App\Services;

use App\Models\Post;

class PostServices
{
    public function getOne() {}

    public function getAll()
    {
        return Post::with('categorie')
            ->latest()
            ->active()
            ->available()
            ->orderBy('id', 'desc')
            ->paginate(config('app.home-post'));
    }
}
