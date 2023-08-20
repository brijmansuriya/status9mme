<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Exports\FaqExport;
use App\Exports\TagExport;
use App\Exports\CastExport;
use App\Exports\SongExport;
use App\Exports\AlbumExport;
use App\Exports\MovieExport;
use App\Exports\UsersExport;
use Illuminate\Http\Request;
use App\Exports\AdminsExport;
use App\Exports\ArtistExport;
use App\Exports\SeasonExport;
use App\Exports\SeriesExport;
use App\Exports\TrailerExport;
use App\Exports\CategoryExport;
use App\Exports\EpisodesExport;
use App\Exports\VisitorsExport;
use App\Exports\ContactUsExport;
use App\Exports\LiveEventExport;
use App\Exports\AlbumTrackExport;
use App\Exports\BulkUploadExport;
use App\Exports\NotificationExport;
use App\Exports\MusicCategoryExport;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\channelEpisodeExport;
use App\Exports\PodcastChannelExport;
use App\Exports\BulkImageUploadExport;
use App\Exports\VideoMusicCategoryExport;

class ExportController extends Controller
{

    /***
     * exports the users
     */
    public function users($type , Request $request)
    {
        $search = $request->search;
        $range = $request->get('range');

        $makeLink = 'exhibitors-' . Carbon::now()->toDateTimeString();
        if ($type == "excel") {
            return Excel::download(new UsersExport($search,$range), $makeLink . '.xlsx');
        } else if ($type == "csv") {
            return Excel::download(new UsersExport($search,$range), $makeLink . '.csv');
        } else if ($type == "pdf") {
            return Excel::download(new UsersExport($search,$range), $makeLink . '.pdf');
        }
    }

    /***
     * exports the visitors
     */
    public function visitors($type , Request $request)
    {
        $search = $request->search;
        $range = $request->get('range');

        $makeLink = 'visitors-' . Carbon::now()->toDateTimeString();
        if ($type == "excel") {
            return Excel::download(new VisitorsExport($search,$range), $makeLink . '.xlsx');
        } else if ($type == "csv") {
            return Excel::download(new VisitorsExport($search,$range), $makeLink . '.csv');
        } else if ($type == "pdf") {
            return Excel::download(new VisitorsExport($search,$range), $makeLink . '.pdf');
        }
    }

    /**
     *  exports the admins
     */
    public function admins($type , Request $request)
    {
        $search = $request->search;
        $makeLink = 'admin-' . Carbon::now()->toDateTimeString();
        if ($type == "excel") {
            return Excel::download(new AdminsExport($search), $makeLink . '.xlsx');
        } else if ($type == "csv") {
            return Excel::download(new AdminsExport($search), $makeLink . '.csv');
        } else if ($type == "pdf") {
            return Excel::download(new AdminsExport($search), $makeLink . '.pdf');
        }
    }

    /**
     *  exports the contact-us
     */
    public function contactUs($type, Request $request)
    {
        $search = $request->search;
        $makeLink = 'contact-us-' . Carbon::now()->toDateTimeString();
        if ($type == "excel") {
            return Excel::download(new ContactUsExport($search), $makeLink . '.xlsx');
        } else if ($type == "csv") {
            return Excel::download(new ContactUsExport($search), $makeLink . '.csv');
        } else if ($type == "pdf") {
            return Excel::download(new ContactUsExport($search), $makeLink . '.pdf');
        }
    }

    /**
     *  exports the notification
     */
    public function notification($type)
    {
        $makeLink = 'notification-' . Carbon::now()->toDateTimeString();
        if ($type == "excel") {
            return Excel::download(new NotificationExport, $makeLink . '.xlsx');
        } else if ($type == "csv") {
            return Excel::download(new NotificationExport, $makeLink . '.csv');
        } else if ($type == "pdf") {
            return Excel::download(new NotificationExport, $makeLink . '.pdf');
        }
    }

    /**
     *  exports the faq
     */
    public function faq($type, Request $request)
    {
        $search = $request->search;
        $makeLink = 'faq-' . Carbon::now()->toDateTimeString();
        if ($type == "excel") {
            return Excel::download(new FaqExport($search), $makeLink . '.xlsx');
        } else if ($type == "csv") {
            return Excel::download(new FaqExport($search), $makeLink . '.csv');
        } else if ($type == "pdf") {
            return Excel::download(new FaqExport($search), $makeLink . '.pdf');
        }
    }

}
