<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Favorite;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


class SearchController extends Controller
{
    public function search(Request $request)
    {
        $title = 'Search Results';
        $query = $request->input('query');
        $userId = Auth::id();

        if (empty($query)) {
            return redirect()->back()->with('status', 'Masukkan kata kunci untuk pencarian.');
        }

        // Pencarian produk
        $items = Product::where('nama', 'LIKE', "%{$query}%")
        ->orWhere('price', 'LIKE', "%{$query}%")
        ->get();

          // Pencarian produk favorit berdasarkan product_id
        $favoriteProductIds = Favorite::where('user_id', $userId)
                                      ->pluck('product_id')
                                      ->toArray();
        $favorites = Product::whereIn('id', $favoriteProductIds)
                            ->where(function($q) use ($query) {
                                $q->where('nama', 'LIKE', "%{$query}%")
                                  ->orWhere('price', 'LIKE', "%{$query}%");
                            })
                            ->get();

        // Pencarian produk saya
        $products = Product::where('user_id', $userId)
                             ->where(function($q) use ($query) {
                                 $q->where('nama', 'LIKE', "%{$query}%")
                                   ->orWhere('price', 'LIKE', "%{$query}%");
                             })
                             ->get();

        // Pencarian posts
        $posts = Post::where('title', 'LIKE', "%{$query}%")
                      ->orWhere('body', 'LIKE', "%{$query}%")
                      ->get();

        return view('search', compact('products', 'posts', 'query', 'title', 'favoriteProductIds', 'favorites', 'items'));
    }
}

//done
