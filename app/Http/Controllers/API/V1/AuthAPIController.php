<?php

namespace App\Http\Controllers\API\V1;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\API\AppBaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Exception;
use App\Repositories\V1\UserRepository;
use App\Http\Requests\API\LoginRequest;

// |--------------------------------------------------------------------------
// | Login Controller
// |--------------------------------------------------------------------------
// |
// | This controller is responsible for handling login and validation the login 

class AuthAPIController extends AppBaseController
{
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    public function login(LoginRequest $request)
    {
       try {
            $user = $this->userRepository->checkRegister($request);
            if($user == null) {
                return $this->errorResponse('User not found', 404);
            } else {
                $user = $this->userRepository->checkCreditials($request);
                if (false == $user) {
                    return $this->errorResponse('Invalid credentials', 401);
                } else {
                    $token = $user->createToken('LoginToken')->plainTextToken;

                    $response = null;
                    $response['access_token'] = $token;
                    $response['user'] = $user;

                    return $this->successResponse($response, 'Logged in successfully');
                }
            }
        } catch (Exception $e) {
            return $this->errorResponse('Something went wrong !.', 401);
        }   
    }

    public function getCurrentUser()
    {
        try {
            $user = Auth::user();
            return $this->successResponse($user, 'Current user retrieved successfully');
        } catch (Exception $e) {
            return $this->errorResponse('Something went wrong !.', 401);
        }
    }

    public function logout(Request $request)
    {
        try {
            $request->user()->tokens()->delete();
            return $this->successResponse(null, 'User logout successfully');
        } catch (Exception $e) {
            return $this->errorResponse('Something went wrong !.', 401);
        }
    }
}
