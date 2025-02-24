<?php

namespace App\Http\Controllers;

use App\Models\like;
use Illuminate\Http\Request;
use App\Models\post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user_id = Auth::id();
        $posts = Post::all();
        return view('posts', compact('posts', 'user_id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'content' => 'required|string'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('posts', 'public'); // Store in 'storage/app/public/posts'
        }
        Post::create($data);
        return back()->with('message' , 'post created succesfully');
    }
    public function like(Post $post)
    {
        $user_id = Auth::id();



        // Check if the user has already liked this post
        if (Like::where('user_id', $user_id)->where('post_id', $post->id)->exists()) {
            return back()->with('message', 'You have already liked this post.');
        }
//        dd($post->id);
        // Create the like
        $id = $post->id;

//        dd($id);
        Like::create([
            'user_id' => $user_id,
            'post_id' => $id,
        ]);


        return back()->with('message', 'Post liked successfully.');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
