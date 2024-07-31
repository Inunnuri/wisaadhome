<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\Conversation;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class ConversationController extends Controller
{
    //Menampilkan daftar semua percakapan yang terkait dengan pengguna yang sedang login.
    public function index()
    {
        $conversations = Conversation::with('product', 'seller', 'buyer')
            ->where('seller_id', Auth::id())
            ->orWhere('buyer_id', Auth::id())
            ->get();

        return view('conversations.index', compact('conversations'));
    }

    //Menampilkan detail percakapan tertentu dan memperbarui status baca pesan jika diperlukan.
    public function show($id)
    {
        $conversation = Conversation::with('messages.user')
            ->findOrFail($id);
         // Perbarui pesan yang belum dibaca
         foreach ($conversation->messages as $message) {
            if ($message->user_id !== Auth::id() && $message->read_at === null) {
                $message->update(['read_at' => now()]);
            }
        }

        return view('conversations.show', compact('conversation'));
    }

    //Membuat percakapan baru atau menemukan percakapan yang sudah ada untuk produk tertentu antara pengguna yang sedang login dan penjual.
    public function create($productId)
    {
        $product = Product::findOrFail($productId);
        $seller = $product->user;

        if (Auth::id() === $seller->id) {
            return redirect()->route('conversations.index')->with('error', 'You cannot chat with yourself.');
        }

        $conversation = Conversation::firstOrCreate([
            'product_id' => $productId,
            'seller_id' => $seller->id,
            'buyer_id' => Auth::id(),
        ]);

        return redirect()->route('conversations.show', $conversation->id);
    }
}

// done
