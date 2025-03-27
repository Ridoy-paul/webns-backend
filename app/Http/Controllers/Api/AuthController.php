<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ResponseHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Laravel\Facades\Image;

class AuthController extends Controller
{

    protected ResponseHelper $rh;

    public function __construct(ResponseHelper $rh) 
    {
        $this->rh = $rh;
    }



    public function register(Request $request)
    {
        try {
            $registerUserData = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8',
            ]);
    
            $user = User::create([
                'name' => $registerUserData['name'],
                'email' => $registerUserData['email'],
                'type' => 'user',
                'is_verified' => true,
                'is_active' => true,
                'password' => Hash::make($registerUserData['password']),
            ]);

            $success = [
                '_token' => $user->createToken('API Token')->plainTextToken,
                'token_type' => 'Bearer',
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'type' => $user->type ?? 'user',
            ];
    
            return $this->rh->sendResponse(
                isSuccess: true,
                statusCode: 200,
                errorMessage: '',
                responseData: $success
            );

        }
        catch (\Illuminate\Validation\ValidationException $e) {
            
            return $this->rh->sendResponse(
                statusCode: 400,
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
                'email' => 'required',
                'password' => 'required'
            ]);


            if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
                $request->session()->regenerate();
                $user = Auth::user(); 

                $success = [
                    '_token' => $user->createToken('API Token')->plainTextToken,
                    'token_type' => 'Bearer',
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'type' => $user->type ?? 'user',
                ];

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

    
    public static function getProfileResponse($isToken = false, $token = '', $user) {

        if($isToken == true) {
            $success['_token'] =  $token;
            $success['token_type'] = 'Bearer';
        }
        
        $success['id'] = $user->id;
        $success['name'] = $user->name;
        $success['phone'] = $user->phone ?? '';
        $success['email'] = $user->email;
        $success['photo'] = $user->photo ?? '';
        $success['type'] = $user->type ?? '';

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
            
                $imageName = time() . rand(10000, 99999) . '.' . $request->file('photo')->getClientOriginalExtension();
                $destinationPath = public_path('images/');
                $image->save($destinationPath . $imageName);
            
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
