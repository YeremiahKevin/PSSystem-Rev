<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MsStaff
 * @property integer phone_detail_id
 * @property integer phone_id
 * @property string color
 * @property string memory
 * @property string storage
 * @property integer stock
 * @property integer price
 *
 * @method static MsPhoneDetail findOrFail($phone_detail_id)
 *
 * @package App
 */
class MsPhoneDetail extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_phone_detail';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'phone_detail_id';

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function phone()
    {
        return $this->belongsTo(MsPhone::class, 'phone_id', 'phone_id');
    }

    /**
     * Set phone detail attributes
     * @param $data
     */
    public function setPhoneDetailAttributes($data)
    {
        if (isset($data['color'])){
            $this->color = $data['color'];
        }

        if (isset($data['memory'])) {
            $this->memory = $data['memory'];
        }

        if (isset($data['storage'])) {
            $this->storage = $data['storage'];
        }

        if (isset($data['stock'])) {
            $this->stock = $data['stock'];
        }

        if (isset($data['price'])) {
            $this->price = $data['price'];
        }
    }

    public function setPhone(MsPhone $phone)
    {
        $this->phone_id = $phone->phone_id;
    }
}
