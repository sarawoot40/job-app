<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserdataController;
use App\Http\Controllers\WorkDataController;
use App\Http\Controllers\JobAndUserController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('view_work/{id}',[HomeController::class,'viewdataWork'])->middleware('is_login');
Route::get('admin/home',[HomeController::class,'adminHome'])->name('admin.home')->middleware('is_admin');


//work
Route::get('workdata/add_workdata',[WorkDataController::class,'addWork'])->name('addWork')->middleware('is_admin');
Route::post('workdata/creatework',[WorkDataController::class,'createWork'])->name('createWork')->middleware('is_admin');
Route::get('workdata/all_workdata',[WorkDataController::class,'allWork'])->name('allWork')->middleware('is_admin');
Route::get('workdata/view_workdata/{id}',[WorkDataController::class,'viewWork'])->middleware('is_admin');
Route::post('workdata/update/{id}',[WorkDataController::class,'updateWork'])->middleware('is_admin');
Route::get('workdata/applyforwork',[WorkDataController::class,'forWork'])->name('forWork')->middleware('is_admin');
Route::get('workdata/coordinate/{id}',[WorkDataController::class,'coordinate'])->middleware('is_admin');
Route::post('workdata/updatestatus/{id}',[WorkDataController::class,'updatestatus'])->middleware('is_admin');


//user
Route::get('userdata/add_datauser',[UserdataController::class,'addUser'])->name('addUser')->middleware('is_user');
Route::post('userdata/create',[UserdataController::class,'create'])->name('create')->middleware('is_user');
Route::get('user/userdata/index',[UserdataController::class,'index'])->name('index')->middleware('is_user');
Route::get('userdata/your_work',[UserdataController::class,'yourWork'])->name('yourWork')->middleware('is_user');

//job
Route::post('job/createJob/',[JobAndUserController::class,'createJob'])->middleware('is_user');
Route::post('job/delete/',[JobAndUserController::class,'softdelete_job'])->middleware('is_user');