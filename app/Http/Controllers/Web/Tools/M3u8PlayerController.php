<?php
namespace App\Http\Controllers\Web\Tools;

use App\Http\Controllers\Controller;
use App\Models\Explorer;
use Carbon\Carbon;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use Spatie\SchemaOrg\Schema;

class M3u8PlayerController extends Controller
{
    public function __construct() {
    }
    public function index()
    {
        $videoToImagePageSchema = Schema::WebPage()
        ->name(config('app.name') . 'Online m3u8 Player: Stream m3u8 Files with Direct Link Playback')
        ->description('Stream m3u8 files directly with our online m3u8 player. Upload your m3u8 URL and enjoy seamless playback across devices. No installation needed.')
        ->url(route('web.tools.video_to_image'))
        ->inLanguage(['en', 'hi']);

        return view('web.tools.m3u8player',[
            'SEOData' => new SEOData(
                title: config('app.name').' Online m3u8 Player: Stream m3u8 Files with Direct Link Playback',
                description: 'Stream m3u8 files directly with our online m3u8 player. Upload your m3u8 URL and enjoy seamless playback across devices. No installation needed.',
                author: config('app.name'),
                // image : url(config('app.logo')),
                enableTitleSuffix  : ' new ',
                site_name  : config('app.name'),
                published_time   : Carbon::parse('16-oct-2024'),
                tags    : [  'm3u8 player',
                'stream m3u8 online',
                'm3u8 direct link',
                'm3u8 playback',
                'video player m3u8',
                'play m3u8 files',
                'online video player'],
                locale    : 'india',
                url    : route('web.tools.video_to_image'),
            ),
            'videoToImagePageSchema' => $videoToImagePageSchema

          

        ]);
    }

}
