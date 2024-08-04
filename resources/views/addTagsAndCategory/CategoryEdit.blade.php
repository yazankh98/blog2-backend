@extends('layouts.app')
@section('title', 'Edit Category')
@section('content')

    <form action="/Category/update/{{$category->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="contanierCreatePost">
            <div class="input-group mb-3">
                <label for="title" class="input-group-text" id="inputGroup-sizing-default">category Name</label>
                <input type="text" class="form-control" name="title" id="title" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default" value="{{ $category->name }}">
            </div>
            <div class="input-group mb-3">
                <label for="formFileMultiple" class="form-label"></label>
                <input class="form-control" type="file" name="image" id="image" multiple>
            </div>
            <img class="prifileImg" src="/images/{{ $category->image }}" alt="">
            <input type="submit" name="submit" class="btn btn-primary btnCreate" value="Update" id="submit">
            <a class="btn btn-dark" href="{{ route('add.category') }}">Back</a>
        </div>
    </form>
@endsection
