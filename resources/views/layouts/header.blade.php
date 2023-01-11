<!-- header section starts  -->

<header>

    <input type="checkbox" name="" id="toggler">
    <label for="toggler" class="fas fa-bars"></label>

    <a href="/" class="logo">Zahra<span>.</span></a>

    <nav class="navbar">
        <a href="/">home</a>
        <a href="/products">products</a>
        <a href="/#review">review</a>
        <a href="/#contact">contact</a>
    </nav>

    <div class="icons">
        <a href="{{ route('wishes') }}" class="fas fa-heart"></a>
        <a href="{{ route('cart') }}" class="fas fa-shopping-cart"></a>
        @if (Auth::user())
            <a href="{{ route('profile.edit') }}" class="fas fa-user"></a>
            <form method="POST" style="display: inline" action="{{ route('logout') }}">
                @csrf
                <button type="submit"><i class="fas fa-sign-out-alt"></i></button>
            </form>
        @else
            <a href="{{ route('login') }}" class="fas fa-user"></a>
        @endif
    </div>

</header>

<!-- header section ends -->
