<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    public function login() {
        return view('auth.login');
    }
    
    public function loginConfirm(Request $request) {
        //dd($request->all());
        $code = $request->code ?? null;

        if($code <> '2025@@tolet') {
            return redirect()->back();
        }

        $email = $request->input('email');
        $password = $request->input('password');

        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            Auth::login($user);
            return redirect()->intended('dashboard')->with('success', 'Login Successful!');
        } else {
            return back()->withErrors([
                'email' => 'Provided credentials is not valid!',
            ]);
        }

    }


    public function register() {
        return view('auth.register');
    }


    public function registration_confirm(Request $request) {

        $code = $request->code ?? null;

        if($code <> '2025@@toletbd') {
            return redirect()->back();
        }
        
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            // 'phone' => 'required|string|max:15',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 400);
        }



        $name = $request->name;
        $phone = $request->phone;
        $email = $request->input('email');
        $password = $request->input('password');

        $hashedPassword = Hash::make($password);

        $user = new User;
        $user->name = $name;
        $user->phone = 'admin0000000';
        $user->email = $email;
        $user->type = 'admin';
        $user->is_mess_system_active = 0;
        $user->is_active = 1;
        
        $user->password = $hashedPassword;

        if($user->save()) {
            Auth::login($user);

            if(Auth::check()) {
                return redirect()->route('index')->with('success', 'Registration Complete Successfully!');
            }
        }
    }

    public function logout()
    {
        if(Auth::check()) {
            Auth::logout();
        }

        return redirect('/');
    }



}
