<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MsStaff
 * @property string staff_id
 * @property string staff_name
 * @property string staff_phone
 * @property integer staff_salary
 * @property integer user_id
 * @package App
 */
class MsStaff extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_staff';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'staff_id';

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function user()
    {
        return $this->hasOne(MsUser::class, 'user_id', 'user_id');
    }

    /**
     * Set staff attributes
     * @param $data
     */
    public function setStaffAttributes($data)
    {
        if (isset($data['staff_name'])){
            $this->staff_name = $data['staff_name'];
        }

        if (isset($data['staff_phone'])) {
            $this->staff_phone = $data['staff_phone'];
        }

        if (isset($data['staff_salary'])) {
            $this->staff_salary = $data['staff_salary'];
        }
    }

    public function setUser(MsUser $user)
    {
        $this->user_id = $user->user_id;
    }
}
