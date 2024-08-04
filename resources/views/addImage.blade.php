@extends('layouts.app')
@section('title', 'add image')
@section('content')

    <div class="containerProfilePic">
        <div class="input-group mb-3 profileForm">
            <form action="/update/image" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="formFileMultiple" class="form-label">
                </label>
                <input class="form-control" type="file" name="image" id="image" multiple>

                <input type="submit" name="submit" class="btn btn-primary btnCreate" value="Create" id="submit">
            </form>

        </div>
        @if ($user->image === 'Null' || $user->image === 'null')
            <h1>no photo to show</h1>
        @else
            <img class="prifileImg" src="/images/{{ $user->image }}" alt="profile pic">
        @endif
    </div>
    <div class="deleteImg">
        @if (auth()->check())
            <form action="/profile/delete/{{ $user->id }}" style="display: inline" method="POST">
                @csrf
                @method('DELETE')
                <input class="btn btn-danger" type="submit" value="Delete">
            </form>
            <a class="btn btn-dark" href="{{ route('posts.home') }}">Home</a>
        @endif
    </div>
@endsection
