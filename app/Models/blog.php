<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class blog extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'short_description', 'long_description', 'user_id',];



    public function user(){

        return $this->belongsTo(User::class);
    }


    public function comments(){
        return $this->hasMany(Comment::class);
    }
}
