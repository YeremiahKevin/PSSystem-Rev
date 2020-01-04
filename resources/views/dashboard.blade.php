<html lang="en-us">
<head>
    <title>Login</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
          integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous"/>

    {{--All CSS--}}
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    {{--CSS Login--}}
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    {{--Javascript login--}}
    <script type="text/javascript" src="{{ asset('js/dashboard.js') }}"></script>

    {{--token login--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #a8b7a9">
<div class="container h-100">
    <div class="row h-100 justify-content-center">
        <div class="col p-0" style="background-color: white">
            <div class="col-md-12 text-center bg-primary">
                <span class="font-weight-bold font-50">PS System</span>
            </div>
            <div class="col-md-12 mt-5">
                <table class="table table-bordered">
                    <tr>
                        <td class="text-center" width="50%">
                            <i class="fas fa-cart-arrow-down fa-10x cursor-pointer" onclick="onClickBuy()"></i>
                            <div class="col-md-12">
                                <span class="font-weight-bold" style="font-size: x-large">Sales</span>
                            </div>
                        </td>
                        <td class="text-center" width="50%">
                            <i class="fas fa-book fa-10x cursor-pointer" onclick="onClickReport()"></i>
                            <div class="col-md-12">
                                <span class="font-weight-bold" style="font-size: x-large">Sales Report</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="fas fa-mobile-alt fa-10x cursor-pointer" onclick="onClickNewItem()"></i>
                            <div class="col-md-12">
                                <span class="font-weight-bold" style="font-size: x-large">New Phone</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <i class="fas fa-memory fa-10x cursor-pointer" onclick="onClickNewItemDetail()"></i>
                            <div class="col-md-12">
                                <span class="font-weight-bold" style="font-size: x-large">New Phone Detail</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="fas fa-cubes fa-10x cursor-pointer" onclick="onClickAddPhoneStock()"></i>
                            <div class="col-md-12">
                                <span class="font-weight-bold" style="font-size: x-large">Add Phone Stock</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <i class="fas fa-tag fa-10x cursor-pointer" onclick="onClickUpdatePrice()"></i>
                            <div class="col-md-12">
                                <span class="font-weight-bold" style="font-size: x-large">Update Phone Price</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="text-center">
                            <i class="fas fa-eye fa-10x cursor-pointer" onclick="onClickViewAllPhones()"></i>
                            <div class="col-md-12">
                                <span class="font-weight-bold" style="font-size: x-large">View All Phones</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
</body>
</html>
