<html lang="en-us">
<head>
    <title>Buy</title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css"
          integrity="sha256-+N4/V/SbAFiW1MPBCXnfnP9QSN3+Keu+NlB+0ev/YKQ=" crossorigin="anonymous"/>

    {{--All CSS--}}
    <link href="{{ asset('css/all.css') }}" rel="stylesheet">

    {{--CSS Login--}}
    <link href="{{ asset('css/update-phone-price.css') }}" rel="stylesheet">

    {{--Javascript login--}}
    <script type="text/javascript" src="{{ asset('js/update-phone-price.js') }}"></script>

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
                $brandsWithPhones = [];

                $brands = \Illuminate\Support\Facades\DB::table('ms_brand')
                    ->select([
                        'ms_brand.brand_id',
                        'ms_brand.brand_name'
                    ])
                    ->whereNull('ms_brand.deleted_at')
                    ->get()
                    ->toArray();

                collect($brands)->each(function ($i) use (&$brandsWithPhones) {

                    $phones = \Illuminate\Support\Facades\DB::table('ms_phone')
                        ->select([
                            'ms_phone.type',
                            'ms_phone_detail.color',
                            'ms_phone_detail.memory',
                            'ms_phone_detail.storage',
                            'ms_phone_detail.stock',
                            'ms_phone_detail.price',
                            \Illuminate\Support\Facades\DB::raw("CONCAT(ms_brand.brand_name, ' ', ms_phone.type, ' ', ms_phone_detail.color, ' ', ms_phone_detail.memory, '/', ms_phone_detail.storage, 'GB') as phone_name"),
                        ])
                        ->join('ms_brand', function (\Illuminate\Database\Query\JoinClause $clause) use ($i) {
                            $clause->on('ms_brand.brand_id', '=', 'ms_phone.brand_id');
                            $clause->where('ms_brand.brand_id', '=', $i->brand_id);
                        })
                        ->join('ms_phone_detail', function (\Illuminate\Database\Query\JoinClause $clause) {
                            $clause->on('ms_phone_detail.phone_id', '=', 'ms_phone.phone_id');
                            $clause->whereNull('ms_phone_detail.deleted_at');
                        })
                        ->whereNull('ms_phone.deleted_at')
                        ->get()
                        ->toArray();

                    $i = [
                        'brand_name' => $i->brand_name,
                        'phones' => $phones,
                    ];

                    array_push($brandsWithPhones, $i);

                });
                ?>

                <div class="col-md-12 text-center mt-3">
                    <h4 class="font-weight-bold">ALL PHONES</h4>
                </div>

                @foreach($brandsWithPhones as $brand)
                    <div class="col-md-12 mt-5">
                        <span class="font-weight-bold">{{ $brand['brand_name'] }}</span>
                    </div>
                    <div class="col-md-12">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="text-center">
                                <th width="4%">No</th>
                                <th width="30%">Type</th>
                                <th width="15%">Color</th>
                                <th width="10%">Memory</th>
                                <th width="10%">Storage</th>
                                <th width="10%">Stock</th>
                                <th>Price</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($brand['phones'] as $idx => $phone)
                                <tr class="text-center">
                                    <td>{{ $idx+1 }}</td>
                                    <td>{{ $phone->type }}</td>
                                    <td>{{ $phone->color }}</td>
                                    <td>{{ $phone->memory }} GB</td>
                                    <td>{{ $phone->storage }} GB</td>
                                    <td>{{ $phone->stock }}</td>
                                    <td>Rp {{ number_format($phone->price, 0, '.', '.') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
</body>
</html>
