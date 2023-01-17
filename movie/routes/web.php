<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ActorController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserWatchlistController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'web'], function() {
    Route::group(['middleware' => ['guest']], function() {
        // login
        Route::get('/login', [UserController::class, 'login_page'])->name('login_page')->middleware('guest');
        Route::post('/login_act', [UserController::class, 'login'])->name('login');
        // register
        Route::get('/register', [UserController::class, 'register_page'])->name('register_page');
        Route::post('/register/add', [UserController::class, 'register'])->name('register');
    });
    
    Route::group(['middleware' => 'is_admin'], function() {
        //movie
        Route::get('/movie/add', [MovieController::class, 'create'])->name('movie_add');
        Route::post('/movie/store', [MovieController::class, 'store'])->name('movie_store');
        Route::get('/movie/edit/{movie_id}', [MovieController::class, 'edit'])->name('movie_edit');
        Route::post('/movie/update', [MovieController::class, 'update'])->name('movie_update');
        Route::get('/movie/delete/{movie_id}', [MovieController::class, 'destroy'])->name('movie_destroy');

        //actor
        Route::get('/actor/add', [ActorController::class, 'create'])->name('actor_add');
        Route::post('/actor/store', [ActorController::class, 'store'])->name('actor_store');
        Route::get('/actor/edit/{actor_id}', [ActorController::class, 'edit'])->name('actor_edit');
        Route::post('/actor/update', [ActorController::class, 'update'])->name('actor_update');
        Route::get('/actor/delete/{actor_id}', [ActorController::class, 'destroy'])->name('actor_destroy');
    });

    Route::group(['middleware' => 'auth'], function() {
        // user watchlist
        Route::get('/user_watchlist', [UserWatchlistController::class, 'index'])->name('user_watchlist');
        Route::get('/user_watchlist/destroy/{user_watchlist_id}', [UserWatchlistController::class,
        'destroy'])->name('user_watchlist_destroy');
        Route::get('/user_watchlist/add/{movie_id}', [UserWatchlistController::class, 'store'])->name('user_watchlist_add');
        Route::post('/user_watchlist/status', [UserWatchlistController::class, 'status'])->name('user_watchlist_status');

        // user profile
        Route::get('/user_profile', [UserProfileController::class,'show'])->name('user_profile');
        Route::post('/user_profile', [UserProfileController::class,'upsert'])->name('user_profile_upsert');

        //logout
        Route::post('/logout', [UserController::class, 'logout'])->name('logout');
    });
    
    //movie
    Route::get('/', [MovieController::class, 'index'])->name('home');
    Route::get('/movie', [MovieController::class, 'index']);
    Route::get('/movie/{movie_id}', [MovieController::class, 'show'])->name('movie_detail');

    // actor
    Route::get('/actor', [ActorController::class, 'index'])->name('actor');
    Route::get('/actor/{actor_id}', [ActorController::class, 'show'])->name('actor_detail');

});
