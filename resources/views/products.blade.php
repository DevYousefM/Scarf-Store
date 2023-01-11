@extends('layouts.main')
@section('content')
    <!-- prodcuts section starts  -->
    <section class="products" id="products">
        <h1 class="heading" style="margin-top: 8rem;"> latest <span>products</span> </h1>
        <div class="box-container">
            @isset($products)
                @foreach ($products as $item)
                    <?php
                    $price = $item->price;
                    $dis_price = ($price * $item->discount) / 100;
                    $last = $price - $dis_price;
                    ?>
                    <div class="box">
                        <span class="discount">{{ $item->discount }}%</span>
                        <a class="like" href="{{ route('likes', $item->id) }}">
                            {{ $item->likes }}
                            <i class="fas fa-thumbs-up"></i>
                        </a>
                        <div class="image">
                            <img src="{{ asset("$item->image") }}" alt="">
                            <div class="icons">
                                <a href="{{ route('add_wish', $item->id) }}" class="fas fa-heart"></a>
                                <a href="{{ route('add_cart', $item->id) }}" class="cart-btn">add to cart</a>
                                <div>
                                    <a class="fab fa-facebook"></a>
                                    <a class="fab fa-whatsapp"></a>
                                    <a class="fab fa-instagram"></a>
                                </div>                            </div>
                        </div>
                        <div class="content">
                            <h3>{{ $item->title }}</h3>
                            <div class="price"> $<?= $last ?> <span>$<?= $price ?></span> </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
        <div style="width:100%">
            <div class="d-flex justify-content-center" style="display: flex;justify-content:center">
                {{ $products->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </section>

    <!-- prodcuts section ends -->

    <!-- footer section starts  -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>quick links</h3>
                <a href="/">home</a>
                <a href="#">about</a>
                <a href="/products">products</a>
                <a href="/#review">review</a>
                <a href="/#contact">contact</a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="#">my account</a>
                <a href="#">my order</a>
                <a href="#">my favorite</a>
            </div>

            <div class="box">
                <h3>locations</h3>
                <a href="#">india</a>
                <a href="#">USA</a>
                <a href="#">japan</a>
                <a href="#">france</a>
            </div>

            <div class="box">
                <h3>contact info</h3>
                <a href="#">+123-456-7890</a>
                <a href="#">example@gmail.com</a>
                <a href="#">mumbai, india - 400104</a>
                <img src="images/payment.png" alt="">
            </div>

        </div>

        <div class="credit"> created by | all rights reserved </div>

    </section>

    <!-- footer section ends -->
@endsection
