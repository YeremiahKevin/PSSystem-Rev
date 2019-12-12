<?php

namespace App\Http\Controllers;

use App\MsStaff;
use App\MsUser;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws Exception
     */
    public function userLogin(Request $request)
    {
        try {
            $data = $request->only([
                'email',
                'password'
            ]);

            $user = DB::table('ms_user')
                ->where('email', '=', $data['email'])
                ->first();

            if ($user !== null) {
                $result = Hash::check($data['password'], $user->password);
                if ($result) {
                    $result = 'Success';
                } else {
                    $result = 'Wrong Password';
                }
            } else {
                $result = 'Wrong Email';
            }
        } catch (Exception $exception) {
            throw  $exception;
        }
        
        return response($result);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     * @throws Exception
     */
    public function userRegister(Request $request)
    {
        try {
            DB::beginTransaction();

            $data = $request->only([
                'fullName',
                'gender',
                'nik',
                'address',
                'phone',
                'email',
                'password'
            ]);

            $userData['username'] = str_replace(' ', '', $data['fullName']);
            $userData['email'] = $data['email'];
            $userData['password'] = Hash::make($data['password']);

            $msUser = new MsUser();
            $msUser->setUserAttributes($userData);
            $msUser->save();

            $staffData['staff_name'] = $data['fullName'];
            $staffData['staff_phone'] = $data['phone'];
            $staffData['staff_salary'] = 3000000;

            $msStaff = new MsStaff();
            $msStaff->setUser($msUser);
            $msStaff->setStaffAttributes($staffData);
            $msStaff->save();

            $result = 'Success';

            DB::commit();
        } catch (Exception $exception) {
            $result = 'Error';
            DB::rollBack();
            throw $exception;
        }

        return response($result);
    }
}
