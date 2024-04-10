<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Artisan;
use ReCaptcha\ReCaptcha;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use App\Mail\ResetPasswordMail;

class LoginController extends Controller
{
    public function getLoginpage()
    {
        return view('login');
    }
    public function loginSubmit(Request $request)
    {
        $credentials =  $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        $response = $request->input('g-recaptcha-response');
        $recaptcha = new ReCaptcha('6LdPH-4mAAAAAN-5aLMSsIh4X3CFhS67lfjO6evV');
        $recaptchaResult = $recaptcha->verify($response);
        //  dd($recaptchaResult);
        if (!$recaptchaResult->isSuccess()) {
            // reCAPTCHA validation failed
            $errors = $recaptchaResult->getErrorCodes();
            // Handle the error or redirect back with error messages
        }
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            $user = Auth::user();
            $token = $user->createToken('Api Token')->plainTextToken;
            if ($user->role == 'superuser') {
                return redirect()->route('dashboard');
            } else if ($user->role == 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('notfound');
            }
        } else {
            return redirect()->route('login');
        }
    }
    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect('/login');
    }
    public function forgotPassword()
    {
        return view('forget');
    }
    public function sendLink(Request $req)
    {
        $email = $req->email;
        $otp = 0;
        do {
            $otp = rand(100000, 999999);
        } while (User::where('otp_code', $otp)->first());
        $user = User::where('email', $email)->first();
        $user->otp_code = $otp;
        $user->update();
        $mailData['name'] = $user->name;
        $mailData['code'] = $user->otp_code;
        Mail::to($email)->send(new ResetPasswordMail($mailData));
        session()->flash('success', 'Please Check Your Email');
        return redirect('/login');
    }
    public function get_reset_password()
    {
        return view('reset-password');
    }
    public function resetPassword(Request $req)
    {
        $user = User::where('otp_code', $req->otp)->first();
        if ($req->password == $req->confirm_password) {
            $user->password = Hash::make($req->password);
            $user->update();
            session()->flash('success', 'Password Changed Succesfully');
            return redirect('/login');
        } else {
            session()->flash('error', 'Password Does Not Match');
            return redirect('/login');
        }
    }
}
