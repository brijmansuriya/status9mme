<?php

use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\PopularPost;
use App\Http\Controllers\Web\WebCategories;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\WebViewController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SitemapController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//web home page all data
Route::get('/', [WebController::class, 'index'])->name('web.home');

//home page popular
Route::get('/all-popular-post-list', [PopularPost::class, 'allPopularPostList'])->name('web.allpopularpostlist');
Route::get('/post/{slug}', [PopularPost::class, 'popularPostShow'])->name('web.popularpost');

//home page latest
Route::get('/all-latest-post-list', [PopularPost::class, 'allLatestPostList'])->name('web.alllatestpostlist');
// Route::get('/latest-post/{slug}', [PopularPost::class, 'popularPostShow'])->name('web.latestpost');

//home categories list side bar
Route::get('/categories-list', [WebCategories::class, 'index'])->name('web.categorieslist');
Route::get('/categories/{slug}', [WebCategories::class, 'show'])->name('web.categories');

//aboutus
Route::get('/about-us', [WebController::class, 'aboutus'])->name('web.aboutus');
Route::get('/privacy-policy', [WebController::class, 'privacypolicy'])->name('web.privacypolicy');
Route::get('/contact-us', [WebController::class, 'contactus'])->name('web.contactus');
Route::post('/contact-us', [WebController::class, 'contactusSubmit'])->name('contact.submit');
Route::get('/dmca', [WebController::class, 'dmca'])->name('web.dmca');

/**
 * forgot password route for all users
 */

Route::get('email/verify/{id}/{hash}', [RegisterController::class, 'verify'])->name('verification.verify');
/**
 * Verification Routes
 */

Route::prefix('any')->group(function () {
    Route::get('reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('allUsers.showResetForm');
    Route::get('reset/email/{user_type}', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('allUsers.showResetEmailForm');
    Route::get('/password-change-success', [HomeController::class, 'passwordChange']);
});

/**
 *  webview for the app menu links
 */
Route::get('webview/{id}', WebViewController::class)->name('menu.webview');
Route::get('webview/post/{id}', [WebViewController::class, 'post'])->name('menu.post.webview');
Route::get('sitemap.xml', [SitemapController::class, 'generate'])->name('sitemap');
