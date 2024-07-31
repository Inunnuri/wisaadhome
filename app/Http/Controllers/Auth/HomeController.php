<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Product;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Pilih hunian impianmu!';
        $posts = Post::orderBy('created_at', 'desc')->take(3)->get();
        $products= Product::orderBy('created_at', 'desc')->take(50)->get();
        $favorites = Favorite::where('user_id', Auth::id())->get();
        $favoriteProductIds = $favorites->pluck('product_id')->toArray();
        return view('home', compact('title', 'posts', 'products', 'favoriteProductIds'));
    }
}

// done
