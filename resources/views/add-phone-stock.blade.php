<html lang="en-us">
<head>
    <title>Buy</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
          integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous"/>

    {{--All CSS--}}
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    {{--CSS Login--}}
    <link href="{{ asset('css/add-phone-stock.css') }}" rel="stylesheet">

    {{--Javascript login--}}
    <script type="text/javascript" src="{{ asset('js/add-phone-stock.js') }}"></script>

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
                    ->select([
                        'ms_phone.phone_id',
                        'ms_phone_detail.phone_detail_id',
                        'ms_phone_detail.stock',
                        \Illuminate\Support\Facades\DB::raw("CONCAT(ms_brand.brand_name, ' ', ms_phone.type, ' ', ms_phone_detail.color, ' ', ms_phone_detail.memory, '/', ms_phone_detail.storage, 'GB') as phone_name"),
                    ])
                    ->join('ms_brand', function (\Illuminate\Database\Query\JoinClause $clause) {
                        $clause->on('ms_brand.brand_id', '=', 'ms_phone.brand_id');
                        $clause->whereNull('ms_brand.deleted_at');
                    })
                    ->join('ms_phone_detail', function (\Illuminate\Database\Query\JoinClause $clause) {
                        $clause->on('ms_phone_detail.phone_id', '=', 'ms_phone.phone_id');
                        $clause->whereNull('ms_phone_detail.deleted_at');
                    })
                    ->whereNull('ms_phone.deleted_at')
                    ->get()
                    ->toArray();
                ?>
                <div class="col-md-12 mt-3">
                    <span class="font-weight-bold">Phone</span>
                </div>
                <div class="col-md-12">
                    <select onchange="changePhone()" name="phone-selector" id="phone-selector">
                        <option value="{{ json_encode(NULL) }}">Select Phone</option>
                        @foreach($phones as $phone)
                            <option value="{{ json_encode($phone) }}">{{ $phone->phone_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div id="current-stock">

                </div>

                <div class="col-md-12 mt-3">
                    <span class="font-weight-bold">Add Stock</span>
                </div>
                <div class="col-md-12">
                    <input type="number" id="stock" placeholder="add phone stock">
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
