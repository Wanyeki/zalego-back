<?php

use App\Http\Controllers\Content_controller;
use App\Http\Controllers\Messages_controller;
use App\Http\Controllers\Newsletter_controller;
use App\Http\Controllers\Partners_controller;
use App\Http\Controllers\Project_features;
use App\Http\Controllers\projects_controller;
use App\Http\Controllers\Users_controller;
use App\Models\ProjectFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/all_users',[Users_controller::class,'get_all']);
Route::post('/add_user',[Users_controller::class,'add']);
Route::post('/make_admin',[Users_controller::class,'make_admin']);
Route::post('/delete_user',[Users_controller::class,'delete']);

Route::post('/delete_project',[projects_controller::class,'delete']);
Route::post('/delete_partner',[Partners_controller::class,'delete']);

Route::post('/newsletter',[Newsletter_controller::class,'add']);
Route::post('/add_feature',[Project_features::class,'add']);
Route::post('/delete_feature',[Project_features::class,'delete']);

Route::post('/features',[Project_features::class,'all']);



Route::post('/get_content',[Content_controller::class,'get_content']);
Route::post('/delete_content',[Content_controller::class,'delete']);

Route::post('/send_message',[Messages_controller::class,'save_message']);
Route::post('/delete_message',[Messages_controller::class,'delete']);
Route::post('/messages',[Messages_controller::class,'get_messages']);
Route::post('/read_message',[Messages_controller::class,'read_message']);

Route::post('/send_email',[Messages_controller::class,'send_email']);
