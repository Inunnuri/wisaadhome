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
Route::get('conversations/{id}', [ConversationController::class, 'show'])->name('conversations.show');
Route::post('conversations/{id}/messages', [MessageController::class, 'store'])->name('messages.store');
Route::get('conversations/create/{productId}/{buyerId}', [ConversationController::class, 'create'])->name('conversations.create');
Route::get('conversations/create/{productId}', [ConversationController::class, 'create'])->name('conversations.create');



//Route Favorite
Route::get('/favorite', [FavoriteController::class, 'show'])->name('favorite.show');
Route::post('/favorite/add/{productId}', [FavoriteController::class, 'add'])->name('favorite.add');
Route::delete('/favorite/remove/{productId}', [FavoriteController::class, 'destroy'])->name('favorite.remove');


//Route item
Route::get('/item', [ItemController::class, 'show']);
Route::get('/item/user/{user:name}', [ItemController::class, 'index'])->name('item.index');
Route::get('/item/category/{category:name}', [ItemController::class, 'category'])->name('item.category');
Route::get('/item/jenis/{jenis:name}', [ItemController::class, 'jenis'])->name('item.jenis');
//rute detail product
Route::get('/item/detail/{product:id}', [ItemController::class,'detail'])->name('detail');

//search
Route::get('/search', [SearchController::class, 'search'])->name('search');


//Route my Product
// Rute untuk halaman home yang menampilkan 50 produk terbaru
Route::get('/home', [ProductController::class, 'home'])->name('product.home');
// Rute untuk menampilkan produk milik pengguna yang sedang login
Route::get('/product', [ProductController::class, 'index'])->name('product.index');
Route::get('/product', [ProductController::class, 'showProductForm'])->name('add.show');
Route::post('/product', [ProductController::class, 'add'])->name('add.product');
Route::put('/product/{id}/edit', [ProductController::class, 'edit'])->name('edit.product');
Route::delete('/delete-product/{id}', [ProductController::class, 'destroy'])->name('product.destroy');


//Route Posts
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/post/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::get('/authors/{user:name}', function (User $user) {
    return view('posts', ['title' => count($user->posts) . ' Articles by '. $user->name,'posts' =>$user->posts]);
});
Route::get('/categories/{category:slug}', function (Category $category) {
    return view('posts', ['title' => 'Articles in '. $category->name,'posts' =>$category->posts]);
});


     //Route profile
Route::get('/profile', [ProfileController::class, 'showProfileForm'])->name('profile.show');
//Setelah pengguna mengisi dan mengirimkan formulir pengeditan profil, permintaan PUT akan dikirim ke /profile. Rute profile.update memanggil metode update yang memvalidasi dan memperbarui informasi profil pengguna dalam database, kemudian mengalihkan kembali ke halaman profil dengan pesan sukses.
Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');



     //Route Home
Route::get('/',[HomeController::class, 'index'])->name('home');

    // Rute registrasi
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);


    // Rute login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'signout'])->name('logout');


    // Rute logout
Route::middleware(['auth'])->group (function (){
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});