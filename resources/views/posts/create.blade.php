@extends('layouts.app')
@section('title', 'Create Post')
@section('content')

    <form action="/post/store" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="contanierCreatePost">
            <div class="input-group mb-3">
                <label for="title" class="input-group-text" id="inputGroup-sizing-default">Title</label>
                <input type="text" class="form-control" name="title" id="title" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <label kjasbdkn AD Lj dl DLKn jWD for="description" class="input-group-text"
                    id="inputGroup-sizing-default">Description</label>
                <textarea type="text" class="form-control" name="description" id="description" aria-label="Sizing example input"
                    aria-describedby="inputGroup-sizing-default"></textarea>

            </div>
            <div class="input-group mb-3">
                <label for="formFileMultiple" class="form-label"></label>
                <input class="form-control" type="file" name="image" id="image" multiple>
            </div>
            <div class="tableCategoryTag">
                <table class="table tagcreatepost ">
                    <thead>
                        <tr>
                            <th scope="col">tag name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tags as $tag)
                            <tr>
                                <td> <label for="tag">{{ $tag->name }}</label>
                                    <input type="checkbox" value="{{ $tag->id }}" name="tags[]" id="tag">
                                </td>
                            </tr>
                    </tbody>
                    @endforeach
                </table>
                <table class="table categorycreatepost ">
                    <thead>
                        <tr>
                            <th scope="col">Category name</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($Category as $Categories)
                            <tr>
                                <td> <label for="Category">{{ $Categories->name }}</label>
                                    <input type="radio" value="{{ $Categories->id }}" name="Category" id="Category">
                                </td>
                            </tr>

                    </tbody>
                    @endforeach
                </table>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btnCreate" value="Create" id="submit">
        </div>

    </form>
@endsection
