<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class MsStaff
 * @property integer user_id
 * @property string username
 * @property string email
 * @property string password
 * @package App
 */
class MsUser extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'ms_user';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'user_id';

    /**
     * @var bool
     */
    public $incrementing = true;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function staff()
    {
        return $this->hasOne(MsStaff::class, 'user_id', 'user_id');
    }

    /**
     * Set user attributes
     * @param $data
     */
    public function setUserAttributes($data)
    {
        if (isset($data['username'])){
            $this->username = $data['username'];
        }

        if (isset($data['email'])) {
            $this->email = $data['email'];
        }

        if (isset($data['password'])) {
            $this->password = $data['password'];
        }
    }
}
