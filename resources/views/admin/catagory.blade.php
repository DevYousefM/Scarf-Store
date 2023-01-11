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
                    {{-- Add Catagory --}}
                    <div class="flex container items-center flex-col">
                        <h1 class="text-center text-2xl mb-3">
                            Add Catagory
                        </h1>
                        <form action="{{ url('/add_catagory') }}" method="POST"
                            class="pt-4 flex items-center flex-col border w-100 p-3">
                            @csrf
                            <input type="text" name="name" placeholder="Write Catagory Name"
                                class=" w-3/4 bg-black text-gray-400 " style="border-color:none">
                            <input type="submit" value="Add Catagory"
                                class="px-3 py-2 border mt-2 btn-primary transition-all" name="submit">
                        </form>
                    </div>
                    {{-- Show Catagories --}}
                    <div class="container flex items-center flex-col  w-100 pt-5">
                        <h1 class="text-center text-2xl mb-3">
                            All Catagories
                        </h1>
                        @isset($catagories)
                            <table class="table border">
                                <thead>
                                    <tr>
                                        <th scope="col">Catagory Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($catagories as $catagories)
                                        <tr>
                                            <th scope="row">{{ $catagories->catagory_name }}</th>
                                            <td colspan="2">
                                                <a href={{ route('delete_catagory', $catagories->id) }}
                                                    onclick="return confirm('Are you want to delete this catagory?')">
                                                    <button class="px-3 py-2 border mt-2 btn-danger transition-all"
                                                        name="submit">
                                                        Delete Catagory
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endisset

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
