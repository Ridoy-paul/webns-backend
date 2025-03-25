<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use App\Models\Otp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Utilities\SMSUtility;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Intervention\Image\Laravel\Facades\Image;
use App\Utilities\MessUtil;

class RegistrationCon extends Controller
{

    protected ResponseHelper $rh;

    public function __construct(ResponseHelper $rh) 
    {
        $this->rh = $rh;
    }

    // composer require intervention/image-laravel
    // php artisan vendor:publish --provider="Intervention\Image\Laravel\ServiceProvider"

    public function send_otp(Request $request)
    {
        try {
            $otp = mt_rand(1000, 9999);
            $msg = "Tolet BD OTP $otp This OTP will expire within 3 minutes.";
            $phone = $request->phone;
            $sms = (new SMSUtility())->sms_send($msg, $phone);
            $response = [
                'sms' => json_decode($sms)->Status,
                'phone' => $phone,
                'otp' => 'null' //$otp,
            ];

            $expiresAt = now()->addMinutes(5);
            $otpFetch = Otp::where('phone', $phone)->first();
            if ($otpFetch) {
                $otpFetch->update([
                    'otp' => $otp,
                    'expires_at' => $expiresAt->toString(),
                ]);
            }
            else {
                Otp::Create(['phone' => $phone, 'otp' => $otp, 'expires_at' => $expiresAt->toString()]);
            }
            return $response;

        } catch (\Exception $e) {
            return $this->rh->sendResponse(
                statusCode: 500,
                errorMessage: 'Internal server error.'
            );
        }
    }

    public function verify_otp(Request $request)
    {
        //return $request;
        try {

            $request->validate([
                'phone' => 'required',
                'otp' => 'required',
            ]);
        
            $otpRecord = Otp::where('phone', $request->phone)->first();

            if (!$otpRecord) {
                return $this->rh->sendResponse(
                    statusCode: 200,
                    errorMessage: 'OTP not found.',
                );
            }

            $expiresAt = Carbon::parse($otpRecord->expires_at);
            if (now()->greaterThan($expiresAt)) {
                return $this->rh->sendResponse(
                    statusCode: 200,
                    errorMessage: 'OTP has expired.',
                );
            }
        
            if ($otpRecord->otp == $request->otp) {
                return $this->rh->sendResponse(
                    isSuccess: true,
                    statusCode: 200,
                    errorMessage: '',
                    responseData: null
                );
            } else {
                return $this->rh->sendResponse(
                    statusCode: 200,
                    errorMessage: 'Invalid OTP! Please Try Again.',
                );
            }
        } catch (\Exception $e) {
            return $this->rh->sendResponse(
                statusCode: 500,
            );
        }
    }

    public function registration_get_otp(Request $request)
    {
        //return $request;
        try {
            $phone = $request->phone;
            if (User::where('phone', $phone)->exists()) {
                return $this->rh->sendResponse(
                    isSuccess: false,
                    statusCode: 200,
                    errorMessage: 'This number already registered.',
                    responseData: null
                );
            }

            $otp_info = self::send_otp($request);
            
            if($otp_info['sms'] == 0) {
                return $this->rh->sendResponse(
                    isSuccess: true,
                    statusCode: 200,
                    errorMessage: '',
                    responseData: $otp_info
                );
            }
            return $this->rh->sendResponse(
                statusCode: 400,
                errorMessage: 'Failed to send OTP.',
            );

        } catch (\Exception $e) {
            return $this->rh->sendResponse(
                statusCode: 500,
                errorMessage: $e,
            );
        }
    }

