<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use App\Models\Favorite;
use App\Models\Jenis;
use Illuminate\Support\Facades\Auth;


class ItemController extends Controller
{
    public function show(){
        $title = 'Pilih hunian impianmu!';
        $products= Product::orderBy('created_at', 'desc')->get();
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $favoriteProductIds = $favorites->pluck('product_id')->toArray();
        return view('item', compact('title', 'products', 'favoriteProductIds'));
    }

    //product sesuai nama user
    public function index(User $user)
    {
        $title = 'Diposting oleh ' . $user->name;
         // Mengambil produk yang diposting oleh pengguna
        $products = Product::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $favoriteProductIds = $favorites->pluck('product_id')->toArray();
        return view('item', compact('title', 'products', 'user', 'favoriteProductIds'));
    }

    //kategori
    public function category(Category $category)
    {
        $title = 'Kategori ' . $category->name;
        $products = Product::where('category_id', $category->id)->orderBy('created_at', 'desc')->get();
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $favoriteProductIds = $favorites->pluck('product_id')->toArray();
        return view('item', compact('title', 'products', 'favoriteProductIds'));
    }

    //kategori jenis
    public function jenis(Jenis $jenis)
    {
        $title = 'Kategori ' . $jenis->name;
        $products = Product::where('jenis_id', $jenis->id)->orderBy('created_at', 'desc')->get();
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $favoriteProductIds = $favorites->pluck('product_id')->toArray();
        return view('item', compact('title', 'products', 'favoriteProductIds'));
    }

    //produk detail
    public function detail(Product $product){
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $favoriteProductIds = $favorites->pluck('product_id')->toArray();
        return view('detail', compact( 'product', 'favoriteProductIds'));
    }
}

//done
