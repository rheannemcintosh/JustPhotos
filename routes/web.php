<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\FollowerController;

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

Route::get('/', [FrontendController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('user/profile/{id}', [FrontendController::class, 'userAlbum'])->name('user.album');
Route::get('/albums/create', [AlbumController::class, 'create'])->name('album.create')->middleware('auth');
Route::post('/albums/store', [AlbumController::class, 'store'])->middleware('auth');

Route::post('/follow', [FollowerController::class, 'follow']);
Route::get('/profile', [FollowerController::class, 'profile'])->name('profile');

Route::get('/user/{id}', [FollowerController::class, 'getUserAvatar']);
Route::post('/profile-pic', [FollowerController::class, 'updateUserAvatar']);

Route::get('/albums', [AlbumController::class, 'index'])->middleware('auth');
Route::get('/getalbums', [AlbumController::class, 'getAlbums'])->middleware('auth');
Route::get('/getimages', [GalleryController::class, 'images'])->middleware('auth');

Route::put('/albums/{id}/edit', [AlbumController::class, 'update'])->middleware('auth');
Route::delete('/albums/{id}/delete', [AlbumController::class, 'destroy'])->middleware('auth');
Route::get('/upload/images/{id}', [GalleryController::class, 'create'])->middleware('auth');
Route::post('/uploadImage', [GalleryController::class, 'upload'])->middleware('auth');

Route::delete('/image/{id}', [GalleryController::class, 'destroy'])->middleware('auth');
Route::get('/albums/{slug}/{id}', [GalleryController::class, 'viewAlbum'])->name('view.album');