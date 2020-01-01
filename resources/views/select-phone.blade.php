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
    ->join('ms_brand as a', function (\Illuminate\Database\Query\JoinClause $clause) use ($brand_id) {
        $clause->on('a.brand_id', '=', 'ms_phone.brand_id');
        if (isset($brand_id)) {
            $clause->where('a.brand_id', '=', $brand_id);
        }
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