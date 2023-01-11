@extends('layouts.main')
@section('content')
    <!-- contact section starts  -->
    <section class="login">
        <h3 class="heading" style="background-color: transparent"></h3>
        <div class="row">
            <form method="POST" action="{{ route('password.email') }}">
                @csrf
                <div style="font-size: 15px;color:rgba(0,0,0,.6);padding:10px 0">
                    Forgot your password? No problem. Just let us know your email address and we will email you a password
                    reset link that will allow you to choose a new one.
                </div>

                <input type="email" name="email" value="{{ old('email') }}" placeholder="Your Email" class="box">
                <input type="submit" value="Email Password Reset Link" class="btn">
            </form>
        </div>

    </section>

    <!-- contact section ends -->
@endsection
