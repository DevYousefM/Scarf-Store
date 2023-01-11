@extends('layouts.main')
@section('content')
    <!-- prodcuts section starts  -->
    <section class="products" id="products">
        <h1 class="heading" style="margin-top: 8rem;"> Wishes <span>List</span> </h1>
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
                        <div class="image">
                            <img src="{{ asset("$item->image") }}" alt="">
                            <div class="icons">
                                <a href="{{ route('delete_wish', $item->id) }}" onclick="return confirm('Are You Sure?')"
                                    class="fas fa-trash-alt"></a>
                                <a href="{{ route('add_cart', $item->id) }}" class="cart-btn">add to cart</a>
                                <div>
                                    <a class="fab fa-facebook"></a>
                                    <a class="fab fa-whatsapp"></a>
                                    <a class="fab fa-instagram"></a>
                                </div>
                            </div>
                        </div>
                        <div class="content">
                            <h3>{{ $item->title }}</h3>
                            <div class="price"> $<?= $last ?> <span>$<?= $price ?></span> </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>

    </section>

    <!-- prodcuts section ends -->

@endsection
