<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class like extends Model
{
    protected $fillable = ['user_id', 'post_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function numberLike($post){
        $likeCount = Like::where('post_id', $post->id)->count();

    }
}
