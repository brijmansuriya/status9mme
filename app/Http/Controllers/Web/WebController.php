<?php

namespace App\Http\Controllers\Web;

use Carbon\Carbon;
use App\Models\Post;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Request;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use RalphJSmit\LaravelSeo\Facades\SeoFacade;

class WebController extends Controller
{
    public function index()
    {
        $categorys = Category::active()->available()->latest()->take(config('app.home-category'))->get(['id','slug','name']);

        $post = $featureds = $populars = $latests = $trandings = Post::with('category')->latest()->active()->take(config('app.home-post'))->get();

     
        return view('web.home',[
            'SEOData' => new SEOData(
                title: config('app.name').' home page',
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
            'categorys' => $categorys,
            'trandings' => $trandings,
            'latests' => $latests,
            'populars' => $populars,
            'featureds' => $featureds,
        ]);
    }

    //aboutus page
    public function aboutus() {

        // Seo::setTitle('Custom Home Page Title');
        // Seo::setDescription('Custom Home Page Description');
        return view('web.aboutus',[
            'SEOData' => new SEOData(
                title: 'Awesome News - My Project',
                description: 'Lorem Ipsum',
                author: 'Lorem Ipsum',
                image : 'Lorem Ipsum',
                enableTitleSuffix  : 'Lorem Ipsum',
                site_name  : 'Lorem Ipsum',
                published_time   : Carbon::parse('2023-06-28 10:30:00'),
                tags    : ['Lorem Ipsum','ll'],
                locale    : 'Lorem Ipsum',
                url    : 'Lorem Ipsum',
            ),
        ]);
    }
    //privacypolicy
    public function privacypolicy() {
        return view('web.privacypolicy',[
            'SEOData' => new SEOData(
                title: 'Awesome News - My Project',
                description: 'Lorem Ipsum',
                author: 'Lorem Ipsum',
                image : 'Lorem Ipsum',
                enableTitleSuffix  : 'Lorem Ipsum',
                site_name  : 'Lorem Ipsum',
                published_time   : Carbon::parse('2023-06-28 10:30:00'),
                tags    : ['Lorem Ipsum','ll'],
                locale    : 'Lorem Ipsum',
                url    : 'Lorem Ipsum',
            ),
        ]);
    }
    //dmca page
    public function dmca() {
        return view('web.dmca',[
            'SEOData' => new SEOData(
                title: 'Awesome News - My Project',
                description: 'Lorem Ipsum',
                author: 'Lorem Ipsum',
                image : 'Lorem Ipsum',
                enableTitleSuffix  : 'Lorem Ipsum',
                site_name  : 'Lorem Ipsum',
                published_time   : Carbon::parse('2023-06-28 10:30:00'),
                tags    : ['Lorem Ipsum','ll'],
                locale    : 'Lorem Ipsum',
                url    : 'Lorem Ipsum',
            ),
        ]);
    }
    //contactus page
    public function contactus() {
        return view('web.contactus',[
            'SEOData' => new SEOData(
                title: 'Awesome News - My Project',
                description: 'Lorem Ipsum',
                author: 'Lorem Ipsum',
                image : 'Lorem Ipsum',
                enableTitleSuffix  : 'Lorem Ipsum',
                site_name  : 'Lorem Ipsum',
                published_time   : Carbon::parse('2023-06-28 10:30:00'),
                tags    : ['Lorem Ipsum','ll'],
                locale    : 'Lorem Ipsum',
                url    : 'Lorem Ipsum',
            ),
        ]);
    }
}
