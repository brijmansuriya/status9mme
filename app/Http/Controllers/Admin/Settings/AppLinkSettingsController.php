<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\UpdateAppMenuLinkRequest;
use App\Models\AppMenuLink;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AppLinkSettingsController extends Controller
{
    /**
     *  returns the app links
     */
    public function index()
    {
        return view('admin.app-link-settings.index');
    }

    /**
     *  returns the datatables details
     */
    public function dataTables()
    {
        $orderSettings = AppMenuLink::select('*');


        return DataTables::of($orderSettings)

            ->addColumn('action', function ($row) {

                $updateLink = route('app-links.edit', $row['id']);
                $option = '';

                $option .= '<a href="' . $updateLink . '" class="action-icon" data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

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
            ->rawColumns(['action', 'generated_link'])
            ->make(true);
    }

    /**
     *  returns the edit page for this
     */
    public function edit($id)
    {
        $appLinks = AppMenuLink::findOrFail($id);
        return view('admin.app-link-settings.edit', compact('appLinks'));
    }

    /**
     *  updates the app link
     */
    public function update(UpdateAppMenuLinkRequest $request, $id)
    {
        $appLinks = AppMenuLink::findOrFail($id);
        $appLinks->deleteFile();

        $appLinks->update([
            'show_name' => request()->input('name'),
            'type' => request()->input('type'),
            'value' => request()->input('type') == "file" ? null : (request()->input('type') == "ckeditor" ? request()->input('ck_editor_value') : request()->input('normal_value')),
        ]);

        if (request()->input('type') == "file") {
            $appLinks->addMediaFromRequest('file_value')->toMediaCollection('app-link/file');
        }

        session()->flash('success', 'app link updated successfully');
        return redirect()->back();
    }
}