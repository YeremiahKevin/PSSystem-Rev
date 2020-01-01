<?php

namespace App\Http\Controllers;

use App\MsPhoneDetail;
use App\MsStaff;
use App\TrTransactionDetail;
use App\TrTransactionHeader;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class TransactionController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Select Phone Parameter
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws Exception
     */
    public function phoneTransaction(Request $request)
    {
        try {
            $data = $request->only([
                'brand_id',
                'phone_id',
                'phone_detail_id',
                'quantity',
                'payment_type',
                'staff_id'
            ]);

            DB::beginTransaction();

            if (!isset($data['staff_id'])) {
                $data['staff_id'] = 1;
            }

            if (!isset($data['payment_type'])) {
                $data['payment_type'] = 'Cash';
            }

            if (isset($data['phone_detail_id'])) {

                $msStaff = MsStaff::findOrFail($data['staff_id']);

                // Update Stock
                $msPhoneDetail = MsPhoneDetail::findOrFail($data['phone_detail_id']);
                $previousStock = $msPhoneDetail->stock;
                $updateStock = $previousStock - $data['quantity'];
                $msPhoneDetail->stock = $updateStock;
                $msPhoneDetail->save();

                // Create Transaction Header
                $trTransactionHeader = new TrTransactionHeader();
                $value['date'] = Carbon::now();
                $value['payment_type'] = $data['payment_type'];
                $trTransactionHeader->setTransactionHeaderAttributes($value);
                $trTransactionHeader->setStaff($msStaff);
                $trTransactionHeader->save();

                // Create Transaction Detail
                $trTransactionDetail = new TrTransactionDetail();
                $item['quantity'] = $data['quantity'];
                $trTransactionDetail->setTransactionDetailAttributes($item);
                $trTransactionDetail->setTransactionHeader($trTransactionHeader);
                $trTransactionDetail->setPhoneDetail($msPhoneDetail);
                $trTransactionDetail->save();
            }

            $result = 'Success';

            DB::commit();
        } catch (Exception $exception) {
            DB::rollBack();
            throw  $exception;
        }

        return response($result);
    }


}
