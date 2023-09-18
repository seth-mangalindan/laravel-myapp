<?php

use App\Models\Post;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Spatie\YamlFrontMatter\YamlFrontMatter;

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
    
  return view('posts', [ 
    'posts' => Post::latest()->get(),
    'categories' => Category::all()
]); 
    
})->name('home');

Route::get('posts/{post:slug}', function (Post $post) {

  //  $path = __DIR__ . "/../resources/posts/{$slug}.html";
    return view('post', [
        'post' => $post
    ]);
});

Route::get('categories/{category:slug}', function(Category $category) {

    return view('posts', [
      'posts' => $category->posts,
      'currentCategory' => $category,
      'categories' => Category::all()
    ]);
})->name('category');

Route::get('author/{author:username}', function(User $author) {

  return view('posts', [
    'posts' => $author->posts,
    'categories' => Category::all()
  ]);
});
/*
 '/' always home page
 route connects to view'
 get('endpoint')
 route can return string/json/view function
$slug pertain on endpoint at this snippet
slug is a unique identifier
*/