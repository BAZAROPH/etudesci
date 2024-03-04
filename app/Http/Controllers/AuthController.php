<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Mail\RegisterConfirmEmail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    //
    public function loginView(){
        if(Auth::check()){
            return redirect()->route('home');
        }
        return view('site.auth.auth');
    }

    public function loginValidation(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return response()->json([
                'success' => true,
            ]);
        }else{
            return response()->json([
                'success' => false,
            ]);
        }
    }

    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            // verified if user have e verified email)
            if(!is_null(Auth::user()->email_verified_at)){
                // return redirect()->route('home');
                $user = User::find(Auth::user()->id);
                $token = $user->createToken($request->_token);
                // dd($token->plainTextToken);
                session()->put('token', $token->plainTextToken);
                return redirect()->intended();
            }else{
                $user = [
                    'first_name' => Auth::user()->first_name,
                    'last_name' => Auth::user()->last_name,
                    'email' => Auth::user()->email,
                    'url' => route('confirm-email', Auth::user()->email_verify_token),
                ];
                Mail::to($user['email'])->send(new RegisterConfirmEmail($user));
                Auth::logout();
                return view('site.confirmations.mustConfirmUserEmail');
            }
        }
        return redirect()->route('login.view');
    }

    public function logout(){
        Auth::logout();
        return redirect()->back();
    }

    public function registerValidation(Request $request){
        if(!is_null($request->contact)){
            $user = User::where('email', $request->email)->orWhere('contact', $request->contact)->first();
        }else{
            $user = User::where('email', $request->email)->first();
        }
        return response()->json([
            'exist' => !is_null($user),
            'password' => $request->password == $request->confirm_password
        ]);
    }

    public function register(Request $request){
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email',
            'password' => 'required|same:confirm_password',
            'confirm_password' => 'required',
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'email_verify_token' => bin2hex(openssl_random_pseudo_bytes(16)),
        ]);

        if(!is_null($user)){
            $user = [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'url' => route('confirm-email', $user->email_verify_token),
            ];
            Mail::to($user['email'])->send(new RegisterConfirmEmail($user));
        }

        return view('site.confirmations.mustConfirmUserEmail');
    }

    public function confirmEmail($token){
        $user = User::where('email_verify_token', $token)->first();
        if(!is_null($user)){
            if(is_null($user->email_verified_at)){
                Auth::login($user);
                $user->update([
                    'email_verified_at' => Carbon::now(),
                ]);
                return view('site.confirmations.confirmUserEmail');

            }else{
                return view('site.errors.userEmailAlreadyConfirmed');
            }
        }else{
            return view('site.home');
        }
    }

    public function resetPasswordView(){
        return view('site.auth.resetPasswordRequest');
    }

    public function sendResetPassword(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users,email',
        ]);
        $user = User::where('email', $request->email)->first();
        $user->update([
            'email_verify_token' => bin2hex(openssl_random_pseudo_bytes(16))
        ]);
        $data = [
            'first_name' => $user->first_name,
            'url' => route('reset-password-preprocess', $user->email_verify_token),
        ];
        Mail::to($user->email)->send(new ResetPasswordEmail($data));
        return view('site.confirmations.mustConfirmUserEmail');
    }

    public function resetPasswordPreProcess($token){
        $user = User::first();
        // return view('site.auth.resetPassword', [
        //     'token' => $user->email_verify_token,
        // ]);
        if(!is_null($token)){
            $user = User::where('email_verify_token', $token)->first();
            if(!is_null($user)){
                // $user->update([
                //     'email_verify_token' => bin2hex(openssl_random_pseudo_bytes(16))
                // ]);
                return view('site.auth.resetPassword', [
                    'token' => $user->email_verify_token,
                ]);
            }
        }
        return redirect()->route('home');
    }

    public function resetPassword(Request $request){
        $request->validate([
            'new_password' => 'string|required',
            'confirm_password' => 'required|same:new_password',
            'token' => 'required',
        ]);

        $user = User::where('email_verify_token', $request->token)->first();
        if(!is_null($user)){
            $user->update([
                'password' => Hash::make($request->new_password),
                'email_verify_token' => bin2hex(openssl_random_pseudo_bytes(16))
            ]);
            return redirect()->route('login.view');
        }
        return redirect()->route('home');
    }
}
