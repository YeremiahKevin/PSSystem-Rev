<?php

namespace App\Http\Controllers;

use App\MsBrand;
use App\MsPhone;
use App\MsPhoneDetail;
use Exception;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class PhoneController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Add new phone
     * @param Request $request
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function addPhone(Request $request)
    {
        try {
            $data = $request->only([
                'brand_id',
                'type'
            ]);

            DB::beginTransaction();

            $msBrand = MsBrand::findOrFail($data['brand_id']);

            $msPhone = new MsPhone();
            $msPhone->setBrand($msBrand);
            $msPhone->setPhoneAttributes($data);
            $msPhone->save();

            $result = 'Success';

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return response($result);
    }

    /**
     * Add new phone detail
     * @param Request $request
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function addPhoneDetail(Request $request)
    {
        try {
            $data = $request->only([
                'phone_id',
                'color',
                'memory',
                'storage',
                'stock',
                'price'
            ]);

            DB::beginTransaction();

            $msPhone = MsPhone::findOrFail($data['phone_id']);

            $msPhoneDetail = new MsPhoneDetail();
            $msPhoneDetail->setPhone($msPhone);
            $msPhoneDetail->setPhoneDetailAttributes($data);
            $msPhoneDetail->save();

            $result = 'Success';

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return response($result);
    }

    /**
     * Add phone stock
     * @param Request $request
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function addPhoneStock(Request $request)
    {
        try {
            $data = $request->only([
                'phone_detail_id',
                'stock',
            ]);

            DB::beginTransaction();

            $msPhoneDetail = MsPhoneDetail::findOrFail($data['phone_detail_id']);
            $previousStock = $msPhoneDetail->stock;
            $newStock = $previousStock + (int)$data['stock'];
            $msPhoneDetail->stock = $newStock;
            $msPhoneDetail->save();

            $result = 'Success';

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return response($result);
    }

    /**
     * Update phone price
     * @param Request $request
     * @return ResponseFactory|Response
     * @throws Exception
     */
    public function updatePhonePrice(Request $request)
    {
        try {
            $data = $request->only([
                'phone_detail_id',
                'price'
            ]);

            DB::beginTransaction();

            $msPhoneDetail = MsPhoneDetail::findOrFail($data['phone_detail_id']);
            $msPhoneDetail->price = $data['price'];
            $msPhoneDetail->save();

            $result = 'Success';

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return response($result);
    }
}
