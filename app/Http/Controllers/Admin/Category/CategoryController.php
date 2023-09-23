<?php

namespace App\Http\Controllers\Admin\Category;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\Console;
use App\Models\ProviderCategory;
use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use App\DataTables\CategoryDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Category\CreateCategoryRequest;
use App\Http\Requests\Admin\Category\UpdateCategoryRequest;

class CategoryController extends Controller
{

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     *  returns the create category page
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     *  store the category
     */
    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        
        if ($request->hasFile('image')) {
            $media = $category->addMediaFromRequest('image')->toMediaCollection('image');
        }
      
        session()->flash('success', __('messages.panel.admin.category.added'));
        return redirect()->route('category.index');
    }

    /**
     *  toggles status of the category
     */
    public function toggleStatus($id)
    {
        $category = Category::findOrFail($id);
        $category->toggleStatus();
        return redirect()->back();
    }

    /**
     *  returns the customer details
     */
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.show', compact('category'));
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.edit', compact('category'));
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::whereId($id)->first();
        $category->update([
            'name' => request()->input('name'),
        ]);

        if ($request->hasFile('image')) {
            $category->deleteImage();
            $category->addMediaFromRequest('image')->toMediaCollection('image');
        }
        session()->flash('success', __('messages.panel.admin.category.updated'));
        return redirect()->route('category.index');
    }
    /**
     *  delete the category
     */
    public function delete($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back();
    }

     /**
     *  delete All the post
     */
    public function deleteAll(Request $request)
    {
        $post = Category::whereIn('id',$request->ids)->delete();
        return redirect()->back();
    }
}
