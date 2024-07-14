<?php
namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Explorer;
use Carbon\Carbon;
use RalphJSmit\Laravel\SEO\Support\SEOData;

class ExplorerController extends Controller
{

    public function show($slug)
    {
        
        $explorer = Explorer::with('posts')->whereSlug($slug)->firstOrFail();

        // return view('web.explorer.show',compact('explorer'));
        return view('web.explorer.show',[
            'SEOData' => new SEOData(
                title: config('app.name').' explorer ditile page',
                description: 'Witness the eternal love of Radhe Krishna through our heartwarming video statuses. These clips portray their divine romance and the lessons of devotion that resonate through the ages.',
                author: config('app.name'),
                // image : url(config('app.logo')),
                enableTitleSuffix  : ' new ',
                site_name  : config('app.name'),
                published_time   : Carbon::parse('2023-06-28 10:30:00'),
                tags    : ['Lorem Ipsum','ll'],
                locale    : 'Lorem Ipsum',
                url    : 'Lorem Ipsum',
            ),
            'explorer' => $explorer,
        ]);
    }

}
