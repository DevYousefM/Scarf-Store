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
                    {{-- Add Product --}}
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
                        <h1 class="text-center text-2xl mb-3">
                            Add Product
                        </h1>
                        <form action="{{ route('adProd.store') }}" method="POST"
                            class="pt-4 flex items-center flex-col border w-100 p-3" enctype="multipart/form-data">
                            @csrf
                            <div class="flex w-100 items-center justify-center mb-2">
                                <label for="product_title" class="text-start mr-2" style="width: 10rem">Product
                                    Title:</label>
                                <input value="{{ old('product_title') }}" type="text" name="product_title"
                                    placeholder="Write Product Title" class=" w-3/4 bg-black text-gray-400 "
                                    style="border-color:none">
                            </div>
                            <div class="flex w-100 items-center justify-center mb-2">
                                <label for="product_desc" class="text-start mr-2" style="width: 10rem">Product
                                    Description:</label>
                                <input value="{{ old('product_desc') }}" type="text" name="product_desc"
                                    placeholder="Write Product Description" class=" w-3/4 bg-black text-gray-400 "
                                    style="border-color:none">
                            </div>
                            <div class="flex w-100 items-center justify-center mb-2">
                                <label for="product_price" class="text-start mr-2" style="width: 10rem">Product
                                    Price:</label>
                                <input value="{{ old('product_price') }}" type="number" min="0"
                                    name="product_price" placeholder="Input Product Price"
                                    class=" w-3/4 bg-black text-gray-400 " style="border-color:none">
                            </div>
                            <div class="flex w-100 items-center justify-center mb-2">
                                <label for="product_discount" class="text-start mr-2" style="width: 10rem">Discount
                                    Price:</label>
                                <input value="{{ old('product_discount') }}" type="number" min="0"
                                    name="product_discount" placeholder="Input Product Discount"
                                    class=" w-3/4 bg-black text-gray-400 " style="border-color:none">
                            </div>
                            <div class="flex w-100 items-center justify-center mb-2">
                                <label for="product_image" class="text-start mr-2" style="width: 10rem">Product
                                    Image:</label>
                                <input value="{{ old('product_image') }}" type="file" name="product_image"
                                    placeholder="Upload Product Image"
                                    class=" outline-none w-3/4 bg-black text-gray-400 " style="border-color:none">
                            </div>
                            <input type="submit" value="Add Product"
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
