@extends('layouts.app')
@section('title', 'register')
@section('content')

    <div class="loginContainer">
        <div class="login">
            <form action="{{ route('register') }}" method="POST">
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
                        <input type="submit" class="btn  btn-singup" name="singup" id="singup" value="Sing Up">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection
