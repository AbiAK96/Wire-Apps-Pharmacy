<?php

namespace App\Repositories\V1;
use Illuminate\Support\Facades\Hash;

use App\Models\V1\User;

class UserRepository
{
    public function checkRegister($request)
    {
        $user = User::where('email', $request->email)->first();
        return $user;
    }

    public function checkCreditials($request)
    {
        $user = User::where('email', $request->email)->first();
        if (null != $user && Hash::check($request->password, $user->password)) {
            return $user;
        } else {
            return false;
        }
    }
}
