<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['body','is_read','user_id','chat_id'];

    //Relacion inversa uno a muchos con la tabla chats
    public function chat()
    {
        return $this->belongsTo(Chat::class);
    }

    //Relacion inversa uno a muchos con la tabla users
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
