<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Settings\UpdateAppSettingRequest;
use App\Models\AppSetting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AppSettingController extends Controller
{

    /**
     *  returns the app links
     */
    public function index()
    {
        return view('admin.app-settings.index');
    }

    /**
     *  returns the datatables details
     */
    public function dataTables()
    {
        $orderSettings = AppSetting::select('*');


        return DataTables::of($orderSettings)

            ->addColumn('action', function ($row) {

                $updateLink = route('app-settings.update', $row['id']);
                $option = '';
                $updateLink = "'" . $updateLink . "'";
                $name = "'" . $row['app_type'] . "'";
                $label = "'" . $row['app_label'] . "'";
                $version = "'" . $row['app_version'] . "'";
                $force_updates = "'" . $row['force_updates'] . "'";
                $maintenance_mode = "'" . $row['maintenance_mode'] . "'";
                $option .= '<a href="#" class="action-icon" onclick="updateAppSettings(' . $updateLink . ',' . $name . ',' . $label . ',' . $version . ',' . $force_updates . ',' . $maintenance_mode . ')"  data-overlaycolor="#38414a"><i class="mdi mdi-square-edit-outline"></i></a>';

                return $option;
            })
            ->addColumn('updated_at', function ($row) {
                return Carbon::parse($row['updated_at'])->format('n/j/Y g:i A');
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
    public function update(UpdateAppSettingRequest $request, $id)
    {
        AppSetting::whereId($id)->update([
            'app_version' => request()->input('app_version'),
            'force_updates' => request()->input('force_updates') ? 1 : 0,
            'maintenance_mode' => request()->input('maintenance_mode') ? 1 : 0,
        ]);

        return redirect()->route('app-settings.index');
    }
}