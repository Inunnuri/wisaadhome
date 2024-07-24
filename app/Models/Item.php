<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Item extends Model
{
    use HasFactory;
    //Eager Loading by Default
    protected $with = ['user'];

    //relasi table user
    public function user():BelongsTo {
       return $this->belongsTo(User::class);
   }
   //terhubung ke tabel category
   public function category():BelongsTo {
    return $this->belongsTo(Category::class);

}

//relasi ke jenis
public function jenis():BelongsTo {
    return $this->belongsTo(Jenis::class);
}
}
