<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = ['name','image_url','is_group'];

    //Relacion muchos a muchos con tabla menssages
    public function messages()
    {
        return $this->belongsToMany(Message::class);
    }

    //Relacion uno a muchos con la tabla users
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
