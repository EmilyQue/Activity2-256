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

/*This Route is mapped to the '/hello' URI and will return 
the text Hello World to be rendered in the browser*/
Route::get('/hello', function () {
    return "Hello World!";
});

/*This route is mapped to the '/helloworld' URI and will return 
the hello world view (i.e. file at resources/view/helloworld.blade.php)*/
Route::get('/helloworld', function () {
    return view('helloworld');
});

/*This route is mapped to the '/test' URI and will return the Hello World from the Test Controller test()*/
Route::get('/test', 'TestController@test');

/*Route is mapped to the '/whoami' URI and will return the Who Am I view */
Route::get('/askme', function () {
    return view('whoami');
});

Route::post('/whoami', 'WhatsMyNameController@index');


Route::get('/login', function() {
    return view('login');
});

Route::post('/dologin', 'LoginController@index');

Route::get('/login2', function() {
    return view('login2');
});
    
Route::post('/dologin2', 'Login2Controller@index');
    
Route::get('/login3', function() {
    return view('login3');
});
    
    Route::post('/dologin3', 'Login3Controller@index');














