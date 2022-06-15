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

// Route::get('/album','AlbumController@index');
// Route::get('/album/create','AlbumController@create')->name('album.create');
// Route::post('album/store',['uses' => 'AlbumController@store', 'as' => 'album.store' ]);
// Route::get('/album/edit/{id}','AlbumController@edit')->name('album.edit');
// Route::post('/album/update/{id}',['uses' => 'AlbumController@update','as' => 'album.update']);
// Route::get('/album/delete/{id}',['uses' => 'AlbumController@delete','as' => 'album.delete']);
// Route::get('/customer/restore/{id}',['uses' => 'CustomerController@restore','as' => 'customer.restore']);

Route::get('/images/customer/{filename}','CustomerController@displayImage')->name('image.displayImage');
// Route::resource('customer','CustomerController')->middleware('auth');

// Route::resource('customer','CustomerController')->middleware('auth');
// Route::resource('album','AlbumController')->middleware('auth');
// Route::resource('artist','ArtistController');
// Route::resource('listener','ListenerController');

Route::group(['middleware' => ['auth']], function () { 
Route::get('/customer/restore/{id}','CustomerController@restore')->name('customer.restore');
Route::resource('customer','CustomerController');
Route::resource('album','AlbumController');
Route::resource('artist','ArtistController');
Route::resource('listener','ListenerController');
});
Route::get('/listener/{search?}', [
      'uses' => 'ListenerController@index',
       'as' => 'listener.index'
]);
Route::get('/artist/{search?}', [
          'uses' => 'ArtistController@index',
           'as' => 'artist.index'
]);
Route::get('/album/{search?}', [
      'uses' => 'AlbumController@index',
       'as' => 'album.index'
]);
Route::get('/show-artist/{id}', [
      'uses' => 'ArtistController@show',
       'as' => 'getArtist'
    ]);
Route::get('/search/{search?}',['uses' => 'SearchController@search','as' => 'search']);
Route::resource('artist', 'ArtistController')->except(['index','artist']);
Route::resource('album', 'AlbumController')->except(['index']);
Route::resource('listener', 'ListenerController')->except(['index']);
Route::get('/artists', [
      'uses' => 'ArtistController@getArtists',
       'as' => 'getArtists'
    ]);
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

