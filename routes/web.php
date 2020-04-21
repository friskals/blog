<?php
use App\Http\Controllers\Blog\PostsController;
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

Route::get('/', 'WelcomeController@index')->name('welcome');
Route::get('blog/post/{post}',[PostsController::class,'show'])->name('blog.show');
Route::get('blog/categories/{category}',[PostsController::class, 'category'])->name('blog.category');
Route::get('blog/tags/{tag}',[PostsController::class, 'tag'])->name('blog.tag');

Auth::routes();
    Route::middleware('auth')->group(function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::resource('categories', 'CategoryController');
    Route::resource('posts', 'PostController');
    Route::resource('tags', 'TagController');
    Route::get('trashed-post','PostController@trashed')->name('trashed-posts.index');
    Route::put('restore-post/{post}', 'PostController@restore')->name('restore-posts');

});

Route::middleware(['auth','admin'])->group(function(){
    Route::get('users','UsersController@index')->name('users.index');
    Route::post('users/{user}/make-admin', 'UsersController@makeAdmin')->name('users.make-admin');
    Route::get('users/profile', 'UsersController@editProfile')->name('users.edit-profile');
    Route::put('users/profile','UsersController@updateProfile')->name('users.update-profile');
});