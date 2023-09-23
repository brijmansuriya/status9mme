<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\AppMenuLink;
use Illuminate\Http\Request;

class WebViewController extends Controller
{
    /**
     * Provision a new web server.
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke($id)
    {
        $appLink = AppMenuLink::findOrFail($id);
        return view('webview', compact('appLink'));
    }

    public function post($id)
    {
        $post = Post::active()->findOrFail($id);
        return view('webviewpost', compact('post'));
    }
}