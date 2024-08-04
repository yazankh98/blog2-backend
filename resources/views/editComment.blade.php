@extends('layouts.app')
@section('title', 'Edit Comment')
@section('content')

    <form class="editComment" action="/update/comment/{{$comment->id}}" method="POST">
        @csrf
        @method('PUT')
        <input type="text" name="commentUpdate" id="commentUpdate" value="{{ $comment->name }}">
        <input class="btn btn-primary" name="commentUpdate_submit" type="submit" value="Update">
    </form>

@endsection
