<?php

namespace App\Http\Controllers\Admin\Post;

use App\DataTables\CategorieDataTable;
use App\DataTables\PostDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Post\StorePostRequest;
use App\Http\Requests\Admin\Post\UpdatePostRequest;
use App\Http\Requests\Admin\Settings\UpdateAppMenuLinkRequest;
use App\Models\AppMenuLink;
use App\Models\Categorie;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Services\YoutubeUrlServices;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Seo;
use Yajra\DataTables\Facades\DataTables;


class PostController extends Controller
{
    //custocter 

    public function __construct(protected YoutubeUrlServices $youtubeUrlServices)
    {
       
    }

    public function index(PostDataTable $dataTable)
    {
        return $dataTable->render('admin.post.index');
    }

    // /**
    //  *  returns the datatables details
    //  */
    // public function dataTables()
    // {
    //     $orderSettings = Post::select('*')->latest();
    //     return DataTables::of($orderSettings)

    //         ->addColumn('image', function ($row) {
    //             $image  = '';
    //             $image .= '<img src="' . $row->image . '" class="img-fluid" style="width:100px;height:100px; border-radius:10%;"> ';
    //             return $image;
    //         })

    //         ->editColumn('status', function ($row) {
    //             $changeStatusUrl = route('post.status.toggle', $row['id']);
    //             $changeStatusUrl = "'" . $changeStatusUrl . "'";
    //             $tableName = "'postsDataTable'";
    //             $status = $row['status'] ? 'Active' : 'InActive';
    //             $statusClass = $row['status'] ? 'bg-soft-success text-success' : 'bg-soft-danger text-danger';
    //             return '<span class="badge ' . $statusClass . '" onclick="changeStatus(' . $changeStatusUrl . ',' . $tableName . ')">' . $status . '</span>';
    //         })
    //         ->addColumn('action', function ($row) {

    //             $updateLink = route('post.edit', $row['id']);
    //             $option = '';

    //             $option .= '<a href="' . $updateLink . '" class="action-icon" data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

    //             $delete_link = route('post.delete', $row['id']);
    //             $delete_link = "'" . $delete_link . "'";
    //             $tableName = "'postsDataTable'";

    //             $option .= '<a href="javascript:void(0);" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" "><i class="mdi mdi-delete"></i></a>';

    //             return $option;
    //         })
    //         ->addColumn('updated_at', function ($row) {
    //             return Carbon::parse($row['updated_at'])->format('n/j/Y g:i A');
    //         })
    //         ->addColumn('generated_link', function ($row) {
    //             $link =  $row->generated_link;

    //             return '<a href="' . $link . '" class="btn btn-primary" data-overlaycolor="#38414a">View Link</a>';
    //         })
    //         ->orderColumn("updated_at", function ($query, $row) {
    //             return $query->orderBy("updated_at", $row);
    //         })
    //         ->rawColumns(['action', 'generated_link', 'status', 'image'])
    //         ->make(true);
    // }

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
        $videoType = '0';
        if($this->youtubeUrlServices->isShortsUrl($request->url)){
            $videoType = '1';
        }

        $post = Post::create([
            'categorie_id' => $request->categorie_id,
            'keyword' => 'Vitae enim sed quia',
            'title' => $request->title,
            'meta_description' => $request->meta_description,
            'description' => $request->description,
            'url' => $request->url,
            'slug' => $request->slug,
            'video_type' => $videoType,
        ]);


        
        $post->seo->update([
            'title' => $request->title,
            'description' => $request->meta_description,
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
        $videoType = '0';
        if($this->youtubeUrlServices->isShortsUrl($request->url)){
            $videoType = '1';
        }

        $post = Post::findOrFail($id);
        $requestData = $request->all();
        $requestData['video_type'] = $videoType;
        $post->update($requestData);
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
        DB::transaction(function () use ($request) {
            Post::whereIn('id', $request->ids)->each(function ($post) {
                $post->tags()->detach();
                $post->explorers()->detach();
                $post->delete();
            });
        });

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

    // /slugCheck
    public function slugCheck(Request $request)
    {
        $slug = $request->slug;
        $post = Post::where('slug', $slug)->first();
        if ($post) {
            return response()->json(['status' => false]);
        } else {
            return response()->json(['status' => true]);
        }
    }
}