    public function register(Request $request)
    {
        //return $request;
        try {
            $registerUserData = $request->validate([
                'name' => 'required|string',
                'phone' => 'required|string|unique:users',
                'password' => 'required|min:8',
                'otp' => 'required'
            ]);

            $otpRecord = Otp::where('phone', $request->phone)->first();

            if (!$otpRecord) {
                return $this->rh->sendResponse(
                    statusCode: 200,
                    errorMessage: 'This phone number is not verified! Please verify first.',
                );
            }

            if ($otpRecord->otp <> $registerUserData['otp']) {
                return $this->rh->sendResponse(
                    statusCode: 200,
                    errorMessage: 'This phone number is not verified! Please verify first.',
                );
            }

            $user = User::create([
                'name' => $registerUserData['name'],
                'phone' => $registerUserData['phone'],
                'type' => 'user',
                'is_freelancer' => 0,
                'point' => 20,
                'is_verified' => true,
                'is_active' => true,
                'is_mess_system_active' => false,
                'is_show_mess_dashboard_init' => false,
                'theme_mode' => 'default',
                'lang' => 'en',
                'is_invited_for_mess' => false,
                'password' => Hash::make($registerUserData['password']),
            ]);


            //$user = Auth::login($user);
            // print_r($user->createToken('MyApp')->plainTextToken);die;

            $checkMessInvitation = MessUtil::registerSmsInvitedUser($user->phone, $user->id);

            if($checkMessInvitation) {
                $user = User::find($user->id);
            }

            $success['_token'] =  $user->createToken('API Token')->plainTextToken;
            $success['token_type'] = 'Bearer';
            $success['id'] = $user->id;
            $success['name'] = $user->name;
            $success['phone'] = $user->phone;
            $success['photo'] = $user->photo ?? '';
            $success['theme_mode'] = $user->theme_mode ?? '';
            $success['lang'] = $user->lang ?? '';
            $success['is_mess_system_active'] = $user->is_mess_system_active ?? false;
            $success['is_show_mess_dashboard_init'] = $user->is_show_mess_dashboard_init ?? false;
            $success['last_search_info'] = $user->last_search_info ?? [];

            return $this->rh->sendResponse(
                isSuccess: true,
                statusCode: 200,
                errorMessage: '',
                responseData: $success
            );

        } catch (\Illuminate\Validation\ValidationException $e) {

            return $this->rh->sendResponse(
                statusCode: 200,
                errorMessage: $e->getMessage(),
            );
        } catch (\Exception $e) {

            return $this->rh->sendResponse(
                statusCode: 500,
                errorMessage: $e,
            );
        }
    }


    public function login(Request $request)
    {
        try {
            $loginUserData = $request->validate([
                'phone' => 'required',
                'password' => 'required'
            ]);

            $phone = $loginUserData['phone'];

            if(Auth::attempt(['phone' => $request->phone, 'password' => $request->password])){ 
                $request->session()->regenerate();

                $user = Auth::user(); 
                $token = $user->createToken('API Token')->plainTextToken;

                $success['_token'] =  $token;
                $success['token_type'] = 'Bearer';
                $success['id'] = $user->id;
                $success['name'] = $user->name;
                $success['phone'] = $user->phone;
                $success['photo'] = $user->photo ?? '';
                $success['theme_mode'] = $user->theme_mode ?? '';
                $success['lang'] = $user->lang ?? '';
                $success['is_mess_system_active'] = $user->is_mess_system_active ?? false;
                $success['default_mess_code'] = $user->default_mess_code ?? '';
                $success['is_show_mess_dashboard_init'] = $user->is_show_mess_dashboard_init ?? false;
                $success['last_search_info'] = $user->last_search_info ?? [];

                return $this->rh->sendResponse(
                    isSuccess: true,
                    statusCode: 200,
                    errorMessage: '',
                    responseData: $success
                );

            } 
            else{ 
                return $this->rh->sendResponse(
                    statusCode: 200,
                    errorMessage: 'Invalid Credentials.',
                );
            } 

        } catch (\Exception $e) {
            return $this->rh->sendResponse(
                statusCode: 500,
                errorMessage: $e->getMessage(),
            );
        }
    }

    /*
    public function login(Request $request)
    {
        try {
            $loginUserData = $request->validate([
                'phone' => 'required',
                'password' => 'required'
            ]);

            $phone = $loginUserData['phone'];
            $user = User::where('phone', $phone)->first();

            if ($user && Hash::check($loginUserData['password'], $user->password)) {
                
                Auth::login($user);

                //$request->session()->regenerate();

                $token = $user->createToken('API Token')->plainTextToken;

                $success['_token'] =  $token;
                $success['token_type'] = 'Bearer';
                $success['id'] = $user->id;
                $success['name'] = $user->name;
                $success['phone'] = $user->phone;
                $success['photo'] = $user->photo ?? '';
                $success['theme_mode'] = $user->theme_mode ?? '';
                $success['lang'] = $user->lang ?? '';
                $success['is_mess_system_active'] = $user->is_mess_system_active ?? false;
                $success['default_mess_code'] = $user->default_mess_code ?? '';
                $success['is_show_mess_dashboard_init'] = $user->is_show_mess_dashboard_init ?? false;
                $success['last_search_info'] = $user->last_search_info ?? [];

                return $this->rh->sendResponse(
                    isSuccess: true,
                    statusCode: 200,
                    errorMessage: '',
                    responseData: $success
                );
            } else {
                return $this->rh->sendResponse(
                    statusCode: 200,
                    errorMessage: 'Invalid Credentials.',
                );
            }
        } catch (\Exception $e) {
            return $this->rh->sendResponse(
                statusCode: 500,
            );
        }
    }
    */

