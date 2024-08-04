@extends('layouts.app')
@section('title', 'category')
@section('content')

    <form action="/Category/store" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="contanierCreatePost">
            <div class="input-group mb-3">
                <label for="title" class="input-group-text" id="inputGroup-sizing-default">category Name</label>
                <input type="text" class="form-control" name="title" id="title" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <label for="formFileMultiple" class="form-label"></label>
                <input class="form-control" type="file" name="image" id="image" multiple>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btnCreate" value="Create" id="submit">
            <a class="btn btn-dark" href="{{ route('posts.home') }}">Home</a>
        </div>
    </form>

    <table class="table tagstable">
        <thead>
            <tr>
                <th scope="col">category name</th>
                <th scope="col">action</th>
                <th scope="col">image</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($Categories as $Category)
                <tr>
                    <td>{{ $Category->name }}</td>
                    <td>
                        <form action="/Category/delete/{{ $Category->id }}" style="display: inline" method="POST">
                            @csrf
                            @method('DELETE')
                            <input class="btn btn-danger" type="submit" value="Delete">
                        </form>
                        <a href="/Category/edit/{{ $Category->id }}"><button type="button"
                                class="btn btn-primary">Edit</button></a>
                    </td>
                    <td><img class="categoryImg" src="/images/{{ $Category->image }}" alt=""></td>
                </tr>

        </tbody>
    @empty
        <h1 class="notags">no Category to show</h1>
        @endforelse
    </table>


@endsection
