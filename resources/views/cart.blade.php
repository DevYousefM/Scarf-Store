@extends('layouts.main')
@section('content')
    <!-- prodcuts section starts  -->
    <section class="products" id="cart">
        <h1 class="heading" style="margin-top: 8rem;"> Shopping <span>Cart</span> </h1>
        @if (Session::has('success'))
            <div class="alert alert-success text-center">
                <p class="mb-0" style="font-size: 18px">{{ Session::get('success') }}</p>
            </div>
        @endif
        <div class="box-container">
            <?php $total = 0; ?>
            @if (count($carts) > 0)
                @foreach ($carts as $item)
                    <?php $total += $item->price * $item->qtn; ?>
                    <div class="box">
                        <span class="discount">
                            <a href="{{ route('delete_cart', $item->id) }}" onclick="return confirm('Are You Sure?')">
                                X
                            </a>
                        </span>
                        <div class="image">
                            <img src="{{ asset($item->image) }}" alt="">
                        </div>
                        <div class="content">
                            <h3>{{ $item->title }}</h3>
                            <div class="price">
                                ${{ $item->price }} X {{ $item->qtn }} = ${{ $item->price * $item->qtn }}
                            </div>
                            
                        </div>
                        <form class="cart" action="{{ route('update_qtn', $item->id) }}" method="get">
                            @csrf
                            <div style="display: flex">
                                <span class="btn cart" style="margin:0 10px 0 0;line-height:3"
                                    onclick="document.getElementById('<?= 'cart' . $item->id ?>').value++;">+</span>
                                <input type="number" name="qtn" id="<?= 'cart' . $item->id ?>" class="box cart"
                                    value="{{ $item->qtn }}" name="qtn">
                                <span class="btn cart" style="margin:0 0 0 10px;line-height:3"
                                    onclick="document.getElementById('<?= 'cart' . $item->id ?>').value > 1 ? document.getElementById('<?= 'cart' . $item->id ?>').value-- : console.log('')">-</span>
                            </div>
                            <input type="submit" class="btn" value="Update">
                        </form>
                    </div>
                @endforeach

        </div>
        <h2 style="width:100%;text-align:center;margin:20px 0;color:var(--pink);font-weight:700">
            Total Cost: <?= $total ?>$</h2>
        <div style="width:100%;display:flex;justify-content: center">
            <a href="{{ route('delivary') }}" class="btn">Pay On Delivary</a>
            <a href="{{ route('credit_card') }}" class="btn">Pay by credit card</a>
        </div>
    @else
        <div class='col-md-12 error form-group hide text-center'>
            <div class='alert-danger alert' style="font-size: 20px">Your Cart Is Empty</div>
        </div>
        @endif
    </section>

    <!-- prodcuts section ends -->
@endsection
