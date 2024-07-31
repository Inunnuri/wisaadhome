<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jenis extends Model
{
    use HasFactory;
    //terhubung ke product
    public function product(): HasMany{
        return $this->hasMany(Product::class,'jenis_id');
    }
}

// done
