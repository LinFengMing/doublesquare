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

Route::group(['prefix' => 'api'], function () {
    //符合/api/menu
    Route::get('menu', 'ExhibitionController@index');
    Route::get('exhibition', 'ExhibitionController@show');
    Route::get('links', 'QrcodeController@index');
    Route::post('contact', 'MailController@store');
});

Route::group(['middleware' => 'auth:api'], function () {
    Route::get('admin/api/exhibitions', 'ExhibitionBackedController@index');
    Route::get('admin/api/exhibition', 'ExhibitionBackedController@show');
    Route::post('admin/api/add_exhibition', 'ExhibitionBackedController@store');
    Route::post('admin/api/edit_exhibition', 'ExhibitionBackedController@update');
    Route::post('admin/api/delete_exhibition', 'ExhibitionBackedController@destroy');
    Route::get('admin/api/footer', 'ParmController@getFooter');
    Route::post('admin/api/edit_footer', 'ParmController@updateFooter');
    Route::post('admin/api/file', 'FileController@store');
    Route::get('admin/api/contact', 'ParmController@getContact');
    Route::post('admin/api/edit_contact', 'ParmController@updateContact');
    Route::get('admin/api/news', 'ParmController@getNews');
    Route::post('admin/api/edit_news', 'ParmController@updateNews');
    Route::get('admin/api/exhibition_types', 'TypeController@index');
    Route::get('admin/api/exhibition_type', 'TypeController@show');
    Route::post('admin/api/add_exhibition_type', 'TypeController@store');
    Route::post('admin/api/edit_exhibition_type', 'TypeController@update');
    Route::post('admin/api/delete_exhibition_type', 'TypeController@destroy');
    Route::get('admin/api/links', 'QrcodeController@index');
    Route::get('admin/api/link', 'QrcodeController@show');
    Route::post('admin/api/add_link', 'QrcodeController@store');
    Route::post('admin/api/edit_link', 'QrcodeController@update');
    Route::post('admin/api/delete_link', 'QrcodeController@destroy');
});

Route::post('admin/api/login', 'AuthController@login');
Route::post('admin/api/signup', 'AuthController@signup');
// Auth::routes();
// Route::get('/home', 'HomeController@index')->name('home');
