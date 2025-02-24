<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class post extends Model
{
    protected $fillable = ['image' , 'content'];

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
}
