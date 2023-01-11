<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    @include('admin.css')
</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.sidebar')
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_navbar.html -->
            @include('admin.header')
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">

                    @if (session()->has('message'))
                        <div class="alert alert-success flex justify-between fade show" role="alert">
                            <strong> {{ session()->get('message') }} </strong>
                            <button type="button" class="btn-close text-black flex justify-center items-center"
                                data-bs-dismiss="alert" aria-label="Close">
                                <strong>X</strong>
                            </button>
                        </div>
                    @endif
                    {{-- Edit Product --}}
                    <div class="flex container items-center flex-col">
                        @if ($errors->any())
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-success flex justify-between fade show" role="alert">
                                    <strong> {{ $error }}</strong>
                                    <button type="button" class="btn-close text-black flex justify-center items-center"
                                        data-bs-dismiss="alert" aria-label="Close">
                                        <strong>X</strong>
                                    </button>
                                </div>
                            @endforeach
                        @endif
                        <div class="row">
                            <div class="col-md-4 flex justify-center mb-3 relative">
                                <a href="{{ route('delProd', $product->id) }}"
                                    onclick="return confirm('Are you sure to delete this product?');"
                                    class="px-2 bg-red-600 text-white absolute top-0 left-0 translate-x-2/4"
                                    style="border-radius: 4px">X</a>
                                <img src={{ asset($product->image) }}>
                            </div>
                            <div class="col-md-8">
                                <table class="table table-dark w-full">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-white font-bold text-center">Title</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <th scope="row" class=" font-bold text-center">
                                                {{ $product->title }}
                                            </th>
                                        </tr>
                                    </tbody>
                                </table>
                                <table class="table table-dark mt-2 text-center ">
                                    <thead>
                                        <tr>
                                            <th scope="col" class="text-white font-bold">Price</th>
                                            <th scope="col" class="text-white font-bold">Discount</th>
                                            <th scope="col" class="text-white font-bold">Created At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->discount }}</td>
                                            <td>{{ $product->created_at }}</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <h1 class="text-center my-3">Description </h1>
                                <p class="text-center text-gray-400">{{ $product->description }}</p>
                            </div>
                        </div>
                        <hr>
                        <h1 class="text-center text-2xl my-3">
                            Update Product
                        </h1>
                        <form action="{{ route('adProd.update', $product->id) }}" method="GET"
                            class="pt-4 flex items-center flex-col border w-100 p-3" enctype="multipart/form-data">
                            @csrf
                            <div class="flex w-100 items-center justify-center mb-2">
                                <label for="product_title" class="text-start mr-2" style="width: 10rem">Product
                                    Title:</label>
                                <input value="{{ $product->title }}" type="text" name="product_title"
                                    placeholder="Write Product Title" class=" w-3/4 bg-black text-gray-400 "
                                    style="border-color:none">
                                @error('title')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex w-100 items-center justify-center mb-2">
                                <label for="product_desc" class="text-start mr-2" style="width: 10rem">Product
                                    Description:</label>
                                <input value="{{ $product->description }}" type="text" name="product_desc"
                                    placeholder="Write Product Description" class=" w-3/4 bg-black text-gray-400 "
                                    style="border-color:none">
                                @error('description')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex w-100 items-center justify-center mb-2">
                                <label for="product_price" class="text-start mr-2" style="width: 10rem">Product
                                    Price:</label>
                                <input value="{{ $product->price }}" type="number" min="0" name="product_price"
                                    placeholder="Input Product Price" class=" w-3/4 bg-black text-gray-400 "
                                    style="border-color:none">
                                @error('price')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="flex w-100 items-center justify-center mb-2">
                                <label for="product_discount" class="text-start mr-2" style="width: 10rem">Discount
                                    Price:</label>
                                <input value="{{ $product->discount }}" type="number" min="0"
                                    name="product_discount" placeholder="Input Product Discount"
                                    class=" w-3/4 bg-black text-gray-400 " style="border-color:none">
                                @error('discount')
                                    <div class="error">{{ $message }}</div>
                                @enderror
                            </div>
                            <input type="submit" value="Update Product"
                                class="px-3 py-2 border mt-2 btn-primary transition-all" name="submit">
                        </form>
                    </div>

                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    @include('admin.script')

</body>

</html>
