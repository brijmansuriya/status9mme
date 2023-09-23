<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Web\PopularPost;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\Web\WebCategories;
use App\Http\Controllers\Web\WebController;
use App\Http\Controllers\WebViewController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ExportController;
use App\Http\Controllers\Admin\Tag\TagController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Post\PostController;
use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Admin\Settings\AppSettingController;
use App\Http\Controllers\Admin\Category\SubCategoryController;
use App\Http\Controllers\Admin\Settings\AppVariableController;
use App\Http\Controllers\Admin\Settings\AppLinkSettingsController;

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


Auth::routes(['register' => false]);

//web home page all data
Route::get('/', [WebController::class, 'index'])->name('web.home');

//home page popular
Route::get('/all-popular-post-list', [PopularPost::class, 'allPopularPostList'])->name('web.allpopularpostlist');
Route::get('/popular-post/{slug}', [PopularPost::class, 'popularPostShow'])->name('web.popularpost');

//home page latest
Route::get('/all-latest-post-list', [PopularPost::class, 'allLatestPostList'])->name('web.alllatestpostlist');
Route::get('/latest-post/{slug}', [PopularPost::class, 'LatestPostShow'])->name('web.latestpost');

//home categories list side bar
Route::get('/categories-list', [WebCategories::class, 'index'])->name('web.categorieslist');
Route::get('/categories/{slug}', [WebCategories::class, 'show'])->name('web.categories');


//aboutus
Route::get('/about-us', [WebController::class, 'aboutus'])->name('web.aboutus');
Route::get('/privacy-policy', [WebController::class, 'privacypolicy'])->name('web.privacypolicy');
Route::get('/contact-us', [WebController::class, 'contactus'])->name('web.contactus');
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
 *  all admin routes
 */
// Route::get('', function () {
//     return redirect()->route('admin.login');
// });
Route::prefix('admin')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('logout', [DashboardController::class, 'logout'])->name('admin.logout');
});

