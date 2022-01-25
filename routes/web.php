<?php

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

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');
Route::get('/home', ['uses' => 'HomeController@index'])->name('home')->middleware('auth');

Route::middleware(['auth'])->group(function () {

    //    Route::get('/todo/add', [App\Http\Controllers\todoController::class, 'add'])->name('add-task');
    Route::get('/todo/add', ['uses' => 'todoController@add'])->name('add-task');

    Route::post('/todo/save', ['uses' => 'todoController@saveTask'])->name('save-task');

    Route::get('/todo/manage', ['uses'  =>  'todoController@manageTask'])->name('manage-task');
    Route::get('/todo/manage/filter', ['uses'  =>  'todoController@searchByDate'])->name('filter');
    Route::get('/todo/manage/filter/{id}', ['uses'  =>  'todoController@searchByDateQ'])->name('filter-q');
    Route::get('/todo/search', ['uses'  =>  'todoController@searchByName'])->name('search');
    Route::get('/todo/undone/{id}', ['uses'  =>  'todoController@undoneTask', 'as'    =>  'undone-task']);

    Route::get('/task/done/{id}', [
        'uses'  =>  'todoController@doneTask',
        'as'    =>  'done-task'
    ]);

    Route::get('/task/edit/{id}', [
        'uses'  =>  'todoController@editTask',
        'as'    =>  'edit-task'
    ]);

    Route::post('/task/update/', [
        'uses'  =>  'todoController@updateTask',
        'as'    =>  'update-task'
    ]);

    Route::get('/task/delete/{id}', [
        'uses'  =>  'todoController@deleteTask',
        'as'    =>  'delete-task'
    ]);

    Route::get('task/history', [
        'uses' => 'todoController@historyTask',
        'as'   => 'history'
    ]);


    Route::get('/task/HistoryClear', [
        'uses' => 'todoController@ClearHistory',
        'as'   => 'clear-history'
    ]);
});
