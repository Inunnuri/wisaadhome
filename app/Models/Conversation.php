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
        return $this->hasMany(Message::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }

    public function unreadMessagesCount()
    {
        return $this->messages()->where('user_id', '!=', Auth::id())->whereNull('read_at')->count();
    }
}
