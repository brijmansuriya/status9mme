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

        $featureds = $latests = $trandings = $populars = Post::with('categorie')->latest()->active()->available()->paginate(config('app.home-post'));

        $latests =  Post::with('categorie')->latest()->active()->available()->orderBy('id', 'desc')->paginate(config('app.home-post'));

        $populars = Post::with('categorie')->orderByUniqueViews('asc')->latest()->active()->available()->paginate(config('app.home-post'));

        $explorers = Explorer::latest()->available()->paginate(config('app.home-explorer'));

        //js Schema data for home page
        $homePageSchema = Schema::WebPage()
            ->name(config('app.name') . 'Home Page')
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
            ->name(config('app.name') . 'About Us')
            ->description('Learn more about Status9mme, our mission, and our team.')
            ->url(route('web.aboutus'))
            ->inLanguage(['en', 'hi']);

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
            'aboutPageSchema' => $aboutPageSchema
        ]);
    }
    //privacypolicy
    public function privacypolicy()
    {

        //js Schema data for home page
        $privacyPolicyPageSchema = Schema::WebPage()
            ->name(config('app.name') . 'Privacy Policy')
            ->description('At status9mme, accessible from status9mme.com, one of our main priorities is the privacy of our visitors.
                This Privacy Policy document contains types of information that is collected and recorded by status9mme
                and how we use it')
            ->url(route('web.privacypolicy'))
            ->inLanguage(['en', 'hi']);
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
            'privacyPolicyPageSchema' => $privacyPolicyPageSchema
        ]);
    }
    //dmca page
    public function dmca()
    {
        //js Schema data for home page
        $dmcaPageSchema = Schema::WebPage()
            ->name(config('app.name') . 'DMCA')
            ->description('If we Have added some content that belong to you or your organization by mistake, We are sorry for that.
                We apologize for that and assure you that this wont be repeated in future.')
            ->url(route('web.dmca'))
            ->inLanguage(['en', 'hi']);
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
            'dmcaPageSchema' => $dmcaPageSchema
        ]);
    }
    //contactus page
    public function contactus()
    {
        //js Schema data for home page
        $contactPageSchema = Schema::WebPage()
            ->name(config('app.name') . 'Contact Us')
            ->description('Contact Us')
            ->url(route('web.contactus'))
            ->inLanguage(['en', 'hi']);
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
            'contactPageSchema' => $contactPageSchema
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

}
