<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/admin', ['as'=>'admin.home', function(){
    return view('welcome');
}]);

Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function ()
{
    Route::resource('school', "Admin\\SchoolController");
    Route::post("school/batch_action/", ['as' => "admin.school.batch_action",
        'uses' => "Admin\\SchoolController@batchAction"]);

    Route::resource('student', "Admin\\StudentController");
    Route::post("student/batch_action/", ['as' => "admin.student.batch_action",
        'uses' => "Admin\\StudentController@batchAction"]);
});

Route::auth();

Route::get('/home', 'HomeController@index');
