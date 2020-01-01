<html lang="en-us">
<head>
    <title>Buy</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
          integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous"/>

    {{--All CSS--}}
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    {{--CSS Login--}}
    <link href="{{ asset('css/buy.css') }}" rel="stylesheet">

    {{--Javascript login--}}
    <script type="text/javascript" src="{{ asset('js/buy.js') }}"></script>

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
            <div class="col-md-12">
                <div class="col-md-12">
                    <div class="col-md-12 mt-3">
                        <span class="font-weight-bold">Select Brand</span>
                    </div>
                    <?php
                    $brands = \Illuminate\Support\Facades\DB::table('ms_brand')
                        ->get()
                        ->toArray();
                    ?>

                    <div class="col-md-12">
                        <select onchange="changeBrand()" name="brand-selector" id="brand-selector">
                            <option value="{{ NULL }}">Select Brand</option>
                            @foreach($brands as $brand)
                                <option value="{{ json_encode($brand) }}">{{ $brand->brand_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-12 mt-3">
                        <span class="font-weight-bold">Select Phone</span>
                    </div>

                    <?php
                    $phones = \Illuminate\Support\Facades\DB::table('ms_phone')
                        ->select([
                            'ms_phone.phone_id',
                            'ms_phone.type as phone_name',
                            'b.phone_detail_id',
                            'b.color',
                            'b.memory',
                            'b.storage',
                            'b.price',
                            'a.brand_id',
                            'a.brand_name'
                        ])
                        ->join('ms_brand as a', function (\Illuminate\Database\Query\JoinClause $clause) {
                            $clause->on('a.brand_id', '=', 'ms_phone.brand_id');
                            $clause->whereNull('a.deleted_at');
                        })
                        ->join('ms_phone_detail as b', function (\Illuminate\Database\Query\JoinClause $clause) {
                            $clause->on('b.phone_id', '=', 'ms_phone.phone_id');
                            $clause->whereNull('b.deleted_at');
                            $clause->where('b.stock', '>', 0);
                        })
                        ->whereNull('ms_phone.deleted_at')
                        ->get()
                        ->toArray();
                    ?>

                    <div class="col-md-12">
                        <select onchange="changePhone()" name="phone-selector" id="phone-selector">
                            <option value="{{ NULL }}">Select Phone</option>
                            @foreach($phones as $phone)
                                <option value="{{ json_encode($phone) }}">{{ $phone->phone_name }} {{$phone->color}} {{$phone->memory}}
                                    GB/{{$phone->storage}}GB
                                </option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-12 mt-3">
                        <span class="font-weight-bold">Quantity</span>
                    </div>

                    <div class="col-md-12">
                        <input id="quantity" onchange="changeQuantity()" type="number" placeholder="Input Quantity">
                    </div>

                    <div class="col-md-12 mt-4">
                        <button type="submit" onclick="onSubmit()" class="btn btn-primary">Submit</button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>