<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ArticleImageController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BannerAddController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MetatagController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;


// ✅ Custom Login/Logout Routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ Dashboard & Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    })->name('home');

    // ✅ Pages
    Route::get('/pages', [PageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create', [PageController::class, 'create'])->name('pages.create');
    Route::post('/pages', [PageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{id}', [PageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{id}/delete', [PageController::class, 'destroy'])->name('pages.destroy');

    // ✅ Menus
    Route::get('/menus', [MenuController::class, 'index'])->name('menus.index');
    Route::get('/menus/create', [MenuController::class, 'create'])->name('menus.create');
    Route::post('/menus', [MenuController::class, 'store'])->name('menus.store');
    Route::get('/menus/{id}/edit', [MenuController::class, 'edit'])->name('menus.edit');
    Route::put('/menus/{id}', [MenuController::class, 'update'])->name('menus.update');
    Route::delete('/menus/{id}/delete', [MenuController::class, 'destroy'])->name('menus.destroy');

    // ✅ Articles
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('/articles/{id}', [ArticleController::class, 'update'])->name('articles.update');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');
    Route::get('/articles/{id}/show', [ArticleController::class, 'show'])->name('articles.show');

    // ✅ Article Images
    Route::get('/articleimage', [ArticleImageController::class, 'index'])->name('articleimage.index');
    Route::get('/articleimage/create', [ArticleImageController::class, 'create'])->name('articleimage.create');
    Route::post('/articleimage', [ArticleImageController::class, 'store'])->name('articleimage.store');
    Route::get('/articleimage/{id}/edit', [ArticleImageController::class, 'edit'])->name('articleimage.edit');
    Route::put('/articleimage/{id}', [ArticleImageController::class, 'update'])->name('articleimage.update');
    Route::delete('/articleimage/{id}', [ArticleImageController::class, 'destroy'])->name('articleimage.destroy');

    // ✅ Contact
    Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
    Route::post('/contacts/store', [ContactController::class, 'store'])->name('contacts.store');

    // ✅ Contact Messages
    Route::get('/ContactMessage', [ContactMessageController::class, 'index'])->name('contact_message.index');

    // ✅ Metatags
    Route::get('/Metatag', [MetatagController::class, 'index'])->name('metatag.index');
    Route::get('/Metatag/Create', [MetatagController::class, 'create'])->name('metatag.create');
    Route::post('/Metatag', [MetatagController::class, 'store'])->name('metatag.store');
    Route::get('/Metatag/{id}/edit', [MetatagController::class, 'edit'])->name('metatag.edit');
    Route::put('/Metatag/{id}', [MetatagController::class, 'update'])->name('metatag.update');
    Route::delete('/Metatag/{id}/delete', [MetatagController::class, 'destroy'])->name('metatag.destroy');

    // ✅ Banner Ads
    Route::get('/BannerAdds', [BannerAddController::class, 'index'])->name('ads.index');
    Route::post('/Banneradd', [BannerAddController::class, 'store'])->name('ads.store');
    Route::get('/ads/{id}', [BannerAddController::class, 'show'])->name('ads.show');
    Route::delete('/ads/{id}', [BannerAddController::class, 'destroy'])->name('ads.destroy');

    // ✅ Profile
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::post('/profile/upload', [UserProfileController::class, 'store'])->name('profile.upload');
    Route::get('/profile/{id}/edit', [UserProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/{id}', [UserProfileController::class, 'update'])->name('profile.update');

  
 
});

  
  Route::prefix('frontend')->name('frontend.')->group(function () {
  
    
});
// Default home route → Dream Explorer
Route::get('/', [HomeController::class, 'index'])->name('home');

// Optional named route for clarity
Route::get('/dream-explorer', [HomeController::class, 'index'])->name('dream.explorer');

// Slug-based dynamic routes
Route::get('/chapter/{slug}', [HomeController::class, 'index']);
Route::get('/word/{slug}', [HomeController::class, 'index']);
Route::get('/dream/{slug}', [HomeController::class, 'index']);

// Data provider route for JS
Route::get('/dream-data', [HomeController::class, 'dreamData'])->name('dream.data');

Route::get('/menu/{id}/articles', [HomeController::class, 'menuArticles'])->name('menu.articles');
Route::get('/articles/{slug}', [HomeController::class, 'show'])->name('articles.show');