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
                    @if (count($messages) > 0)


                        @foreach ($messages as $item)
                            <div class="accordion-item bg-dark mt-2">
                                <h2 class="accordion-header" id="flush-headingThree">
                                    <button class=" bg-dark text-white accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse"
                                        data-bs-target="#{{ 'flush-collapseThree' . $item->id }}" aria-expanded="false"
                                        aria-controls="flush-collapseThree">
                                        Message Sender: {{ $item->name }}
                                    </button>
                                </h2>
                                <div id="{{ 'flush-collapseThree' . $item->id }}" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body bg-gray-500 text-black">
                                        <span>Sender: {{ $item->name }}</span>
                                        <span>Email: {{ $item->email }}</span>
                                        <span>Phone: {{ $item->number }}</span>
                                        <span>Send At: {{ $item->created_at }}</span>
                                        <span>
                                            <p>Message :<q> {{ $item->message }}</q></p>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class='col-md-12 error form-group hide text-cbenter'>
                            <div class='alert-danger alert' style="font-size: 20px">There is no messages now</div>
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
