<?php

use App\Models\Post;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoriesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    // $posts = Post::all();
    $posts = Post::where('user_id',auth()->id())->latest()->get();
    // $posts = auth()->user()->usersCoolPosts()->latest()->get(); /// getting posts of only logged in user
    return view('home',['posts'=>$posts]);
});

Route::post('/register', [UserController::class, 'register'])->name('register');


Route::post('/logout',[UserController::class,'logout'])->name('logout');
Route::post('/login',[UserController::class,'login']);


Route::post('/create-post',[PostController::class,'createPost']);


Route::get('/edit-post/{post}',[PostController::class,'showEditScreen']);
Route::put('/edit-post/{post}',[PostController::class,'actuallyUpdatePost']);


Route::delete('delete-post/{post}',[PostController::class,'deletePost']);

Route::get('/viewcategory',[CategoriesController::class,'index']);
Route::post('/create-category', [CategoriesController::class, 'create']);
Route::delete('/delete-category/{id}', [CategoriesController::class, 'destroy']);
Route::put('/update-category/{id}', [CategoriesController::class, 'update']);


Route::get('/viewtag',[TagsController::class,'index']);

Route::post('/create-tag',[TagsController::class,'create']);
Route::delete('/delete-tag/{id}', [TagsController::class, 'destroy']);
Route::put('/update-tag/{id}', [TagsController::class, 'update']);

Route::get('/categories', [CategoriesController::class, 'show'])->name('categories.show');


Route::get('/home', [TagsController::class, 'show'])->name('home');