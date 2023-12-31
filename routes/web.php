<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/login', [AuthController::class, 'doLogin']);
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');


Route::prefix("/blog")->name('blog.')->middleware('auth')->controller(BlogController::class)->group(function(){

    Route::get('/', 'index')->name('index');

    Route::get('/{slug}-{post}', 'show')->where([
        "slug" => '[a-z0-9\-]+',
        "id" => '[0-9]'
    ])->name('show'); 

    Route::get('/new', 'create')->name('create');
    Route::post('/new', 'store');

    Route::get('/{post}/edit', 'edit')->name('edit');
    Route::post('/{post}/edit', 'update');

});
