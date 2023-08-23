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
    //
    // public function index(Request $request)
    // {
    //     return view('admin.category.index');
    // }

    public function index(CategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.category.index');
    }

    /**
     * data table ajax
     */
    // public function dataTable()
    // {
    //     $category = Category::select('*');

    //     return DataTables::of($category)

    //         ->addIndexColumn()
    //         ->orderColumn("created_at", function ($query, $row) {
    //             return $query->orderBy("created_at", $row);
    //         })
    //         ->editColumn('status', function ($row) {
    //             $changeStatusUrl = route('category.status.toggle', $row['id']);
    //             $changeStatusUrl = "'" . $changeStatusUrl . "'";
    //             $tableName = "'categoryDataTable'";
    //             $status = $row['status'] ? 'Active' : 'InActive';
    //             $statusClass = $row['status'] ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
    //             return '<span class="badge ' . $statusClass . '" onclick="changeStatus(' . $changeStatusUrl . ',' . $tableName . ')">' . $status . '</span>';
    //         })
    //         ->addColumn('image', function ($row) {
    //             $image  = '';
    //             $image .= '<img src="' . $row->category_image . '" class="img-fluid" style="width:100px;height:100px; border-radius:10%;"> ';
    //             return $image;
    //         })
    //         ->addColumn('action', function ($row) {
    //             $view_link = route('category.show', $row['id']);
    //             $option = '<a href="' . $view_link . '" class="action-icon"><i class="mdi mdi-eye"></i></a>';

    //             $updateLink = route('category.edit', $row['id']);
    //             $option .= '<a href="' . $updateLink . '" class="action-icon"   data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

    //             $delete_link = route('category.delete', $row['id']);
    //             $delete_link = "'" . $delete_link . "'";
    //             $tableName = "'categoryDataTable'";

    //             $option .= '<a href="javascript:void(0);" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" "><i class="mdi mdi-delete"></i></a>';

    //             return $option;
    //         })
    //         ->rawColumns(['status', 'image', 'action'])
    //         ->make(true);
    // }

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
            $media = $category->addMediaFromRequest('image')->toMediaCollection('images');
        }

        //  $category->addMediaFromRequest('image')->toMediaCollection('banner-image')->optimize();
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
}
