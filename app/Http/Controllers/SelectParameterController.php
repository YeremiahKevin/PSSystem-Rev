<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class SelectParameterController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Select Phone Parameter
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws Exception
     */
    public function selectPhone(Request $request)
    {
        try {
            $param = $request->only([
                'brand_id'
            ]);

//            $phones = DB::table('ms_phone')
//                ->select([
//                    'ms_phone.phone_id',
//                    'ms_phone.type as phone_name',
//                    'a.brand_id',
//                    'a.brand_name',
//                    'ms_phone_detail.color',
//                    'ms_phone_detail.memory',
//                    'ms_phone_detail.storage'
//                ])
//                ->join('ms_brand as a', static function (JoinClause $clause) use ($param) {
//                    $clause->on('a.brand_id', '=', 'ms_phone.brand_id');
//                    $clause->whereNull('a.deleted_at');
//                    if (isset($param['brand_id'])) {
//                        $clause->where('a.brand_id', '=', $param['brand_id']);
//                    }
//                })
//                ->join('ms_phone_detail', static function (JoinClause $clause) {
//                    $clause->on('ms_phone_detail.phone_id', '=', 'ms_phone.phone_id');
//                    $clause->whereNull('ms_phone_detail.deleted_at');
//                })
//                ->whereNull('ms_phone.deleted_at')
//                ->get()
//                ->toArray();
            $phones = DB::table('ms_phone')
                ->select([
                    'ms_phone.phone_id',
                    'ms_phone.type as phone_name',
                    'b.phone_detail_id',
                    'b.color',
                    'b.memory',
                    'b.storage',
                    'b.price',
                    'a.brand_id',
                    'a.brand_name',
                ])
                ->join('ms_brand as a', function (JoinClause $clause) use ($param) {
                    $clause->on('a.brand_id', '=', 'ms_phone.brand_id');
                    if (isset($param['brand_id'])) {
                        $clause->where('a.brand_id', '=', $param['brand_id']);
                    }
                    $clause->whereNull('a.deleted_at');
                })
                ->join('ms_phone_detail as b', function (JoinClause $clause) {
                    $clause->on('b.phone_id', '=', 'ms_phone.phone_id');
                    $clause->whereNull('b.deleted_at');
                    $clause->where('b.stock', '>', 0);
                })
                ->whereNull('ms_phone.deleted_at')
                ->get()
                ->toArray();

        } catch (Exception $exception) {
            throw  $exception;
        }

        return response($phones);
    }


}
