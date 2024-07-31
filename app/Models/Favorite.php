<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Favorite extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'product_id'];

    //terhubung ke tabel user
    public function user():BelongsTo {
        return $this->belongsTo(User::class);

    }

    //terhubung ke tabel product
    public function product():BelongsTo {
        return $this->belongsTo(Product::class);

    }
}

// done
