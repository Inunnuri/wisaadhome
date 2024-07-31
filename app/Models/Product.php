<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','category_id','nama', 'jenis_id','price', 'alamat', 'description','post_photo',
    ];

     //Eager Loading by Default
     protected $with = ['user', 'category'];

     //relasi table users
     public function user():BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    //terhubung ke tabel categories
    public function category():BelongsTo {
        return $this->belongsTo(Category::class);

    }

    //terhubung ke tabel jenis
    public function jenis():BelongsTo {
        return $this->belongsTo(Jenis::class);

    }
    // relasi tabel favorites
    public function favoritedBy()
    {
        return $this->hasMany(Favorite::class,'product_id');
    }

    public function conversations(): HasMany
    {
        return $this->hasMany(Conversation::class, 'product_id');
    }
}

// done
