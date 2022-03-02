<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'sender_id',
        'message',
    ];

    public function senderUser(){
        return $this->hasOne(User::class, 'id', 'sender_id');
    }

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
