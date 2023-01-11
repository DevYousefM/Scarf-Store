<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Corona Admin</title>
    @include('admin.css')
    <style>
        .accordion-body {
            display: flex;
            flex-wrap: wrap;
            justify-content: center
        }

        .accordion-item span {
            padding: 10px;
            margin: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, .5)
        }

        .pco {
            height: 90px;
            border: 1px solid lightgray;
            padding: 8px 12px;
            border-radius: 5px;
            display: flex;
            align-items: center;
            font-size: 15px;
            color: white;
            margin: 5px 4px;
            width: fit-content
        }

        .pco span {
            padding: 0;
            margin: 0;
            box-shadow: unset;
        }
    </style>
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
                    @if (count($orders) > 0)


                        @foreach ($orders as $item)
                            <div class="accordion-item bg-dark mt-2">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class=" bg-dark text-white accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#{{ 'flush-collapseThree' . $item['orders']->id }}"
                                        aria-expanded="false" aria-controls="flush-collapseThree">
                                        New Order For: {{ $item['user']->name }}
                                    </button>
                                </h2>
                                <div id="{{ 'flush-collapseThree' . $item['orders']->id }}"
                                    class="accordion-collapse collapse" aria-labelledby="flush-headingThree"
                                    data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body bg-gray-500 text-black">
                                        <span>User Name: {{ $item['user']->name }}</span>
                                        <span>Email: {{ $item['user']->email }}</span>
                                        <span>Phone: {{ $item['orders']->phone }}</span>
                                        <span>Address: {{ $item['orders']->address }}</span>
                                        <span>Payment Status: {{ $item['orders']->payment ? 'Paid' : 'UnPaid' }}</span>
                                        <span>Ordered At: {{ $item['orders']->created_at }}</span>
                                        <div style="display: flex;width:100%;flex-wrap:wrap">
                                            @foreach ($item['orders']['items'] as $i)
                                                <div class="pco">
                                                    <div style="height: 100%;width:90px;overflow:hidden">
                                                        <img style="width: 100%" src={{ asset($i['product']->image) }}>
                                                    </div>
                                                    <div style="display: flex;flex-direction:column;margin-left:10px">
                                                        <span>{{ $i['product']->title }}</span>
                                                        <span>${{ $i['product']->price }} * {{ $i->quantity }} =
                                                            ${{ $i['product']->price * $i->quantity }}
                                                        </span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ($item['orders']->status === 'Completed')
                                            <span>Order status: {{ $item['orders']->status }}</span>
                                        @else
                                            <form class="col-md-12 text-center mt-2"
                                                action="{{ route('update_order') }}" method="GET">
                                                @csrf
                                                <div class="form-group color">
                                                    <select style="color: white !important" name="order_status"
                                                        style="color: rgba(255, 255, 255, 0.472)" class="form-control"
                                                        id="exampleSelectGender">
                                                        <option style="color: white" selected>
                                                            {{ $item['orders']->status }}
                                                        </option>
                                                        @if ($item['orders']->status == 'Pending')
                                                            <option style="color: white">Proccess</option>
                                                        @endif
                                                        @if ($item['orders']->status == 'Proccess')
                                                            <option style="color: white">Completed</option>
                                                        @endif
                                                    </select>
                                                </div>
                                                <input type="hidden" name="order_id"
                                                    value="{{ $item['orders']->id }}">
                                                <button type="submit" class="btn btn-outline-dark me-2">Update
                                                    order</button>
                                            </form>
                                        @endif
                                        <a href="{{ route('delete_order', $item['orders']->id) }}"
                                            class="px-2 py-1 mt-2 btn-danger transition-all"
                                            style="cursor: pointer">Delete Order</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class='col-md-12 error form-group hide text-center'>
                            <div class='alert-danger alert' style="font-size: 20px">There is no orders now</div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- page-body-wrapper ends -->
    <!-- container-scroller -->
    @include('admin.script')

</body>

</html>
