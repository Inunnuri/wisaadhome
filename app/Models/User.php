<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //$fillable: Daftar atribut yang dapat diisi secara massal. Ini melindungi aplikasi dari serangan Mass Assignment Vulnerability dengan menentukan atribut mana yang bisa diisi oleh pengguna.
    protected $fillable = [
        'username',
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    //$hidden: Atribut yang disembunyikan saat model diserialisasi. Dalam hal ini, password dan remember_token tidak akan ditampilkan dalam output JSON.
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    //$casts: Menentukan bagaimana atribut harus dikonversi. email_verified_at dikonversi menjadi instance datetime, dan password dikonversi menggunakan metode hashing.
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    //relasi ke tabel profiles
    public function profile(): HasOne
    {
        return $this->hasOne(Profile::class, 'user_id');
    }

    //relation ke posts
    public function posts(): HasMany{
        return $this->hasMany(Post::class,'author_id');
    }
    //relation ke products
    public function products(): HasMany{
        return $this->hasMany(Product::class, 'user_id');
    }

    //relation ke favorite
    public function favorites(): HasMany{
        return $this->hasMany(Favorite::class,'user_id');
    }

    // Relasi dengan model conversations
    public function seller()
    {
        return $this->hasMany(Conversation::class, 'seller_id');
    }

    public function buyer()
    {
        return $this->hasMany(Conversation::class, 'buyer_id');
    }

    // relasi tabel messages
    public function messages()
    {
        return $this->hasMany(Message::class, 'user_id');
    }
}

// done