Route::prefix('admin')->middleware('auth:admin')->group(function () {
    Route::get('', DashboardController::class)->name('admin.home');

    Route::prefix('post')->group(function () {
        Route::get('', [PostController::class, 'index'])->name('post.index');
        Route::get('create', [PostController::class, 'create'])->name('post.create');
        Route::post('store', [PostController::class, 'store'])->name('post.store');
        Route::get('{id}/edit', [PostController::class, 'edit'])->name('post.edit');
        Route::post('{id}/update', [PostController::class, 'update'])->name('post.update');
        Route::get('dataTable', [PostController::class, 'dataTables'])->name('post.dataTables');
        Route::get('{id}/delete', [PostController::class, 'delete'])->name('post.delete');
        Route::post('deleteAll', [PostController::class, 'deleteAll'])->name('post.deleteAll');
        Route::get('{id}/toggle', [PostController::class, 'toggleStatus'])->name('post.status.toggle');
    });

    Route::prefix('app-links')->group(function () {
        Route::get('', [AppLinkSettingsController::class, 'index'])->name('app-links.index');
        Route::get('{id}/edit', [AppLinkSettingsController::class, 'edit'])->name('app-links.edit');
        Route::post('{id}/update', [AppLinkSettingsController::class, 'update'])->name('app-links.update');
        Route::get('dataTable', [AppLinkSettingsController::class, 'dataTables'])->name('app-links.dataTables');
    });

    Route::prefix('app-settings')->group(function () {
        Route::get('', [AppSettingController::class, 'index'])->name('app-settings.index');
        Route::post('{id}/update', [AppSettingController::class, 'update'])->name('app-settings.update');
        Route::get('dataTable', [AppSettingController::class, 'dataTables'])->name('app-settings.dataTable');
    });

    Route::prefix('app-variables')->group(function () {
        Route::get('', [AppVariableController::class, 'index'])->name('app-variables.index');
        Route::post('{id}/update', [AppVariableController::class, 'update'])->name('app-variables.update');
        Route::get('dataTable', [AppVariableController::class, 'dataTables'])->name('app-variables.dataTable');
        Route::post('store', [AppVariableController::class, 'store'])->name('app-variables.store');
    });

    Route::prefix('admins')->group(function () {
        Route::get('', [AdminController::class, 'index'])->name('admin.index');
        Route::get('create', [AdminController::class, 'create'])->name('admin.create');
        Route::post('store', [AdminController::class, 'store'])->name('admin.store');
        Route::get('{id}/edit', [AdminController::class, 'edit'])->name('admin.edit');
        Route::get('{id}/delete', [AdminController::class, 'delete'])->name('admin.delete');
        Route::post('{id}/update', [AdminController::class, 'update'])->name('admin.update');
        Route::get('dataTable', [AdminController::class, 'dataTables'])->name('admin.dataTable');
        Route::post('saveToken', [AdminController::class, 'saveToken'])->name('admin.save-device.token');
    });

    Route::prefix('customer')->group(function () {
        Route::get('', [CustomerController::class, 'index'])->name('customer.index');
        Route::get('create', [CustomerController::class, 'create'])->name('customer.create');
        Route::post('store', [CustomerController::class, 'store'])->name('customer.store');
        Route::get('dataTable', [CustomerController::class, 'dataTable'])->name('customer.dataTable');
        Route::get('{id}', [CustomerController::class, 'show'])->name('customer.show');
        Route::get('{id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
        Route::get('{id}/delete', [CustomerController::class, 'delete'])->name('customer.delete');
        Route::post('{id}/update', [CustomerController::class, 'update'])->name('customer.update');
        Route::get('{id}/toggle', [CustomerController::class, 'toggleStatus'])->name('customer.status.toggle');
    });

    Route::prefix('category')->group(function () {
        Route::get('', [CategoryController::class, 'index'])->name('category.index');
        Route::get('dataTable', [CategoryController::class, 'dataTable'])->name('category.dataTable');
        Route::get('create', [CategoryController::class, 'create'])->name('category.create');
        Route::post('store', [CategoryController::class, 'store'])->name('category.store');
        Route::get('{id}/show', [CategoryController::class, 'show'])->name('category.show');
        Route::get('{id}/edit', [CategoryController::class, 'edit'])->name('category.edit');
        Route::post('{id}/update', [CategoryController::class, 'update'])->name('category.update');
        Route::get('{id}/delete', [CategoryController::class, 'delete'])->name('category.delete');
        Route::post('deleteAll', [CategoryController::class, 'deleteAll'])->name('category.deleteAll');
        Route::get('{id}/toggle', [CategoryController::class, 'toggleStatus'])->name('category.status.toggle');
    });

    Route::prefix('tag')->group(function () {
        Route::get('', [TagController::class, 'index'])->name('tag.index');
        Route::get('dataTable', [TagController::class, 'dataTable'])->name('tag.dataTable');
        Route::get('create', [TagController::class, 'create'])->name('tag.create');
        Route::post('store', [TagController::class, 'store'])->name('tag.store');
        Route::get('{id}/show', [TagController::class, 'show'])->name('tag.show');
        Route::get('{id}/edit', [TagController::class, 'edit'])->name('tag.edit');
        Route::post('{id}/update', [TagController::class, 'update'])->name('tag.update');
        Route::get('{id}/delete', [TagController::class, 'delete'])->name('tag.delete');
        Route::post('deleteAll', [TagController::class, 'deleteAll'])->name('tag.deleteAll');
        Route::get('{id}/toggle', [TagController::class, 'toggleStatus'])->name('tag.status.toggle');
    });

    Route::prefix('export')->group(function () {
        Route::get('/customer/{type}', [ExportController::class, 'users'])->name('customer.export');
        Route::get('/provider/{type}', [ExportController::class, 'visitors'])->name('provider.export');
        Route::get('/admins/{type}', [ExportController::class, 'admins'])->name('admins.export');
        Route::get('/contact-us/{type}', [ExportController::class, 'contactUs'])->name('contactUs.export');
        Route::get('/notification/{type}', [ExportController::class, 'notification'])->name('notification.export');
        Route::get('/faq/{type}', [ExportController::class, 'faq'])->name('faq.export');

        Route::get('/categories/{type}', [ExportController::class, 'categories'])->name('category.export');
    });
});


/**
 *  webview for the app menu links
 */
Route::get('webview/{id}', WebViewController::class)->name('menu.webview');
Route::get('webview/post/{id}', [WebViewController::class, 'post'])->name('menu.post.webview');
Route::get('sitemap.xml', [SitemapController::class, 'generate'])->name('sitemap');
