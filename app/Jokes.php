<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jokes extends Model
{
    protected $fillable = ['title', 'body'];

    public function user()
    {
        return $this->belongsToMany(\App\User::class,'users_jokes');
    }
}
