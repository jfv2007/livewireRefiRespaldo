<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Livewire\Admin\HistorialFalla\HfallaController;
use App\Http\Livewire\Admin\Falla\ListFallas;
use App\Http\Livewire\Admin\Tag18\CreateTag18Form;
use App\Http\Livewire\Admin\Tag18\ListFallas as Tag18ListFallas;
use App\Http\Livewire\Admin\Tag18\ListFallasTags18;
use App\Http\Livewire\Admin\Tag18\ListTag18s;
use App\Http\Livewire\Admin\Tag18\ListTagsFallas;
use App\Http\Livewire\Admin\Tag18\UpdateTag18Form;
use App\Http\Livewire\Admin\Trabajo\ListTrabajos;
use App\Http\Livewire\Admin\Users\ListUsers;
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

Route::get('/', function () {
    return view('welcome');
});

route::group(['middleware' =>'auth'], function(){

    Route::get('admin/dashboard', DashboardController::class)->name('admin.dashboard');
    Route::get('admin/users', ListUsers::class)->name('admin.users');

    Route::get('admin/tag18s',ListTag18s::class)->name('admin.tag18s');
    /* Route::get('admin/tag18s/list', ListTagsFallas ::class)->name('admin.tag18s.list-tags-fallas'); */
    Route::get('admin/tag18s/{tag18}/listfallas', ListFallasTags18 ::class)->name('admin.tag18s.list-fallas');
    Route::get('admin/tag18s/create', CreateTag18Form::class)->name('admin.tag18s.create');
    Route::get('admin/tag18s/{tag18}/edit', UpdateTag18Form::class)->name('admin.tag18s.edit');

    Route::get('admin/fallas', ListFallas::class)->name('admin.fallas');

    Route::get('admin/trabajos', ListTrabajos::class)->name('admin.trabajos');

    /* Route::get('admin/hfalla',[HfallaController::class,'index'])->name('admin.hfalla'); */
});


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
