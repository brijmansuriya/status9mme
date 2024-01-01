<?php

namespace App\Http\Controllers\Admin\Post;

use Seo;
use Carbon\Carbon;
use App\Models\Tag;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Categorie;
use App\Models\AppMenuLink;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\DataTables\PostDataTable;
use App\Http\Controllers\Controller;
use App\DataTables\CategorieDataTable;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Http\Requests\Admin\Settings\UpdateAppMenuLinkRequest;

class PostController extends Controller
{
    /**
     *  returns the app links
     */
    // public function index()
    // {
    //     return view('admin.post.index');
    // }

    public function index(PostDataTable $dataTable)
    {
        return $dataTable->render('admin.post.index');
    }

    /**
     *  returns the datatables details
     */
    public function dataTables()
    {
        $orderSettings = Post::select('*')->latest();
        return DataTables::of($orderSettings)

            ->addColumn('image', function ($row) {
                $image  = '';
                $image .= '<img src="' . $row->image . '" class="img-fluid" style="width:100px;height:100px; border-radius:10%;"> ';
                return $image;
            })

            ->editColumn('status', function ($row) {
                $changeStatusUrl = route('post.status.toggle', $row['id']);
                $changeStatusUrl = "'" . $changeStatusUrl . "'";
                $tableName = "'postsDataTable'";
                $status = $row['status'] ? 'Active' : 'InActive';
                $statusClass = $row['status'] ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
                return '<span class="badge ' . $statusClass . '" onclick="changeStatus(' . $changeStatusUrl . ',' . $tableName . ')">' . $status . '</span>';
            })
            ->addColumn('action', function ($row) {

                $updateLink = route('post.edit', $row['id']);
                $option = '';

                $option .= '<a href="' . $updateLink . '" class="action-icon" data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

                $delete_link = route('post.delete', $row['id']);
                $delete_link = "'" . $delete_link . "'";
                $tableName = "'postsDataTable'";

                $option .= '<a href="javascript:void(0);" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" "><i class="mdi mdi-delete"></i></a>';

                return $option;
            })
            ->addColumn('updated_at', function ($row) {
                return Carbon::parse($row['updated_at'])->format('n/j/Y g:i A');
            })
            ->addColumn('generated_link', function ($row) {
                $link =  $row->generated_link;

                return '<a href="' . $link . '" class="btn btn-primary" data-overlaycolor="#38414a">View Link</a>';
            })
            ->orderColumn("updated_at", function ($query, $row) {
                return $query->orderBy("updated_at", $row);
            })
            ->rawColumns(['action', 'generated_link', 'status', 'image'])
            ->make(true);
    }

    /**
     *  returns the admins add page
     */
    public function create()
    {
        $tags = Tag::get(['id', 'name', 'slug']);
        $categorys = Categorie::active()->get(['id', 'name']);
        return view('admin.post.create', compact('categorys', 'tags'));
    }

    /**
     *  stores the admin
     */
    public function store(StorePostRequest $request)
    {
        $input = request()->all();
        $count = Post::where('slug', $input['slug'])->count();
        if ($count > 0) {
            // Slug is not unique, so you need to make it unique
            $input['slug'] = $input['slug'] . '-' . ($count + 1);
        }
        $post = Post::create($input);
        $post->seo->update([
            'title' => 'My great post',
            'description' => 'This great post will enhance your live.',
        ]);

        $post->tags()->sync($request->tags);

        if ($request->hasFile('image')) {
            $post->addMediaFromRequest('image')->toMediaCollection('post/image');
        }


        session()->flash('success', __('messages.panel.post.added'));
        return redirect()->route('post.index');
    }

    /**
     *  returns the edit page for this
     */
    public function edit($id)
    {
        $post = Post::with('tags')->findOrFail($id);
        $categorys = Categorie::active()->get(['id', 'name']);
        $tags = Tag::active()->get(['id', 'name']);
        return view('admin.post.edit', compact('post', 'categorys', 'tags'));
    }

    /**
     *  updates the app link
     */
    public function update(UpdatePostRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        $post->tags()->sync($request->tags);

        if ($request->hasFile('image')) {
            $post->deleteFile();
            $post->addMediaFromRequest('image')->toMediaCollection('post/image');
        }
        session()->flash('success',  __('messages.panel.post.update'));
        return redirect()->route('post.index');
    }

    /**
     *  delete the post
     */
    public function delete($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->back();
    }

    /**
     *  delete the post
     */
    public function deleteAll(Request $request)
    {
        $post = Post::whereIn('id', $request->ids)->delete();

        return redirect()->back();
    }

    /**
     *  toggles status of the Post
     */
    public function toggleStatus($id)
    {
        $post = Post::findOrFail($id);
        $post->toggleStatus();
        return redirect()->back();
    }
}
