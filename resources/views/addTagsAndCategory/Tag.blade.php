@extends('layouts.app')
@section('title', 'Tag')
@section('content')

    <form action="/tag/store" method="POST">
        @csrf
        <div class="contanierCreatePost">
            <div class="input-group mb-3">
                <label for="title" class="input-group-text" id="inputGroup-sizing-default">Tag Name</label>
                <input type="text" class="form-control" name="title" id="title" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default">
            </div>

            <input type="submit" name="submit" class="btn btn-primary btnCreate" value="Create" id="submit">
            <a class="btn btn-dark" href="{{route('posts.home')}}">Home</a>
        </div>
    </form>
    
        <table class="table tagstable">
            <thead>
                <tr>
                    <th scope="col">tag name</th>
                    <th scope="col">action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tags as $tag)
                <tr>
                    <td>{{ $tag->name }}</td>
                    <td>
                        <form action="/tag/delete/{{ $tag->id }}" style="display: inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                    </td>
                </tr>

            </tbody>
            @empty
            <h1 class="notags" >no tags to show</h1>
        @endforelse
        </table>
        
@endsection
