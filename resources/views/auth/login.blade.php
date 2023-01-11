@extends('layouts.main')
@section('content')
    <!-- contact section starts  -->
    <section class="login">
        <h3 class="heading"> <span> Login </span> </h3>
        <div class="row">
            <div class="image">
                <img src="images/zahra-new-png.png" alt="">
            </div>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" placeholder="Your Email" class="box">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="password" placeholder="Password" class="box">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="submit" value="Login" class="btn">
                {{-- <a style="color: black;text-decoration:underline;font-size:12px;margin-top:5px"
                    href="{{ route('password.request') }}">Forget Your
                    Password?</a> --}}
                <div class="line"></div>
                <a href="{{ route('register') }}" class="btn">Register New User</a>
            </form>
        </div>

    </section>

    <!-- contact section ends -->
@endsection
