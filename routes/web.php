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

Route::get('api-js', [
    'as' => 'api.js',
    'uses' => 'TestController@getScormApiJs',
]);

Route::get('get-value', [
    'as' => 'get.value',
    'uses' => 'TestController@getValue',
]);

Route::post('set-value', [
    'as' => 'set.value',
    'uses' => 'TestController@setValue',
]);

Route::post('fileDesc', [
    'as' => 'fileDesc',
    'uses' => 'TestController@showUploadFile'
]);

Route::get('search', [
    'as' => 'search',
    'uses' => 'TestController@searchFile',
]);

Route::get('loadSCO', [
    'as' => 'loadSCO',
    'uses' => 'TestController@loadSCO',
]);

Route::get('pip', function(){

    return view('pipwerks.pip1');
});