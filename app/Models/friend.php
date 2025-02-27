<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

    class friend extends Model
{
public function getAllUsers(){
    return User::all();
}
}
