<?php

use App\Http\Controllers\Admin_controller;
use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\Content_controller;
use App\Http\Controllers\Pages_controller;
use App\Http\Controllers\Partners_controller;
use App\Http\Controllers\projects_controller;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Route;

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

Route::get('/',[Pages_controller::class,'home'])->name('home');
Route::get('/what-sets-us-appart',[Pages_controller::class,'sets'])->name('sets');
Route::get('/approach',[Pages_controller::class,'approach'])->name('approach');
Route::get('/contacts',[Pages_controller::class,'contacts'])->name('contacts');
Route::get('/portfolio',[Pages_controller::class,'portfolio'])->name('portfolio');
Route::get('/goals',[Pages_controller::class,'goals'])->name('goals');

Route::get('/login',[Auth_controller::class,'open_login'])->name('login');
Route::post('/login',[Auth_controller::class,'login']);

Route::post('/logout',[Auth_controller::class,'logout'])->name('logout');

Route::get('/manage/admin',[Admin_controller::class,'dashboard'])->name('dash')
->middleware('auth');

Route::post('/add_project',[projects_controller::class,'save']);

Route::post('/add_partner',[Partners_controller::class,'save']);

Route::get('storage/{filename}', function ($filename)
{
    $path = storage_path('storage/app/public/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }

    $file = File::get($path);
    $type = File::mimeType($path);

    $response = HttpResponse::make($file, 200);
    $response->header("Content-Type", $type);

    return $response;
});


Route::post('/save_content',[Content_controller::class,'save']);
