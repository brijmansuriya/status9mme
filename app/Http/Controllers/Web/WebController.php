<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Mail\ContactUsMail;
use App\Models\Categorie;
use App\Models\Explorer;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use RalphJSmit\Laravel\SEO\Support\SEOData;
use RalphJSmit\LaravelSeo\Facades\SeoFacade;
use Spatie\SchemaOrg\Schema;

class WebController extends Controller
{
    public function index()
    {
        $categorys = Categorie::active()->available()->latest()->take(config('app.home-categorie'))->get(['id', 'slug', 'name']);

        $featureds = $populars = $latests = $trandings = Post::with('categorie')->latest()->active()->available()->paginate(config('app.home-post'));

        $explorers = Explorer::latest()->available()->paginate(config('app.home-categorie'));

        //js Schema data for home page
        $homePageSchema = Schema::WebPage()
            ->name(config('app.name') .'Home Page')
            ->description('Witness the eternal love of Radhe Krishna through our heartwarming video statuses. These clips portray their divine romance and the lessons of devotion that resonate through the ages.')
            ->url(route('web.home'))
            ->inLanguage(['en', 'hi']);

        return view('web.home', [
            'SEOData' => new SEOData(
                title: config('app.name') . ' home page',
                description: 'Witness the eternal love of Radhe Krishna through our heartwarming video statuses. These clips portray their divine romance and the lessons of devotion that resonate through the ages.',
                author: config('app.name'),
                // image : url(config('app.logo')),
                enableTitleSuffix: ' new ',
                site_name: config('app.name'),
                published_time: Carbon::parse('2023-06-28 10:30:00'),
                tags: ['Lorem Ipsum', 'll'],
                locale: 'Lorem Ipsum',
                url: 'Lorem Ipsum',
            ),
            'explorers' => $explorers,
            'categorys' => $categorys,
            'trandings' => $trandings,
            'latests' => $latests,
            'populars' => $populars,
            'featureds' => $featureds,
            'homePageSchema' => $homePageSchema
        ]);
    }

    //aboutus page
    public function aboutus()
    {
        //js Schema data for home page
        $aboutPageSchema = Schema::AboutPage()
        ->name(config('app.name') .'About Us')
        ->description('Learn more about Status9mme, our mission, and our team.')
        ->url(route('web.aboutus'))
        ->inLanguage(['en','hi']);

        // Seo::setTitle('Custom Home Page Title');
        // Seo::setDescription('Custom Home Page Description');
        return view('web.aboutus', [
            'SEOData' => new SEOData(
                title: config('app.name') . ' About Us',
                description: 'Lorem Ipsum',
                author: 'Lorem Ipsum',
                image: 'Lorem Ipsum',
                enableTitleSuffix: 'Lorem Ipsum',
                site_name: 'Lorem Ipsum',
                published_time: Carbon::parse('2023-06-28 10:30:00'),
                tags: ['Lorem Ipsum', 'll'],
                locale: 'Lorem Ipsum',
                url: 'Lorem Ipsum',
            ),
        ]);
    }
    //privacypolicy
    public function privacypolicy()
    {
        return view('web.privacypolicy', [
            'SEOData' => new SEOData(
                title: config('app.name') . ' Privacy Policy',
                description: 'Lorem Ipsum',
                author: 'Lorem Ipsum',
                image: 'Lorem Ipsum',
                enableTitleSuffix: 'Lorem Ipsum',
                site_name: 'Lorem Ipsum',
                published_time: Carbon::parse('2023-06-28 10:30:00'),
                tags: ['Lorem Ipsum', 'll'],
                locale: 'Lorem Ipsum',
                url: 'Lorem Ipsum',
            ),
        ]);
    }
    //dmca page
    public function dmca()
    {
        return view('web.dmca', [
            'SEOData' => new SEOData(
                title: config('app.name') . ' DMCA',
                description: 'Lorem Ipsum',
                author: 'Lorem Ipsum',
                image: 'Lorem Ipsum',
                enableTitleSuffix: 'Lorem Ipsum',
                site_name: 'Lorem Ipsum',
                published_time: Carbon::parse('2023-06-28 10:30:00'),
                tags: ['Lorem Ipsum', 'll'],
                locale: 'Lorem Ipsum',
                url: 'Lorem Ipsum',
            ),
        ]);
    }
    //contactus page
    public function contactus()
    {
        return view('web.contactus', [
            'SEOData' => new SEOData(
                title: config('app.name') . ' Contact Us',
                description: 'Lorem Ipsum',
                author: 'Lorem Ipsum',
                image: 'Lorem Ipsum',
                enableTitleSuffix: 'Lorem Ipsum',
                site_name: 'Lorem Ipsum',
                published_time: Carbon::parse('2023-06-28 10:30:00'),
                tags: ['Lorem Ipsum', 'll'],
                locale: 'Lorem Ipsum',
                url: 'Lorem Ipsum',
            ),
        ]);
    }

    //contactus Submit
    public function contactusSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
        );

        Mail::to('news9mme+@gmail.com')->send(new ContactUsMail($data));
        return redirect()->back()->with('success', 'Thank you for contacting us!');
    }
    //contactus Submit
    public function template(Request $request)
    {

        return view('web.template');
    }
}
