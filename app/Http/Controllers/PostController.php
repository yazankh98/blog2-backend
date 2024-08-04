<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Mailer\Transport\Dsn;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Post::class);

        $id = auth()->user()->id;
        $user = User::where('id', $id)->first();
        $post = Post::with('user')->get();
        $comment = Comment::with('user')->get();

        return view('posts.home', compact(['user', 'comment']))->with('posts', $post);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Post::class);
        $tag = Tag::all();
        $Category = Category::all();

        return view('posts.create', compact('Category'))->with('tags', $tag);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                "title" => "required|string",
                "description" => "required | string",
                "image" => "required | image"
            ]
        );
        $post = new Post;

        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }

        $post = [
            "title" => $request['title'],
            "description" => $request['description'],
            "image" => $imageName,
            "category_id" => $request['Category'],
        ];

        auth()->user()->posts()->create($post)->tags()->attach($request->tags);

        return redirect()->route('posts.home')->with("success", "post add");
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)

    {
        $this->authorize('view', $post);

        $tags = $post->Tags()->get();
        return view('posts.show', compact('tags'))->with("post", $post);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $this->authorize('edit', $post);
        $Category = Category::all();
        $Tag = Tag::all();
        return view('posts.edit', compact(['Category', 'Tag']))->with("post", $post);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            "title" => 'string',
            "image" => ' image',
            "description" => 'string',
            'category_id' => 'numeric',
            'user_id' => 'numeric'
        ]);
        $imageName = $post->image;
        if ($request->hasFile('image')) {
            $image = $request['image'];
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
        }
        $postData = ([
            "title" => $request['title'],
            "description" => $request['description'],
            "image" => $imageName,
            "category_id" => $request['Category'],
        ]);
        $post->update($postData);
        $post->tags()->sync($request->tags);
        return redirect()->route('posts.home')->with("success", "post update");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.home')->with("succss", "the item deleted");
    }
}
