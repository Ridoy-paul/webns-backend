<?php  

namespace App\Helpers;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;
use App\Models\GlobalSettings;
use Illuminate\Support\Facades\Auth;

class ResponseHelper
{

    public function __construct()
    {
        $user = Auth::user();
        //$this->userid = $user ? $user->_id : 0;
    }

    public static function sendResponse( int $statusCode, bool $isSuccess = false, string $errorMessage = 'Network Error! Please try again.', $responseData = null): JsonResponse
    {
        return response()->json([
            'isSuccess' => $isSuccess,
            'statusCode' => $statusCode,
            'errorMessage' => $errorMessage,
            'responseData' => $responseData
        ], $statusCode);
    }

    

}