    public static function getProfileResponse($isToken = false, $token = '', $user) {

        if($isToken == true) {
            $success['_token'] =  $token;
            $success['token_type'] = 'Bearer';
        }
        
        $success['id'] = $user->id;
        $success['name'] = $user->name;
        $success['phone'] = $user->phone;
        $success['email'] = $user->email;
        $success['gender'] = $user->gender;
        $success['photo'] = $user->photo ?? '';
        $success['theme_mode'] = $user->theme_mode ?? '';
        $success['lang'] = $user->lang ?? '';
        $success['is_mess_system_active'] = $user->is_mess_system_active ?? false;
        $success['default_mess_code'] = $user->default_mess_code ?? '';
        $success['is_show_mess_dashboard_init'] = $user->is_show_mess_dashboard_init ?? false;
        $success['last_search_info'] = $user->last_search_info ?? [];

        return $success;
    }

    public function getProfile(Request $request) {
        $user = Auth::user();
        if ($user === null) {
            return $this->rh->sendResponse(
                statusCode: 401,
                errorMessage: 'No authenticated user found',
            );
        }

        $response = self::getProfileResponse(false, 'no', $user);

        return $this->rh->sendResponse(
            isSuccess: true,
            statusCode: 200,
            errorMessage: '',
            responseData: $response
        );
    }

    public function updateProfile(Request $request) {
        //dd($request);
        // return $request;
        try {

            $user = Auth::user();
            if ($user === null) {
                return $this->rh->sendResponse(
                    statusCode: 401,
                    errorMessage: 'No authenticated user found',
                );
            }

            $loginUserData = $request->validate([
                'name' => 'required',
                'gender' => 'required',
                'email' => 'nullable|email',
                'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp',
            ]);
    
            $userInfo = User::find($user->id);
            $userInfo->name = $loginUserData['name'];
            $userInfo->email = $loginUserData['email'];
            $userInfo->gender = $loginUserData['gender'];

            // Handle the uploaded photo
            if ($request->hasFile('photo')) {
                $image = Image::read($request->file('photo'));
                $image->resize(150, 150);
            
                // Generate a unique name for the image
                $imageName = time() . rand(10000, 99999) . '.' . $request->file('photo')->getClientOriginalExtension();
                $destinationPath = public_path('images/');
                
                // Save the resized image to the specified path
                $image->save($destinationPath . $imageName);
            
                // Check if there is an existing photo and delete it
                if (!empty($userInfo->photo) && is_file(public_path($userInfo->photo))) {
                    unlink(public_path($userInfo->photo));
                }
            
                $userInfo->photo = 'images/' . $imageName;
            }
            
    
            $userInfo->save();

            $response = self::getProfileResponse(false, 'no', $userInfo);
    
            return $this->rh->sendResponse(
                isSuccess: true,
                statusCode: 200,
                errorMessage: '',
                responseData: $response,
            );
    
        } catch (\Exception $e) {
            return $this->rh->sendResponse(
                statusCode: ERROR_STATUS_CODE,
                errorMessage: $e->getMessage(),
            );
        }
    }
    

    //Logout
    public function logout(Request $request) {
        //return $request;
        try {
            $user = Auth::user();
            if ($user === null) {
                return $this->rh->sendResponse(
                    statusCode: 401,
                    errorMessage: 'No authenticated user found',
                );
            }
    
           //$logout =  $request->user()->currentAccessToken()->delete();
           //$user->tokens()->delete();
           $request->user()->tokens()->delete();

            return $this->rh->sendResponse(
                isSuccess: true,
                statusCode: 200,
                errorMessage: '',
                responseData: 'Logged out successfully'
            );

        } catch (\Exception $e) {
            return $this->rh->sendResponse(
                statusCode: 500,
            );
        }
    }

