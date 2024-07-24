<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id','name', 'email','country', 'street_address', 'city', 'region', 'postal_code', 'about','profile_photo',
    ];

     //Eager Loading by Default
     protected $with = ['user'];

    protected $attributes = [
        'profile_photo' => 'default.jpg',
    ];
    //relasi table user
    public function user():BelongsTo {
        return $this->belongsTo(User::class);
    }
}
