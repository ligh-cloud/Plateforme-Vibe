<?php

namespace App\Http\Controllers;

use App\Models\comment;
use App\Models\post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class commentController extends Controller
{
    public function getComments(comment $comment){
        return $comment;
    }
    public function comment(Request $request , post $post)
    {
        $request->validate([
            'comment' => 'string|required|min:3|max:500'
        ]);
        comment::create([
            'id_post' => $post->id,
            'id_user' => Auth::id(),
            'comment' => trim($request->comment),
        ]);
        return back()->with('message' , 'comment added succesfully');
    }

}
