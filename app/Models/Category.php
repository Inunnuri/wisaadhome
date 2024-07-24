<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    //terhubung ke post
    public function posts(): HasMany{
        return $this->hasMany(Post::class,'category_id');
    }
    //terhubung ke product
    public function product(): HasMany{
        return $this->hasMany(Product::class);
    }

    //terhubung ke item
    public function item(): HasMany{
        return $this->hasMany(Item::class);
    }
}
