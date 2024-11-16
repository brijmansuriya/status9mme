<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Services\PostServices;

class PostController extends Controller
{

    public function __construct(private PostServices $postServices)
    {
    }

    public function index(){
       //return Post::active()->get();
    }
  
}
