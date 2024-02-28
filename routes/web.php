<?php

use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Categories\AlQuranController;
use App\Http\Controllers\Categories\DoaController;
use App\Http\Controllers\Categories\HadistController;
use App\Http\Controllers\Categories\StoryController;
use App\Http\Controllers\Categories\TahlilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\BookmarkController;
use App\Http\Controllers\User\ProfileController as UserProfileController;
use App\Models\StoryNabi;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


// home
Route::get('/',[HomeController::class,'index'])->name('home');

// categories fitur
Route::prefix('categories')->group(function () {
    // fitur tanpa login
        // get all
        Route::get('/al-quran', [AlQuranController::class,'index'])->name('categories.alquran.get');
        Route::get('/doa', [DoaController::class,'index'])->name('categories.doa.get');
        Route::get('/tahlil', [TahlilController::class,'index'])->name('categories.tahlil.get');
        Route::get('/story-nabi', [StoryController::class,'index'])->name('categories.story.nabi.get');
        Route::get('/hadist', [HadistController::class,'index'])->name('categories.hadist.get');

        // get details
        Route::get('/al-quran/{id}', [AlQuranController::class,'detail'])->name('categories.alquran.getdetail');
        Route::get('/al-quran/juz/{id}', [AlQuranController::class,'detailjuz'])->name('categories.alquran.getdetailjuz');
        Route::get('/doa/{id}', [DoaController::class,'detail'])->name('categories.doa.getdetail');
        Route::get('/story-nabi{id}', [StoryController::class,'detail'])->name('categories.story.nabi.getdetail');

    // fitur yg harus login
    Route::middleware(['auth,verified'])->group(function () {

            Route::get('/hadist/{id}', [HadistController::class,'detail'])->name('categories.hadist.getdetail');
            
            // fitur login post
            Route::post('/alquran/{id}', [AlQuranController::class,'create'])->name('categories.alquran.post');
            Route::post('/doa/{id}', [DoaController::class,'create'])->name('categories.doa.post');
            Route::post('/tahlil/{id}', [TahlilController::class,'create'])->name('categories.tahlil.post');
            Route::post('/story-nabi/{id}', [StoryNabi::class,'create'])->name('categories.story-nabi.post');
            Route::post('/hadist/{id}', [HadistController::class,'create'])->name('categories.hadist.post');
    });
});

// login dengan google
Route::prefix('auth')->controller(SocialiteController::class)->group(function () {
    Route::get('{provider}/redirect','redirect')->name('login.redirect');
    Route::get('{provider}/callback', 'callback')->name('login.callback');
});

// user
Route::middleware(['auth','verified'])->group(function () {
    // bookmark
    Route::get('/bookmark',[BookmarkController::class,'index'])->name('user.bookmark');
    
    // profile
    Route::get('/user/profile',[UserProfileController::class,'index'])->name('user.profile');
});


Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
