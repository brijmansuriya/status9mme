<?php

namespace App\Http\Controllers\Admin\Tag;

use App\Models\Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\SubCategories;
use Psy\Readline\Hoa\Console;
use App\DataTables\TagDataTable;
use App\Models\ProviderCategory;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Tag\CreateTagRequest;
use App\Http\Requests\Admin\Tag\UpdateTagRequest;


class TagController extends Controller
{

    public function index(TagDataTable $dataTable)
    {
        return $dataTable->render('admin.tag.index');
    }

     /**
     * data table ajax
     */
    public function dataTable()
    {
        $tag = Tag::select('*');

        return DataTables::of($tag)

            ->addIndexColumn()
            ->orderColumn("created_at", function ($query, $row) {
                return $query->orderBy("created_at", $row);
            })
            ->editColumn('status', function ($row) {
                $changeStatusUrl = route('tag.status.toggle', $row['id']);
                $changeStatusUrl = "'" . $changeStatusUrl . "'";
                $tableName = "'tagDataTable'";
                $status = $row['status'] ? 'Active' : 'InActive';
                $statusClass = $row['status'] ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
                return '<span class="badge ' . $statusClass . '" onclick="changeStatus(' . $changeStatusUrl . ',' . $tableName . ')">' . $status . '</span>';
            })
            ->addColumn('action', function ($row) {
                $view_link = route('tag.show', $row['id']);
                $option = '<a href="' . $view_link . '" class="action-icon"><i class="mdi mdi-eye"></i></a>';

                $updateLink = route('tag.edit', $row['id']);
                $option .= '<a href="' . $updateLink . '" class="action-icon"   data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

                $delete_link = route('tag.delete', $row['id']);
                $delete_link = "'" . $delete_link . "'";
                $tableName = "'tagDataTable'";

                $option .= '<a href="javascript:void(0);" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" "><i class="mdi mdi-delete"></i></a>';

                return $option;
            })
            ->rawColumns(['status',  'action'])
            ->make(true);
    }

     /**
     *  returns the create category page
     */
    public function create()
    {
        return view('admin.tag.create');
    }

    /**
     *  store the category
     */
    public function store(CreateTagRequest $request)
    {
        $category = Tag::create([
            'name' => $request->name,
            'slug'=> Str::slug($request->name),
        ]);
       
        session()->flash('success', __('messages.panel.admin.tag.added'));
        return redirect()->route('tag.index');
    }

    /**
     *  toggles status of the category
     */
    public function toggleStatus($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->toggleStatus();
        return redirect()->back();
    }

    /**
     *  returns the customer details
     */
    public function show($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag.show', compact('tag'));
    }

    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        return view('admin.tag.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request,$id)
    {
        $tag = Tag::whereId($id)->first();

        $tag->update([
            'name' => request()->input('name'),
        ]);

        session()->flash('success', __('messages.panel.admin.tag.updated'));
        return redirect()->route('tag.index');
    }
    /**
     *  delete the category
     */
    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return redirect()->back();
    }

}
?>
