<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('upload');
});

Route::get('foo', [
    'as' => 'cURLtest',
    'uses' => 'Auth\LoginController@cURLtest'
]);

Route::post('upload.scorm', [
    'as' => 'upload.scorm',
    'uses' => 'TestController@uploadSCORMZipFile'
]);

Route::get('read/{id}', [
    'as' => 'get.content',
    'uses' => 'TestController@getContent',
]);

Route::post('fileDesc', [
    'as' => 'fileDesc',
    'uses' => 'TestController@showUploadFile'
]);