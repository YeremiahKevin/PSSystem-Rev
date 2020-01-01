<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class MsPhone
 * @property integer brand_id
 * @property string brand_name
 * @package App
 */
class MsBrand extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_brand';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'brand_id';

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function phone()
    {
        return $this->hasMany(MsPhone::class, 'brand_id', 'brand_id');
    }

    /**
     * Set brand attributes
     * @param $data
     */
    public function setBrandAttributes($data)
    {
        if (isset($data['brand_name'])){
            $this->brand_name = $data['brand_name'];
        }
    }

}
