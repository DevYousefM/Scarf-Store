@extends('layouts.main')
@section('content')
    <section class="home" id="home">

        <div class="content">
            @if (Session::has('message'))
                <div class="alert alert-success text-center">
                    <p class="mb-0" style="font-size: 18px">{{ Session::get('message') }}</p>
                </div>
            @endif
            <h3>WELCOME TO MY <span>ZAHRA</span> STORE</h3>

            <p>“You Really Are An Amazing Brand. Well Done. And I Don't Know Any Of The Founders So I Am Truly Saying
                This From The Bottom Of My Heart. You're A Positive Brand That Puts Strength In A Modest Girl To Keep
                Going. You Provide Amazing Quality Scarves And You Are Building A Great Community. Keep Up The Good
                Work! ❤”</p>
            <a href="/products" class="btn">shop now</a>
        </div>

    </section>

    <!-- home section ends -->



    <!-- icons section starts  -->

    <section class="icons-container">

        <div class="icons">
            <img src="images/icon-1.png" alt="">
            <div class="info">
                <h3>free delivery</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/icon-2.png" alt="">
            <div class="info">
                <h3>10 days returns</h3>
                <span>moneyback guarantee</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/icon-3.png" alt="">
            <div class="info">
                <h3>offer & gifts</h3>
                <span>on all orders</span>
            </div>
        </div>

        <div class="icons">
            <img src="images/icon-4.png" alt="">
            <div class="info">
                <h3>secure paymens</h3>
                <span>protected by paypal</span>
            </div>
        </div>

    </section>

    <!-- icons section ends -->

    <!-- prodcuts section starts  -->

    <section class="products" id="products">

        <h1 class="heading"> latest <span>products</span> </h1>




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
                                <a href="{{ route('add_wish', $item->id) }}" class="fas fa-heart"></a>
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
        <div style="width:100%;display: flex;justify-content: center;">
            <a href="{{ route('prods') }}" class="btn">see all</a>
        </div>

        </div>

    </section>

    <!-- prodcuts section ends -->

    <!-- review section starts  -->

    <section class="review" id="review">

        <h1 class="heading"> customer's <span>review</span> </h1>

        <div class="box-container">

            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti asperiores laboriosam praesentium
                    enim maiores? Ad repellat voluptates alias facere repudiandae dolor accusamus enim ut odit, aliquam
                    nesciunt eaque nulla dignissimos.</p>
                <div class="user">
                    <img src="images/pic-1.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>

            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti asperiores laboriosam praesentium
                    enim maiores? Ad repellat voluptates alias facere repudiandae dolor accusamus enim ut odit, aliquam
                    nesciunt eaque nulla dignissimos.</p>
                <div class="user">
                    <img src="images/pic-2.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>

            <div class="box">
                <div class="stars">
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                    <i class="fas fa-star"></i>
                </div>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti asperiores laboriosam praesentium
                    enim maiores? Ad repellat voluptates alias facere repudiandae dolor accusamus enim ut odit, aliquam
                    nesciunt eaque nulla dignissimos.</p>
                <div class="user">
                    <img src="images/pic-3.png" alt="">
                    <div class="user-info">
                        <h3>john deo</h3>
                        <span>happy customer</span>
                    </div>
                </div>
                <span class="fas fa-quote-right"></span>
            </div>

        </div>

    </section>

    <!-- review section ends -->
    <!-- contact section starts  -->

    <section class="contact" id="contact">

        <h1 class="heading"> <span> contact </span> us </h1>

        <div class="row">

            <form action="{{ route('message.store') }}" method="POST">
                @csrf
                <input type="text" name="name" placeholder="name" class="box">
                @error('name')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="email" name="email" placeholder="email" class="box">
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="number" name="number" placeholder="number" class="box">
                @error('number')
                    <div class="error">{{ $message }}</div>
                @enderror
                <textarea name="message" class="box" placeholder="message" id="" cols="30" rows="10"></textarea>
                @error('message')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="submit" value="send message" class="btn">
            </form>

            <div class="image">
                <img src="images/zahra-new-png.png" alt="">
            </div>

        </div>

    </section>

    <!-- contact section ends -->

    <!-- footer section starts  -->

    <section class="footer">

        <div class="box-container">

            <div class="box">
                <h3>quick links</h3>
                <a href="/">home</a>
                <a href="/products">products</a>
                <a href="/#review">review</a>
                <a href="/#contact">contact</a>
            </div>

            <div class="box">
                <h3>extra links</h3>
                <a href="/profile">my account</a>
                <a href="/wishes">my favorite</a>
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
