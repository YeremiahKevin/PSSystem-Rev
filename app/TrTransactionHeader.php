<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class TrTransactionHeader
 * @property integer transaction_header_id
 * @property Carbon date
 * @property string payment_type
 * @property integer staff_id
 * @package App
 */
class TrTransactionHeader extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tr_transaction_header';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'transaction_header_id';

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function transactionDetail()
    {
        return $this->hasMany(TrTransactionDetail::class, 'transaction_header_id', 'transaction_header_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function staff()
    {
        return $this->belongsTo(MsStaff::class, 'staff_id', 'staff_id');
    }

    /**
     * Set transaction detail attributes
     * @param $data
     */
    public function setTransactionHeaderAttributes($data)
    {
        if (isset($data['date'])){
            $this->date = $data['date'];
        }

        if (isset($data['payment_type'])){
            $this->payment_type = $data['payment_type'];
        }
    }

    /**
     * @param MsStaff $staff
     */
    public function setStaff(MsStaff $staff)
    {
        $this->staff_id = $staff->staff_id;
    }
}
