<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $post = Post::all();
        $comment = Comment::with('user')->get();
        $data = [
            $comment,
            $post
        ];
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = User::where('remember_token', $request->bearerToken())->first();

        $request->validate([
            "title" => 'required|string|max:50',
            "description" => 'required|string',
            "image" => 'required|image'
        ]);
        $post = new Post();
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->image = $imageName;
        $post->category_id = $request['Category'];
        $post->user_id = $user->id;

        $user->posts()->save($post)->tags()->attach($request->tags);
        return response()->json(['message' => 'succssfully'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {

        $tags = $post->Tags()->get();
        $Alltagss = "";
        foreach ($tags as $tag) {
            $Alltagss = $tag['name'] . "/" . $Alltagss;
        }
        $data = [
            $Alltagss,
            $post
        ];
        return response()->json(['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title" => 'string|max:50',
            "description" => 'string',
            "image" => 'image',
        ]);
        $user = User::where('remember_token', $request->bearerToken())->first();
        $imageName  = $post['image'];
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }
        $post->title = $request['title'];
        $post->description = $request['description'];
        $post->image = $imageName;
        $post->category_id = $request['Category'];
        $post->user_id = $user->id;

        $user->posts()->save($post)->tags()->sync($request->tags);
        return response()->json(['message' => 'succssfully'], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(["message" => "the post deleted"]);
    }
}
