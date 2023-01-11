@extends('layouts.main')
@section('content')
    <section class="login">
        <h3 class="heading"> <span> Register </span> </h3>
        <div class="row">
            <div class="image">
                <img src="images/zahra-new-png.png" alt="">
            </div>
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <input type="name" name="name" value="{{ old('name') }}" placeholder="Your Name" class="box">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" class="box">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" name="password" value="{{ old('password') }}" placeholder="Password" class="box">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="password" value="{{ old('password_confirmation') }}" name="password_confirmation"
                    placeholder="Confirm Password" class="box">
                @error('password_confirmation')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="submit" value="Register" class="btn">
                <div class="line"></div>
                <a href="{{ route('login') }}" class="btn">Login</a>
            </form>
        </div>
    </section>
@endsection
