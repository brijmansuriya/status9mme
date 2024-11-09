<?php
namespace App\Http\Controllers\Web\Tools;

use App\Http\Controllers\Controller;
use App\Models\Explorer;
use App\Services\YoutubeUrlServices;
use Carbon\Carbon;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\SchemaOrg\Schema;

class VideoToImageController extends Controller
{
    public function __construct() {
    }
    public function index()
    {
        $videoToImagePageSchema = Schema::AboutPage()
        ->name(config('app.name') . 'video to image tool')
        ->description('user friendly video to image converter video play and stop capcher high quality image')
        ->url(route('web.tools.video_to_image'))
        ->inLanguage(['en', 'hi']);

        return view('web.tools.video_to_image',[
            'SEOData' => new SEOData(
                title: config('app.name').' Video To Image',
                description: 'user friendly video to image converter video play and stop capcher high quality image',
                author: config('app.name'),
                // image : url(config('app.logo')),
                enableTitleSuffix  : ' new ',
                site_name  : config('app.name'),
                published_time   : Carbon::parse(now()->format('Y-m-d H:i:s')),
                tags    : ['video to image','high quality image'],
                locale    : 'indian',
                url    : route('web.tools.video_to_image'),
            ),
            'videoToImagePageSchema' => $videoToImagePageSchema
        
        ]);
    }

}
