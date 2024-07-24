<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;
use App\Models\Product;

class FavoriteController extends Controller
{
    public function show() {
        $title = 'My Favorite';
        $userId = Auth::id();
        $favorites = Favorite::with('product')->where('user_id', $userId)->get();
        
        // Dapatkan daftar produk favorit berdasarkan user_id
        $favoriteProductIds = $favorites->pluck('product_id')->toArray();
        $products = Product::whereIn('id', $favoriteProductIds)->get();
        
        return view('favorite', compact('title', 'favorites', 'favoriteProductIds', 'products'));
    }
    public function add(Request $request, $productId) {
        $request->validate([
            'product_id' => 'exists:products,id',
        ]);

        Favorite::create([
            'user_id' => Auth::id(),
            'product_id' => $productId,
        ]);

    
        return redirect()->back()->with('success', 'Product added to favorites');
    }

    public function destroy($productId)
    {
        $favorite = Favorite::where('user_id', Auth::id())
                            ->where('product_id', $productId)
                            ->first();

        if ($favorite) {
            $favorite->delete();
        }

        return redirect()->back()->with('success', 'Product removed from favorites');
    }
}
