<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Exception;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ReportController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Get report monthly
     * @param $month_number
     * @throws $exception
     * @return mixed
     */
    public function getReportMonthly($month_number)
    {
        try {
            $query = DB::table('tr_transaction_header')
                ->select([
                    'tr_transaction_header.date',
                    'tr_transaction_header.payment_type',
                    'tr_transaction_detail.quantity',
                    'ms_phone_detail.color',
                    'ms_phone_detail.memory',
                    'ms_phone_detail.storage',
                    'ms_phone_detail.price',
                    DB::raw("CONCAT(ms_brand.brand_name, ' ', ms_phone.type, ' ', ms_phone_detail.color, ' ', ms_phone_detail.memory, '/', ms_phone_detail.storage, 'GB') as phone_name"),
                    DB::raw("ms_phone_detail.price * tr_transaction_detail.quantity as total_price"),
                ])
                ->whereMonth('date', '=', $month_number)
                ->whereNull('tr_transaction_header.deleted_at')
                ->join('tr_transaction_detail', function (JoinClause $clause) {
                    $clause->on('tr_transaction_detail.transaction_header_id', '=', 'tr_transaction_header.transaction_header_id');
                    $clause->whereNull('tr_transaction_detail.deleted_at');
                })
                ->join('ms_phone_detail', function (JoinClause $clause) {
                    $clause->on('ms_phone_detail.phone_detail_id', '=', 'tr_transaction_detail.phone_detail_id');
                    $clause->whereNull('ms_phone_detail.deleted_at');
                })
                ->join('ms_phone', function (JoinClause $clause) {
                    $clause->on('ms_phone.phone_id', '=', 'ms_phone_detail.phone_id');
                    $clause->whereNull('ms_phone.deleted_at');
                })
                ->join('ms_brand', function (JoinClause $clause) {
                    $clause->on('ms_brand.brand_id', '=', 'ms_phone.brand_id');
                    $clause->whereNull('ms_brand.deleted_at');
                })
                ->orderBy('tr_transaction_header.date', 'ASC')
                ->get()
                ->toArray();

            $grand_total = 0;

            foreach ($query as $data) {
                $grand_total += $data->total_price;
            }

            $month_name = date("F", mktime(0, 0, 0, $month_number, 10));

            $pdf = PDF::loadView('report-pdf', [
                'data' => $query,
                'grand_total' => $grand_total,
                'month_name' => $month_name
            ]);

            $pdf->setPaper('a4', 'landscape');

            return $pdf->stream('laporan-penjualan-' . $month_name);

        } catch (Exception $exception) {
            throw $exception;
        }
    }


}
