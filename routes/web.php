<?php

use App\Http\Controllers\AdsController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\VisitorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route for client


// Route for admin
Route::group(['prefix' => 'admin', 'middleware' => 'auth', 'middleware' => 'admin'], function () {
    // page dashboard frontend
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    //page artikel frontend
    Route::get('artikel', function () {
        $title = 'Artikel';
        return view('admin.page-artikel.index', compact('title'));
    })->name('artikel');
    Route::get('artikel/trash-artikel/', function () {
        $title = 'Trash Artikel';
        return view('admin.page-artikel.trash-index', compact('title'));
    })->name('artikel-trash');
    Route::group(['middleware' => 'permission'], function () {
        Route::get('artikel/tambah-artikel', [ArtikelController::class, 'create'])->name('artikel.create');
        Route::get('artikel/edit-artikel/{id}', [ArtikelController::class, 'edit'])->name('artikel.edit');
    });
    // page kategori / rubrik frontend
    Route::get('rubrik', function () {
        $title = 'Rubrik';
        return view('admin.page-rubrik.index', compact('title'));
    })->name('rubrik');
    Route::get('rubrik/trash-rubrik/', function () {
        $title = 'Trash Rubrik';
        return view('admin.page-rubrik.trash-index', compact('title'));
    })->name('rubrik-trash');
    Route::group(['middleware' => 'permission'], function () {
        Route::get('rubrik/tambah-rubrik', [KategoriController::class, 'create'])->name('rubrik.create');
        Route::get('rubrik/edit-rubrik/{id}', [KategoriController::class, 'edit'])->name('rubrik.edit');
    });


    // page tags frontend
    Route::get('tags', function () {
        $title = 'Tags';
        return view('admin.page-tags.index', compact('title'));
    })->name('tags');
    Route::get('tags/trash-tags/', function () {
        $title = 'Trash tags';
        return view('admin.page-tags.trash-index', compact('title'));
    })->name('tags-trash');
    Route::group(['middleware' => 'permission'], function () {
        Route::get('tags/tambah-tags', [TagsController::class, 'create'])->name('tags.create');
        Route::get('tags/edit-tags/{id}', [TagsController::class, 'edit'])->name('tags.edit');
    });


    // page visitor frontend
    Route::get('visitor', function () {
        $title = 'Visitor';
        return view('admin.page-visitor.index', compact('title'));
    })->name('visitor');

    // page ads frontend
    Route::get('ads', function () {
        $title = 'Ads';
        return view('admin.page-ads.index', compact('title'));
    })->name('ads');

    Route::group(['middleware' => 'permission'], function () {
        Route::get('ads/tambah-ads', [AdsController::class, 'create'])->name('ads.create');
        Route::get('ads/edit-ads/{id}', [AdsController::class, 'edit'])->name('ads.edit');
    });

    // page user management frontend
    Route::get('users-management', function () {
        $title = 'Users';
        return view('admin.page-user.index', compact('title'));
    })->name('users');

    Route::group(['middleware' => 'permission'], function () {
        Route::get('users-management/tambah-user', [UsersController::class, 'create'])->name('users.create');
        Route::get('users-management/edit-users/{id}', [UsersController::class, 'edit'])->name('users.edit');
    });

    // Route PW change
    Route::get('change-pw/{username}', [UsersController::class, 'change_pw'])->name('change-pw');

    // data json for page artikel
    Route::group(['prefix' => 'page-artikel'], function () {
        Route::get('artikel-data', [ArtikelController::class, 'index'])->name('artikel.index');
        Route::get('artikel/trash-artikel/', [ArtikelController::class, 'index_trash'])->name('artikel.trash');
        Route::group(['middleware' => 'permission'], function () {
            Route::post('artikel/store-artikel', [ArtikelController::class, 'store'])->name('artikel.store');
            Route::put('artikel/update-artikel/{id}', [ArtikelController::class, 'update'])->name('artikel.update');
            Route::delete('artikel/delete-artikel/{id}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');
            Route::delete('artikel/shred-artikel/{id}', [ArtikelController::class, 'shred'])->name('artikel.shred');
            Route::delete('artikel/shreds-artikel', [ArtikelController::class, 'shreds'])->name('artikel.shreds');
            Route::get('artikel/restore-artikel/{id}', [ArtikelController::class, 'restore'])->name('artikel.restore');
            Route::get('artikel/restores-artikel', [ArtikelController::class, 'restores'])->name('artikel.restores');
            Route::get('artikel/slugs', [ArtikelController::class, 'getSlug'])->name('artikel.slug');
        });
    });

    // data json for page kategori / rubrik
    Route::group(['prefix' => 'page-kategori'], function () {
        Route::get('rubrik-data', [KategoriController::class, 'index'])->name('rubrik.index');
        Route::get('rubrik/trash-rubrik/', [KategoriController::class, 'index_trash'])->name('rubrik.trash');
        Route::group(['middleware' => 'permission'], function () {
            Route::post('rubrik/store-rubrik', [KategoriController::class, 'store'])->name('rubrik.store');
            Route::put('rubrik/update-rubrik/{id}', [KategoriController::class, 'update'])->name('rubrik.update');
            Route::delete('rubrik/delete-rubrik/{id}', [KategoriController::class, 'destroy'])->name('rubrik.destroy');
            Route::delete('rubrik/shred-rubrik/{id}', [KategoriController::class, 'shred'])->name('rubrik.shred');
            Route::delete('rubrik/shreds-rubrik', [KategoriController::class, 'shreds'])->name('rubrik.shreds');
            Route::get('rubrik/restore-rubrik/{id}', [KategoriController::class, 'restore'])->name('rubrik.restore');
            Route::get('rubrik/restores-rubrik', [KategoriController::class, 'restores'])->name('rubrik.restores');
            Route::get('rubrik/slugs', [KategoriController::class, 'getSlug'])->name('rubrik.slug');
        });
    });

    // data json for page tags
    Route::group(['prefix' => 'page-tags'], function () {
        Route::get('tags-data', [TagsController::class, 'index'])->name('tags.index');
        Route::get('tags/trash-tags/', [TagsController::class, 'index_trash'])->name('tags.trash');
        Route::group(['middleware' => 'permission'], function () {
            Route::post('tags/store-tags', [TagsController::class, 'store'])->name('tags.store');
            Route::put('tags/update-tags/{id}', [TagsController::class, 'update'])->name('tags.update');
            Route::delete('tags/delete-tags/{id}', [TagsController::class, 'destroy'])->name('tags.destroy');
            Route::delete('tags/shred-tags/{id}', [TagsController::class, 'shred'])->name('tags.shred');
            Route::delete('tags/shreds-tags', [TagsController::class, 'shreds'])->name('tags.shreds');
            Route::get('tags/restore-tags/{id}', [TagsController::class, 'restore'])->name('tags.restore');
            Route::get('tags/restores-tags', [TagsController::class, 'restores'])->name('tags.restores');
        });
    });

    // data json for page visitor
    Route::group(['prefix' => 'page-visitor'], function () {
        Route::get('visitor-data', [VisitorController::class, 'index'])->name('visitor.index');
    });

    // data json for page ads
    Route::group(['prefix' => 'page-ads'], function () {
        Route::get('ads-data', [AdsController::class, 'index'])->name('ads.index');
        Route::group(['middleware' => 'permission'], function () {
            Route::post('ads/store-ads', [AdsController::class, 'store'])->name('ads.store');
            Route::put('ads/update-ads/{id}', [AdsController::class, 'update'])->name('ads.update');
            Route::delete('ads/destroy-ads/{id}', [AdsController::class, 'destroy'])->name('ads.destroy');
        });
    });

    // data json for users
    Route::group(['prefix' => 'page-users'], function () {
        Route::get('users-data', [UsersController::class, 'index'])->name('users.index');
        Route::group(['middleware' => 'permission'], function () {
            Route::post('users/store-user', [UsersController::class, 'store'])->name('users.store');
            Route::put('users/update-user/{id}', [UsersController::class, 'update'])->name('users.update');
            Route::delete('users/destroy-user/{id}', [UsersController::class, 'destroy'])->name('users.destroy');
        });
    });

    Route::put('pw-update/{username}', [UsersController::class, 'update_pw'])->name('update-pw.update');
});
