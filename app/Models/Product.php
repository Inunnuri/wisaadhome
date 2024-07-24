<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','category_id','nama', 'jenis_id','price', 'alamat', 'description','post_photo',
    ];

    // Nama tabel yang digunakan oleh model ini
    protected $table = 'products';

     //Eager Loading by Default
     protected $with = ['user', 'category'];

     //relasi table user
     public function user():BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    //terhubung ke tabel category
    public function category():BelongsTo {
        return $this->belongsTo(Category::class);

    }

    //terhubung ke tabel jenis
    public function jenis():BelongsTo {
        return $this->belongsTo(Jenis::class);

    }

    public function favoritedBy()
    {
        return $this->hasMany(Favorite::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
