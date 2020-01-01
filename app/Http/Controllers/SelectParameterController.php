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

            $phones = DB::table('ms_phone')
                ->select([
                    'ms_phone.phone_id',
                    'ms_phone.type as phone_name',
                    'a.brand_id',
                    'a.brand_name'
                ])
                ->join('ms_brand as a', static function (JoinClause $clause) use ($param) {
                    $clause->on('a.brand_id', '=', 'ms_phone.brand_id');
                    $clause->whereNull('a.deleted_at');
                    if (isset($param['brand_id'])) {
                        $clause->where('a.brand_id', '=', $param['brand_id']);
                    }
                })
                ->whereNull('ms_phone.deleted_at')
                ->get()
                ->toArray();

        } catch (Exception $exception) {
            throw  $exception;
        }

        return view('select-phone', $phones);
    }


}