    //Forgot Password Start ------------------------------->>>>>>>>>>>>>>>>>>
    public function forgot_password_get_otp(Request $request)
    {
        try {
            $phone = $request->phone;

            $user = User::where('phone', $phone)->first();

            if ($user === null) {
                return $this->rh->sendResponse(
                    isSuccess: false,
                    statusCode: 200,
                    errorMessage: 'This number is not registered.',
                    responseData: null
                );
            }

            $otp_info = self::send_otp($request);
            
            if($otp_info['sms'] == 0) {
                return $this->rh->sendResponse(
                    isSuccess: true,
                    statusCode: 200,
                    errorMessage: '',
                    responseData: $otp_info
                );
            }
            return $this->rh->sendResponse(
                statusCode: 400,
                errorMessage: 'Failed to send OTP.',
            );

        } catch (\Exception $e) {
            return $this->rh->sendResponse(
                statusCode: 500,
                errorMessage: $e,
            );
        }
    }

    public function forgot_password_confirm(Request $request)
    {
        try {
            $registerUserData = $request->validate([
                'phone' => 'required|string',
                'password' => 'required|min:8',
                'otp' => 'required'
            ]);

            $otpRecord = Otp::where('phone', $request->phone)->first();

            if (!$otpRecord) {
                return $this->rh->sendResponse(
                    statusCode: 200,
                    errorMessage: 'This phone number is not verified! Please verify first.',
                );
            }

            if ($otpRecord->otp <> $registerUserData['otp']) {
                return $this->rh->sendResponse(
                    statusCode: 200,
                    errorMessage: 'This phone number is not verified! Please verify first.',
                );
            }

            $phone = $request->phone;
            $user = User::where('phone', $phone)->first();
            if ($user === null) {
                return $this->rh->sendResponse(
                    isSuccess: false,
                    statusCode: 200,
                    errorMessage: 'This User is not registered.',
                    responseData: null
                );
            }

            $user->password = Hash::make($registerUserData['password']);
            $user->update();

            Auth::login($user);
            $token = $user->createToken('API Token')->plainTextToken;
            $response = $this->getProfileResponse(true, $token, $user);

            return $this->rh->sendResponse(
                isSuccess: true,
                statusCode: 200,
                errorMessage: '',
                responseData: $response
            );
        } catch (\Illuminate\Validation\ValidationException $e) {

            return $this->rh->sendResponse(
                statusCode: 200,
                errorMessage: $e->getMessage(),
            );
        } catch (\Exception $e) {

            return $this->rh->sendResponse(
                statusCode: 500,
                errorMessage: $e,
            );
        }
    }
    //Forgot Password End ------------------------------->>>>>>>>>>>>>>>>>>

    public function authChangePassword(Request $request)
    {
        try {
            // Validate the input
            $request->validate([
                'old_password' => 'required|string|min:8',
                'password' => 'required|string|min:8|confirmed',
                'password_confirmation' => 'required'
            ]);

            // Retrieve input data
            $old_password = $request->old_password;
            $new_password = $request->password;
            $confirm_password = $request->password_confirmation;

            // Get the authenticated user
            $user = Auth::user();
            
            if ($user == null) {
                return $this->rh->sendResponse(
                    statusCode: 401,
                    errorMessage: 'No authenticated user found',
                );
            }

            // Check if the old password matches the current password
            if (!Hash::check($old_password, $user->password)) {
                return $this->rh->sendResponse(
                    statusCode: 400,
                    errorMessage: 'Old password does not match',
                );
            }

            // Check if the new password is different from the old password
            if ($old_password == $new_password) {
                return $this->rh->sendResponse(
                    statusCode: 400,
                    errorMessage: 'New password cannot be the same as the old password',
                );
            }

            // Hash the new password and save it to the user
            $user->password = Hash::make($new_password);
            $user->save();

            // Send success response
            return $this->rh->sendResponse(
                isSuccess: true,
                statusCode: 200,
                errorMessage: 'Password changed successfully',
            );

        } catch (\Exception $e) {
            // Handle exceptions and send error response
            return $this->rh->sendResponse(
                statusCode: 500,
                errorMessage: 'An error occurred: ' . $e->getMessage(),
            );
        }
    }


    

}
