@extends('layouts.main')
@section('content')
    <!-- prodcuts section starts  -->
    <section class="products" id="cart">
        <h1 class="heading" style="margin-top: 8rem;"><span>Checkout</span> </h1>
        {{-- Here --}}

        <section class="login" style="padding-top:0">
            <div class="row">
                <form method="POST" action="{{ route('on_delivary') }}">
                    @csrf
                    <input type="text" name="address" value="{{ old('address') }}"
                        placeholder="Delivery address in detail" class="box">
                    @error('address')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <input type="number" name="phone" value="{{ old('phone') }}" placeholder="Reciever phone number"
                        class="box">
                    @error('phone')
                        <div class="error">{{ $message }}</div>
                    @enderror
                    <input type="hidden" name="total" value={{ $total }}>
                    <div style="display: flex;flex-wrap:wrap;justify-content:space-around;width:100%">
                        @foreach ($products as $item)
                            <div class="pco">
                                <div style="height: 100%;width:90px;overflow:hidden">
                                    <img style="width: 100%" src="{{ asset("$item->image") }}">
                                </div>
                                <div style="display: flex;flex-direction:column;margin-left:10px">
                                    <span>{{ $item->title }}</span>
                                    <span>${{ $item->price }} * {{ $item->qtn }} =
                                        ${{ $item->price * $item->qtn }}</span>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <h2 style="width:100%;text-align:center;margin:0;color:var(--pink);font-weight:700">
                        Total Cost: {{ $total }}$</h2>
                    <input type="submit" value="Complete Order" class="btn">
                </form>
            </div>
        </section>
    </section>

    <!-- prodcuts section ends -->
@endsection
