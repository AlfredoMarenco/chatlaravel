<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Chat extends Model
{
    use HasFactory;

    //Mutadores
    public function name(): Attribute
    {
        return new Attribute(
            get:function($value){
                if ($this->is_group) {
                    return $value;
                }
                $user = $this->users->where('id','!=',auth()->id)->first();
                $contact = auth()->user()->contacts()->where('contact_id',$user->id)->first();

                return $contact ? $contact->name : $user->email;
             }
        );
    }

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
