<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AppVariable\StoreAppVariableRequest;
use App\Http\Requests\Admin\AppVariable\UpdateAppVariableRequest;
use App\Models\AppVariable;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Str;

class AppVariableController extends Controller
{
    /**
     *  returns the app links
     */
    public function index()
    {
        return view('admin.app-variables.index');
    }

    /**
     *  returns the datatables details
     */
    public function dataTables()
    {
        $orderSettings = AppVariable::select('*');


        return DataTables::of($orderSettings)

            ->addColumn('action', function ($row) {

                $updateLink = route('app-variables.update', $row['id']);
                $option = '';
                $updateLink = "'" . $updateLink . "'";
                $name = "'" . $row['name'] . "'";
                $key = "'" . $row['key'] . "'";
                $value = "'" . $row['value'] . "'";
                $option .= '<a href="#" class="action-icon" onclick="updateAppVariablesSettings(' . $updateLink . ',' . $name . ',' . $key . ',' . $value . ')"  data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

                return $option;
            })
            ->orderColumn("updated_at", function ($query, $row) {
                return $query->orderBy("updated_at", $row);
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     *  updates the app link
     */
    public function update(UpdateAppVariableRequest $request, $id)
    {
        AppVariable::whereId($id)->update($request->validated());

        session()->flash('success', __('messages.panel.admin.app_variables.updated'));
        return redirect()->route('app-variables.index');
    }

    public function store(StoreAppVariableRequest $request)
    {
        $data = $request->validated();
        $data['key'] = Str::slug($request->name, '_');
        AppVariable::create($data);

        return  redirect()->back()->with('success', 'App Variable Added');
    }
}
