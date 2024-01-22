<?php

namespace App\Http\Controllers\Admin\Explorer;

use App\Models\Post;
use App\Models\Explorer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\ExplorerDataTable;
use App\Http\Requests\Admin\Explorer\CreateExplorerRequest;
use App\Http\Requests\Admin\Explorer\UpdateExplorerRequest;

class ExplorerController extends Controller
{
    public function index(ExplorerDataTable $dataTable)
    {
        return $dataTable->render('admin.explorer.index');
    }

    public function create()
    {
        $post = Post::available()->get();
        return view('admin.explorer.create', compact('post'));
    }

    public function store(CreateExplorerRequest $request)
    {
        $input = $request->all();
        $input['slug'] = Str::slug($input['title']);

        // Check if the slug is unique
        $isUniqueSlug = $this->isUniqueSlug($input['slug']);
        if (!$isUniqueSlug) {
            // Handle the case where the slug is not unique, maybe add a suffix or handle it in your way
            $input['slug'] = $this->makeUniqueSlug($input['slug']);
        }
        $explorer = Explorer::create($input);
        //image store 
        if ($request->hasFile('image')) {
            $media = $explorer->addMediaFromRequest('image')->toMediaCollection('explorer/image');
        }

        //seo data store 
        $explorer->seo->update([
            'title' => $input['title'],
            'description' => $input['description'],
            'keyword' => $input['keywords'],
            'image' => $media->original_url,
            'author' => auth()->user()->name,
            // 'canonical_url' => url(),
        ]);

        //post exploer store  
        $explorer->posts()->sync($request->posts);

        session()->flash('success', __('messages.panel.admin.explorer.added'));
        return redirect()->route('explorer.index');
    }

    public function toggleStatus($id)
    {
        $explorer = Explorer::findOrFail($id);
        $explorer->toggleStatus();
        return redirect()->back();
    }

    public function show($id)
    {
        $explorer = Explorer::findOrFail($id);
        return view('admin.explorer.show', compact('explorer'));
    }

    public function edit($id)
    {
        $post = Post::available()->latest()->get();
        $explorer = Explorer::findOrFail($id);
        return view('admin.explorer.edit', compact('explorer', 'post'));
    }

    public function update(UpdateExplorerRequest $request, $id)
    {
        $explorer = Explorer::whereId($id)->first();
        $explorer->update([
            'name' => request()->input('name'),
        ]);

        if ($request->hasFile('image')) {
            $explorer->deleteFile();
            $explorer->addMediaFromRequest('image')->toMediaCollection('explorer/image');
        }
        session()->flash('success', __('messages.panel.admin.explorer.updated'));
        return redirect()->route('explorer.index');
    }

    public function delete($id)
    {
        $categorie = Explorer::findOrFail($id);
        $categorie->delete();
        return redirect()->back();
    }

    public function deleteAll(Request $request)
    {
        $post = Explorer::whereIn('id', $request->ids)->delete();
        return redirect()->back();
    }


    // Helper function to check if the slug is unique
    private function isUniqueSlug($slug)
    {
        return Post::where('slug', $slug)->doesntExist();
    }

    // Helper function to make the slug unique (you can customize this as needed)
    private function makeUniqueSlug($slug)
    {
        $originalSlug = $slug;
        $counter = 1;
        while (!$this->isUniqueSlug($slug)) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }
        return $slug;
    }
}
