@extends('layouts.app')
@section('title', 'Home')
@section('content')

    <nav class="navbar navbar-expand-lg bg-light">
        <div class="container-fluid">
            <a class="navbar-brand disabled" href="#" @disabled(true)>Blog</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('posts.home') }}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/post/create">Create post</a>
                    </li>
                    <li>
                        @auth
                            @can('manageUsers', App\Models\User::class)
                                <a class="btn  btn-danger" href="{{ route('add.tags') }}">add tags</a>
                                <a class="btn  btn-danger" href="{{ route('add.category') }}">add category</a>
                                <a class="btn  btn-danger" href="{{ route('mange.users') }}">manage Users</a>
                            @endcan
                        @endauth
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">logout</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="profilepic">
            <img src="/images/{{ $user->image }}" alt="">
        </div>
        <div>
            @if (auth()->check())
                <a class="btn btn-primary" href="/profile/image">add photo to your profile or delete photo</a>
            @endif
        </div>
    </nav>

    <div class="containerCards">
        @forelse ($posts as $post)
            <div class="card d-flex p-2 cards " style="width: 18rem;">

                <img class="cardImage" src="/images/{{ $post->image }}" class="card-img-top" alt="...">
                <div class="card-body ">

                    <div class="input-group mb-3">

                        <label for="title" class="input-group-text" id="inputGroup-sizing-default">Title</label>
                        <input type="text" class="form-control" name="title" id="title"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            value="{{ $post->title }}" disabled>
                    </div>
                    <div class="input-group mb-3">
                        <label for="category" class="input-group-text" id="inputGroup-sizing-default">Category</label>
                        <input type="text" class="form-control" name="category" id="category"
                            aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"
                            value="{{ $post->category->name }}" disabled>
                    </div>

                    <a href="/post/show/{{ $post->id }}"><button type="button"
                            class="btn btn-success">Show</button></a>
                    @if (auth()->check() && auth()->user()->can('update', $post))
                        <a href="/post/edit/{{ $post->id }}"><button type="button"
                                class="btn btn-primary">Edit</button></a>
                    @endif
                    @if (auth()->check() && auth()->user()->can('delete', $post))
                        <form action="/post/delete/{{ $post->id }}" style="display: inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                    @endif

                    <h5>Comments:</h5>
                    @forelse ($comment as $comments)
                        @if ($post->id == $comments->post_id)
                            <div class="containerComment">


                                <p> <b>{{ $comments->user->name }} :</b>
                                    @if ($comments->post_id == $post->id)
                                        {{ $comments->name }}
                                </p>
                                @if (auth()->check() && auth()->user()->can('delete', $comments))
                                    <form action="/comment/delete/{{ $comments->id }}" style="display: inline"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input class="btn btn-danger" type="submit" value="Delete">
                                    </form>
                                @endif
                                @if (auth()->check() && auth()->user()->can('update', $comments))
                                    <a href="/comment/edit/{{ $comments->id }}"><button type="button"
                                            class="btn btn-primary">Edit</button></a>
                                @endif
                        @endif
                </div>
        @endif
    @empty
        <h5>No Commente Yet</h5>
        @endforelse

        <form action="/comment/store/{{ $post->id }}" method="post">
            @csrf
            @if (auth()->check())
                <input type="text" name="comment" id="comment" placeholder="add comment">
                <input type="submit" name="comment_submit" value="add" id="comment_submit">
            @endif

        </form>
    </div>
    </div>






@empty
    <h5 class="noPOST">There are no posts</h5>
    @endforelse
    </div>

@endsection
