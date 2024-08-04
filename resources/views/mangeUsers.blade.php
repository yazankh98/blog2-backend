@extends('layouts.app')
@section('title', 'mange users')
@section('content')

    <table class="table tagstable">
        <thead>
            <tr>
                <th scope="col"> name</th>
                <th scope="col">email</th>
                <th scope="col">block</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->is_block === 0)
                            <form action="/block/user/{{ $user->id }}" style="display: inline" method="POST">
                                @csrf
                                @method('PUT')
                                <input class="btn btn-danger" type="submit" value="Block">
                            </form>
                        @else
                            <form action="/unblock/user/{{ $user->id }}" style="display: inline" method="POST">
                                @csrf
                                @method('PUT')
                                <input class="btn btn-primary" type="submit" value="UnBlock">
                            </form>
                        @endif

                    </td>

                </tr>

        </tbody>
    @empty
        <h1 class="notags">no users to show</h1>
        @endforelse
    </table>
    <a class="btn btn-dark" href="{{ route('posts.home') }}">Home</a>
    <div class="loginContainer">
        
        <div class="login">
            <h5 style="text-align: center; color:green" >Add New User</h5>
            <form action="{{ route('register.by.admin') }}" method="POST">
                @csrf
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <input class="input form-control" type="text" name="name" id="name"
                            placeholder=" Enter Your Name">
                        <input class="input form-control" type="email" name="email" id="email"
                            placeholder=" Enter Your Email">
                        <input class="input form-control" type="password" name="password" id="password"
                            placeholder=" Enter Your password">
                        <input class="input form-control" type="password" name="password_confirmation" id="password"
                            placeholder=" Re-type Your password">
                        <hr>
                        <input type="submit" class="btn  btn-singup" name="singup" id="singup" value="Register">
                    </div>
                </div>
            </form>
        </div>
    </div>
   

@endsection
