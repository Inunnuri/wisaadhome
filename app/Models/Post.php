<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    protected $fillable= ['title', 'author', 'slug', 'body'];

    //Eager Loading by Default
    protected $with = ['author', 'category'];

    //relasi table user
    public function author():BelongsTo {
        return $this->belongsTo(User::class);

    }
    //terhubung ke tabel categories
    public function category():BelongsTo {
        return $this->belongsTo(Category::class);

    }
}

// done
