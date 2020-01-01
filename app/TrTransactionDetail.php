<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TrTransactionDetail
 * @property integer transaction_detail_id
 * @property integer transaction_header_id
 * @property integer phone_detail_id
 * @property integer quantity
 * @package App
 */
class TrTransactionDetail extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_transaction_detail';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'transaction_detail_id';

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function transactionHeader()
    {
        return $this->belongsTo(TrTransactionHeader::class, 'transaction_header_id', 'transaction_header_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phoneDetail()
    {
        return $this->belongsTo(MsPhoneDetail::class, 'phone_detail_id', 'phone_detail_id');
    }

    /**
     * Set transaction detail attributes
     * @param $data
     */
    public function setTransactionDetailAttributes($data)
    {
        if (isset($data['quantity'])){
            $this->quantity = $data['quantity'];
        }
    }

    /**
     * @param TrTransactionHeader $transactionHeader
     */
    public function setTransactionHeader(TrTransactionHeader $transactionHeader)
    {
        $this->transaction_header_id = $transactionHeader->transaction_header_id;
    }

    /**
     * @param MsPhoneDetail $phoneDetail
     */
    public function setPhoneDetail(MsPhoneDetail $phoneDetail)
    {
        $this->phone_detail_id = $phoneDetail->phone_detail_id;
    }
}
