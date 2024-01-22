<?php

namespace App\Http\Controllers\Admin\Categorie;

use App\Models\Categorie;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use App\Models\ProviderCategory;
use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\DataTables\CategorieDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Categorie\CreateCategoryRequest;
use App\Http\Requests\Admin\Categorie\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function index(CategorieDataTable $dataTable)
    {
        return $dataTable->render('admin.categorie.index');
    }

    /**
     *  returns the create categorie page
     */
    public function create()
    {
        return view('admin.categorie.create');
    }

    /**
     *  store the categorie
     */
    public function store(CreateCategoryRequest $request)
    {
        $categorie = Categorie::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        if ($request->hasFile('image')) {
            $media = $categorie->addMediaFromRequest('image')->toMediaCollection('image');
        }

        session()->flash('success', __('messages.panel.admin.categorie.added'));
        return redirect()->route('categorie.index');
    }

    /**
     *  toggles status of the categorie
     */
    public function toggleStatus($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->toggleStatus();
        return redirect()->back();
    }

    /**
     *  returns the customer details
     */
    public function show($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categorie.show', compact('categorie'));
    }

    public function edit($id)
    {
        $categorie = Categorie::findOrFail($id);
        return view('admin.categorie.edit', compact('categorie'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $categorie = Categorie::whereId($id)->first();
        $categorie->update([
            'name' => request()->input('name'),
        ]);

        if ($request->hasFile('image')) {
            $categorie->deleteImage();
            $categorie->addMediaFromRequest('image')->toMediaCollection('image');
        }
        session()->flash('success', __('messages.panel.admin.categorie.updated'));
        return redirect()->route('categorie.index');
    }
    /**
     *  delete the categorie
     */
    public function delete($id)
    {
        $categorie = Categorie::findOrFail($id);
        $categorie->delete();
        return redirect()->back();
    }

    /**
     *  delete All the post
     */
    public function deleteAll(Request $request)
    {
        $post = Categorie::whereIn('id', $request->ids)->delete();
        return redirect()->back();
    }
}
