<?php

namespace App\Http\Controllers\API;

use Illuminate\Routing\Controller;

/**
 * @SWG\Swagger(
 *   basePath="/api/v1",
 *   @SWG\Info(
 *     title="Laravel Generator APIs",
 *     version="1.0.0",
 *   )
 * )
 * This class should be parent class for other API controllers
 * Class AppBaseController
 */
class AppBaseController extends Controller
{
    public function successResponse($data, $message, $code = 200) {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data
        ], $code);
    }    
    
    public function errorResponse($message, $code) {
        return response()->json([
            'success' => false,
            'message' => $message
        ], $code);
    }
    
}
