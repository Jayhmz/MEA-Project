<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthUserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\ReportController;
use Illuminate\Support\Facades\Artisan;

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
Route::get('/migrate', function(){
  Artisan::call('migrate');
});
Route::get('/login', function () {
    return view('auth-pages.login');
})->name('login');

//authentication routes
Route::post('login', [AuthUserController::class, 'login'])->name('auth.login');


//protedted routes
Route::middleware('admin')->group(function(){
  Route::view('/', 'dashboard')->name('dashboard'); //dashboard
    //report
  Route::view('create-report', 'report-pages.add-report')->name('report');
  Route::get('view-report', [ReportController::class, 'viewReports'])->name('view-reports');
  Route::post('upload-report', [ReportController::class, 'createReport'])->name('admin.report-upload');
  Route::post('update-report/{report}', [ReportController::class, 'updateReport'])->name('admin.report-update');
  Route::get('edit-report/{report}', [ReportController::class, 'editReport'])->name('admin.edit-report');
  Route::post('delete-report/{report}', [ReportController::class, 'deleteReport'])->name('admin.delete-report');
  //event
  Route::get('event-gallery/', [EventController::class, 'eventGallery'])->name('admin.event-gallery');
  Route::get('create-event-story', [EventController::class, 'viewEvents'])->name('admin.view-event-story');
  Route::post('create-event-story', [EventController::class, 'createEventStory'])->name('admin.create-event-story');
  Route::post('update-event-story/{event}', [EventController::class, 'UpdateEvents'])->name('admin.update-event-story');
  Route::get('event-gallery/{event}', [EventController::class, 'DeleteEvent'])->name('deleteevent');
  Route::get('delete-event-story-content/{post}', [EventController::class, 'RemovePostImage'])->name('admin.delete-event-story-content');
  Route::get('testing', [EventController::class, 'Testing'])->name('testing');
});
