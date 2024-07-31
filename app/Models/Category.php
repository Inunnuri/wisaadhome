<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    //terhubung ke tabel posts
    public function posts(): HasMany{
        return $this->hasMany(Post::class,'category_id');
    }
    //terhubung ke tabel products
    public function product(): HasMany{
        return $this->hasMany(Product::class,'category_id');
    }
}

// done