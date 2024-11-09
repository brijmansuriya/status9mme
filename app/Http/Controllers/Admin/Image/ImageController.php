<?php

namespace App\Http\Controllers\Admin\Image;


use App\DataTables\ImageDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Image\CreateImageRequest;
use App\Http\Requests\Admin\Image\UpdateImageRequest;
use App\Models\Image;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class ImageController extends Controller
{
    public function index(ImageDataTable $dataTable)
    {
        return $dataTable->render('admin.image.index');
    }



    /**
     *  returns the create categorie page
     */
    public function create()
    {
        return view('admin.image.create');
    }

    /**
     *  store the categorie
     */
    public function store(CreateImageRequest $request)
    {

        //insert image array to database
        foreach ($request->file('image') as $uploadedFile) {
            $image = new Image();
            $image->name = $request->name;
            $image->save();
            $image->addMedia($uploadedFile)->toMediaCollection('image');
        }

        session()->flash('success', __('messages.panel.admin.image.added'));
        return redirect()->route('image.index');
    }

    /**
     *  toggles status of the categorie
     */
    public function toggleStatus($id)
    {
        $image = Image::findOrFail($id);
        $image->toggleStatus();
        return redirect()->back();
    }

    /**
     *  returns the customer details
     */
    public function show($id)
    {
        $image = Image::findOrFail($id);
        return view('admin.image.show', compact('image'));
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('admin.image.edit', compact('image'));
    }

    public function update(UpdateImageRequest $request, $id)
    {
        $image = Image::whereId($id)->first();
        $image->name = $request->name;
        $image->save();
        if($request->hasFile('image')) {
            $image->clearMediaCollection('image');
            $image->addMedia($request->file('image'))->toMediaCollection('image');
        }

        session()->flash('success', __('messages.panel.admin.image.updated'));
        return redirect()->route('image.index');
    }
    /**
     *  delete the categorie
     */
    public function delete($id)
    {
        $image = Image::findOrFail($id);
        $image->clearMediaCollection('image');
        $image->delete();
        return redirect()->back();
    }

    /**
     *  delete All the post
     */
    public function deleteAll(Request $request)
    {
        // Find the images by their IDs
        $images = Image::whereIn('id', $request->ids)->get();

        // Loop through each image and delete its media and database record
        foreach ($images as $image) {
            $image->clearMediaCollection('image');  // Remove associated media files
            $image->delete();  // Remove the image record from the database
        }

        return redirect()->back();
    }
}
