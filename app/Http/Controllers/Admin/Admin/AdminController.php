<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\DataTables\AdminDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Requests\Admin\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminRequest;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admin']);
    }
    /**
     *  returns the admins page
     */
    // public function index()
    // {
    //     return view('admin.admin.index');
    // }

    public function index(AdminDataTable $dataTable)
    {
        return $dataTable->render('admin.admin.index');
    }

    /**
     *return $dataTable->render('admin.admin.index');
     *  returns the datatables details
     */
    public function dataTables()
    {
        $srs = Admin::select('id', 'name', 'email', 'created_at');

        return DataTables::of($srs)
            ->addColumn('action', function ($row) {

                $updateLink = route('admin.edit', $row['id']);
                $option = '';
                $option .= '<a href="' . $updateLink . '" class="action-icon"   data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';
                if(Auth::user()->id != $row['id']){
                    $delete_link = route('admin.delete', $row['id']);
                    $delete_link = "'" . $delete_link . "'";
                    $tableName = "'adminDataTable'";
                    $option .= '<a href="#" onclick="deleteRecord(' . $delete_link . ',' . $tableName . ');"  class="action-icon" " ><i class="mdi mdi-delete"></i></a>';
                }

                return $option;
            })
            ->orderColumn("created_at", function ($query, $row) {
                return $query->orderBy("created_at", $row);
            })
            ->addColumn('image', function ($row) {
                $image  = '';
                //$image .= '<img src="'.$row->getFirstMediaUrl('image').'" class="img-fluid rounded-circle">';
                $image .= '<img src="' . $row->profile_picture  . '" class="img-fluid" style="width:100px;height:100px; border-radius:10%;"> ';
                return $image;
            })
            ->rawColumns([
                'action', 'image'
            ])
            ->make(true);
    }

    /**
     *  returns the admins add page
     */
    public function create()
    {
        return view('admin.admin.create');
    }

    /**
     *  stores the admin
     */
    public function store(StoreAdminRequest $request)
    {
        $input = request()->all();
        $input['password'] = bcrypt($request->password);
        $admin = Admin::create($input);
        if ($request->hasFile('image')) {
            $admin->addMediaFromRequest('image')->toMediaCollection('admin/profile-picture');
        }
        session()->flash('success', __('messages.panel.admin.added'));
        return redirect()->route('admin.index');
    }

    /**
     *  returns the edit page for admin
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id);
        return view('admin.admin.edit', compact('admin'));
    }
    /**
     *  returns the update page for faq
     */
    public function update(UpdateAdminRequest $request, $id)
    {
        $input = request()->except(['_token']);
        $admin = Admin::findOrFail($id);
        $password = null;
        if (isset($input['new_password']) && $input['new_password'] !== null) {
            if ($id == auth()->user()->id) {

                //if the current user and admin id are same then checking the admin old password and current
                if (!Hash::check(request()->input('current_password'), auth()->user()->password)) {
                    //if the passwords dont match
                    session()->flash('error', __('messages.panel.common.wrong_current_password'));
                    return redirect()->back();
                }
                // check old and new password are same or not
                if (request()->input('current_password') == request()->input('new_password')) {
                    session()->flash('error', __('messages.panel.admin.same_password'));
                    return redirect()->back();
                }
                // if (Hash::check(request()->input('new_password'), auth()->user()->password)) {
                //     session()->flash('error', __('messages.panel.common.password_same_as_old'));
                //     return redirect()->back();
                // }
            }
            $password = bcrypt($request->new_password);
        }

        if ($request->hasFile('image')) {
            $admin->deleteProfilePicture();
            $admin->addMediaFromRequest('image')->toMediaCollection('admin/profile-picture');
        }
        $admin->email = $request->email;
        $admin->name = $request->name;
        $admin->password = $password;
        $admin->update();

        session()->flash('success', __('messages.panel.admin.updated'));
        return redirect()->route('admin.index');
    }

    /**
     *  deletes the faq
     */
    public function delete($id)
    {
        $admin = Admin::where('id', $id)->first();
        $admin->delete();
        return redirect()->route('admin.index');
    }

    /**
     *  stores fcm token
     */
    public function saveToken(Request $request)
    {
        if ($request->has('token')) {
            $admin = auth()->user();
            $admin->device_token = $request->token;
            $admin?->update();
        }
        return response()->json([
            'status' => true
        ]);
    }
}
