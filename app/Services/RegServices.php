<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegServices
{

    public function data_user($request)
    {
        return [
            'name'      => $request->name,
            'username'  => $request->username,
            'email'     => $request->email,
            'password'  => Hash::make($request->password),
            'roles'     => $request->roles,
            'permission' => $request->permission,
        ];
    }

    public function validation_user($request)
    {
        $rules = [
            'name'     => 'required|string|max:150',
            'username' => 'required|string|max:40|unique:users',
            'email'    => 'required|string|email|max: 255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'roles'    => 'required',
            'permission' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        return $validator;
    }
}
