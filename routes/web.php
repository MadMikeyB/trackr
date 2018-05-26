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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::resource('projects', 'ProjectsController');

// API route model binding not working
Route::post('/api/logtime/{project}', 'Api\\TimelogController@store')->name('api.timelog.store');

Route::get('/settings', 'UserSettingsController@index')->name('user.settings.index');
Route::post('/settings', 'UserSettingsController@store')->name('user.settings.store');

Route::post('/milestones/{project}', 'ProjectMilestoneController@store')->name('milestones.store');
Route::get('/milestones/{project}/create', 'ProjectMilestoneController@create')->name('milestones.create');
Route::get('/milestones/{project}/edit', 'ProjectMilestoneController@edit')->name('milestones.edit');
Route::patch('/milestones/{project}/{milestone}', 'ProjectMilestoneController@update')->name('milestones.update');
Route::delete('/milestones/{project}/{milestone}', 'ProjectMilestoneController@destroy')->name('milestones.destroy');
