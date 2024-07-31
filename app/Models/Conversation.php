<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Conversation extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'seller_id',
        'buyer_id',
    ];
    

    public function messages()
    {
        return $this->hasMany(Message::class, 'conversation_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class);
    }

    public function buyer()
    {
        return $this->belongsTo(User::class);
    }

    public function unreadMessagesCount()
    {
        // dimana pesan2 yang diterima oleh id yang sedang login, dan read_at dalam kondisi null artinya belum dibaca
        return $this->messages()->where('user_id', '!=', Auth::id())->whereNull('read_at')->count();
    }
}

// done
