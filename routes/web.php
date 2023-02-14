<?php

use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\official;

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
Route::get('/',[UserController::class, 'index' ])->name('t.singin');
Route::get('/login',[UserController::class, 'index' ])->name('t.singin');
Route::get('/register',[UserController::class, 'sign_up' ])->name('t.singup'); 

Route::post('/sign-up/register',[UserController::class, 'adduser'])->name('tuser.add');
Route::post('/user-login',[UserController::class, 'loguser'])->name('tuser.login');

Route::group(['middleware'=>['usercheck']], function(){


    Route::get('/',[UserController::class, 'index' ])->name('list.singin');
    Route::post('/logout',[UserController::class, 'off' ])->name('list.off');

    Route::get('/home',[UserController::class, 'home' ])->name('list.home');
    Route::get('/view/{id}',[UserController::class, 'view'])->name('list.view');

    
    Route::get('/official.index/{loc} {brgname}',[official::class, 'indexoff' ])->name('list.home');

    // Manage Listings
    Route::get('/listings/manage', [UserController::class, 'manage']);

    Route::get('/edit-{id}',[ListingController::class, 'edit'])->name('list.edit');

    Route::match(array('GET','POST'),'/listing-add',[ListingController::class, 'addlist' ]) ->name('addlist.manage');

    Route::match(array('GET','POST'),'/MyList-Delete-All',[ListingController::class, 'dellall'])->name('dellallmylist');


    Route::match(array('GET','POST'),'/delete-{id}',[ListingController::class, 'deleteitem' ]) ->name('item.delete');
 

    Route::match(array('GET','POST'),'/update-{id}',[ListingController::class, 'updateitem' ]) ->name('item.update');

    // manage officials
    Route::get('/view-officials/{location}/{brgname}', [official::class, 'officialMview']) ->name('officials.manage');

    Route::match(array('GET','POST'),'/official-add/{location}/{brgname}',[official::class, 'add' ])->name('officials.add');

    Route::get('/official-edit/{loc}-{brg}{oid}', [official::class, 'edit']) ->name('officials.editview');

    Route::match(array('GET','POST'),'/official-update/{location}-{brgname}{oid}',[official::class, 'update' ])->name('officials.update');
    
    Route::match(array('GET','POST'),'/official-delete/{location}-{brgname}{oid}',[official::class, 'deleteOFF' ])->name('officials.delete');
    
    Route::match(array('GET','POST'),'/MyList-Delete-officials-{location}-{brgname}',[official::class, 'dellall'])->name('dellallmylist');

   
    });


