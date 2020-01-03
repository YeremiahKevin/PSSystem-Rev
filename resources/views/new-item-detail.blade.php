<html lang="en-us">
<head>
    <title>Buy</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
          integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous"/>

    {{--All CSS--}}
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    {{--CSS Login--}}
    <link href="{{ asset('css/new-item-detail.css') }}" rel="stylesheet">

    {{--Javascript login--}}
    <script type="text/javascript" src="{{ asset('js/new-item-detail.js') }}"></script>

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
            <div class="col-md-12 text-center bg-primary cursor-pointer" onclick="onClickLogo()">
                <span class="font-weight-bold font-50">PS System</span>
            </div>
            <div class="col-md-12">
                <?php
                $phones = \Illuminate\Support\Facades\DB::table('ms_phone')
                    ->whereNull('ms_phone.deleted_at')
                    ->get()
                    ->toArray();
                ?>
                <div class="col-md-12 mt-3">
                    <span class="font-weight-bold">Type</span>
                </div>
                <div class="col-md-12">
                    <select onchange="changePhone()" name="phone-selector" id="phone-selector">
                        <option value="{{ NULL }}">Select Phone</option>
                        @foreach($phones as $phone)
                            <option value="{{ json_encode($phone) }}">{{ $phone->type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12 mt-3">
                    <span class="font-weight-bold">Color</span>
                </div>
                <div class="col-md-12">
                    <input type="text" id="color" placeholder="input phone color">
                </div>

                <div class="col-md-12 mt-3">
                    <span class="font-weight-bold">Memory</span>
                </div>
                <div class="col-md-12">
                    <input type="text" id="memory" placeholder="input phone memory">
                </div>

                <div class="col-md-12 mt-3">
                    <span class="font-weight-bold">Storage</span>
                </div>
                <div class="col-md-12">
                    <input type="text" id="storage" placeholder="input phone storage">
                </div>

                <div class="col-md-12 mt-3">
                    <span class="font-weight-bold">Stock</span>
                </div>
                <div class="col-md-12">
                    <input type="text" id="stock" placeholder="input phone stock">
                </div>

                <div class="col-md-12 mt-3">
                    <span class="font-weight-bold">Price</span>
                </div>
                <div class="col-md-12">
                    <input type="text" id="price" placeholder="input phone price">
                </div>

                <div class="col-md-12 mt-3">
                    <button class="btn btn-primary" onclick="onClickSubmit()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
