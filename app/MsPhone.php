<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MsPhone
 * @property integer phone_id
 * @property integer brand_id
 * @property string type
 * @package App
 */
class MsPhone extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_phone';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'phone_id';

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function brand()
    {
        return $this->belongsTo(MsBrand::class, 'brand_id', 'brand_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phoneDetail()
    {
        return $this->hasMany(MsPhoneDetail::class, 'phone_id', 'phone_id');
    }

    /**
     * Set phone attributes
     * @param $data
     */
    public function setPhoneAttributes($data)
    {
        if (isset($data['type'])){
            $this->type = $data['type'];
        }
    }

    public function setBrand(MsBrand $brand)
    {
        $this->brand_id = $brand->brand_id;
    }
}
