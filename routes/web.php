<?php

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
    return view('top');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/mypage', 'LessonController@mypage')->name('lessons.mypage');
    Route::get('/lessons/{id}', 'LessonController@index')->name('lessons.index');
    Route::get('/lessons/{id}/edit', 'LessonController@edit')->name('lessons.edit');
    Route::post('/lessons/{id}/edit', 'LessonController@update')->name('lessons.update');
    Route::post('/lessons', 'LessonController@store')->name('lessons.store');
    Route::delete('/lessons/{lessons}', 'LessonController@destroy')->name('lessons.destroy');
});

Route::group(['middleware' => 'auth'], function () {
    Route::post('/tasks', 'TaskController@store')->name('tasks.store');
    Route::put('/tasks/sync/', 'TaskController@sync')->name('tasks.sync');
    Route::delete('/tasks/{tasks}', 'TaskController@destroy')->name('tasks.destroy');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
