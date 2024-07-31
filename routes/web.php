<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\Auth\ProfileController;
use App\Models\User; 
use App\Models\Category;
use App\Http\Controllers\Auth\ProductController;
use App\Http\Controllers\Auth\ItemController;
use App\Http\Controllers\Auth\FavoriteController;
use App\Http\Controllers\Auth\PostController;
use App\Http\Controllers\Auth\MessageController;
use App\Http\Controllers\Auth\ConversationController;
use App\Http\Controllers\Auth\SearchController;


//Route Message
//Menampilkan daftar semua percakapan yang terkait dengan pengguna yang sedang login.
Route::get('conversations', [ConversationController::class, 'index'])->name('conversations.index');
//Menampilkan detail percakapan tertentu
Route::get('conversations/{id}', [ConversationController::class, 'show'])->name('conversations.show');
//menyimpan pesan
Route::post('conversations/{id}/messages', [MessageController::class, 'store'])->name('messages.store');
//permintaan untuk membuat percakapan baru
Route::get('conversations/create/{productId}', [ConversationController::class, 'create'])->name('conversations.create');



//Route Favorite
Route::get('favorite', [FavoriteController::class, 'show'])->name('favorite.show');
Route::post('favorite/add/{productId}', [FavoriteController::class, 'add'])->name('favorite.add');
Route::delete('favorite/remove/{productId}', [FavoriteController::class, 'destroy'])->name('favorite.remove');


//Route item (product)
Route::get('item', [ItemController::class, 'show'])->name('item');
////product sesuai nama user
Route::get('item/user/{user:name}', [ItemController::class, 'index'])->name('item.index');
Route::get('item/category/{category:name}', [ItemController::class, 'category'])->name('item.category');
Route::get('item/jenis/{jenis:name}', [ItemController::class, 'jenis'])->name('item.jenis');
//rute detail product
Route::get('item/detail/{product:id}', [ItemController::class,'detail'])->name('detail');


//Route search
Route::get('search', [SearchController::class, 'search'])->name('search');


//Route my Product
// Rute untuk menampilkan produk milik pengguna yang sedang login
Route::get('products', [ProductController::class, 'index'])->name('product.index');
 //menampilkan form
Route::get('product/create', [ProductController::class, 'showProductForm'])->name('add.show');
Route::post('product', [ProductController::class, 'add'])->name('add.product');
Route::put('product/{id}/edit', [ProductController::class, 'edit'])->name('edit.product');
Route::delete('product/delete/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


//Route Posts
Route::get('posts', [PostController::class, 'index'])->name('posts.index');
Route::get('post/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('authors/{user:name}', [PostController::class, 'author'])->name('author.posts');
Route::get('categories/{category:name}', [PostController::class, 'category'])->name('category.posts');


//Route profile
Route::get('profile', [ProfileController::class, 'showProfileForm'])->name('profile.show');
Route::put('profile-update', [ProfileController::class, 'update'])->name('profile.update');



//Route Home
Route::get('/',[HomeController::class, 'index'])->name('home');

// Rute registrasi
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register/new', [RegisterController::class, 'register'])->name('register.new');


// Rute login
Route::get('login/index', [LoginController::class, 'index'])->name('login.index');
Route::get('login/form', [LoginController::class, 'showLoginForm'])->name('login.form');
Route::post('login', [LoginController::class, 'login'])->name('login');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');