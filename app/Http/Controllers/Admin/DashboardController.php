<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Admin;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\ContactUs;
use App\Models\Faq;
use App\Models\Provider;
use App\Models\ServiceJobs;
use App\Models\SubCategories;
use Illuminate\Support\Facades\Auth;;

use Illuminate\Support\Facades\Request;

class DashboardController extends Controller
{
    /**
     * Returns the dashboard page
     *
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {



        $type = request()->input('type');
        $year = request()->has('year') ? request()->input('year') : date('Y');
        $month = request()->has('month') ? request()->input('month') : date('m');
        $start_date = request()->has('start_date') ? request()->input('start_date') : now()->toDateString();
        $end_date = request()->has('end_date') ? request()->input('end_date') : now()->toDateString();



        $admin = Admin::count();

        $categorie = Categorie::count();
        return view('admin.home', compact('admin', 'categorie'));
    }

    public function logout(Request $request)
    {

        Auth::guard('admin')->logout();
        // $request->session()->invalidate();

        // $request->session()->regenerateToken();
        // session()->flash('success', __('messages.panel.common.logout'));
        return redirect()->route('admin.login');
    }
}
