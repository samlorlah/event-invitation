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

Route::get('phpinfo', fn() => phpinfo());

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
	'register'=> false
]);

Route::get('/home', 'HomeController@index')->name('home');
Route::post('guest/store', 'HomeController@inviteGuest');
Route::get('guest/validate/{token}', 'HomeController@validateGuest');
Route::get('guest/resend/{id}', 'HomeController@resendInvite')->name('resendInvite');
Route::get('guest/delete/{id}', 'HomeController@deleteInvite')->name('deleteInvite');
Route::get('general-pass/permit', 'HomeController@generalInvite')->name('generalInvite');
