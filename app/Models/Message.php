<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $fillable = [
        'conversation_id',
        'user_id',
        'message',
        'read_at'
    ];

    // $dates, Laravel secara otomatis akan memparsing nilai dari kolom tersebut sebagai objek Carbon saat diakses. Ini sangat berguna untuk kolom-kolom yang menyimpan informasi tanggal, seperti created_at, updated_at, deleted_at, atau kolom khusus lainnya seperti read_at dalam kasus Anda.
    protected $dates = [
        'read_at',
    ];

    public function conversation()
    {
        return $this->belongsTo(Conversation::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

// done
