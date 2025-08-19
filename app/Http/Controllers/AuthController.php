<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use App\Models\User;
use App\Jobs\SendOtpJob;

class AuthController extends Controller
{
    // Display Dasboard
    public function dashboard(){
        return view('auth.dashboard');
    }

    // Login Form by Mobile
    public function showMobileForm() {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return view('auth.mobile');
    }

    // Check if this phone was registed or not
    public function checkMobile(Request $request) {
        $mobile = $this->normalizeNumber($request->mobile);
        $user = User::where('mobile', $mobile)->first();
        if ($user) {
            session(['login_mobile' => $mobile]);
            return redirect()->route('login.passwordForm');
        }
        session(['login_mobile' => $mobile]);
        return redirect()->route('login.otpForm');
    }

    // Request Password if you have already Registered
    public function showPasswordForm() {
        return view('auth.password');
    }

    // POST for login by Password
    public function loginWithPassword(Request $request) {
        $request->validate(['password' => 'required']);
        $mobile = session('login_mobile');
        $user = User::where('mobile', $mobile)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['password' => 'رمز عبور نادرست است.']);
    }

    // Display OTP form if you haven't registed before.
    public function showOtpForm() {
        return view('auth.otp');
    }

    // Sending OTP by SMS => I deplay it temprory for now.
    public function sendOtp(Request $request) {
        $mobile = session('login_mobile');
        $otp = rand(100000, 999999);
        Redis::setex("otp:$mobile", 120, $otp);
        SendOtpJob::dispatch($mobile, $otp);
        return back()->with('status', 'کد تایید ارسال شد.'.$otp);
    }

    // Verify OTP code => if correct redirect to register form
    public function verifyOtp(Request $request) {
        $request->validate(['otp' => 'required|numeric']);
        $mobile = session('login_mobile');
        $storedOtp = Redis::get("otp:$mobile");
        if ($storedOtp && $storedOtp == $request->otp) {
            session(['mobile' => $mobile]);
            return redirect()->route('register.form');
        }
        return back()->withErrors(['otp' => 'کد تایید نامعتبر است.']);
    }

    // Display Register Form
    public function showRegisterForm() {
        return view('auth.register');
    }

    // POST for registering user data.
    public function storeUserData(Request $request) {
        $request->validate([
            'name' => 'required|string',
            'family' => 'required|string',
            'national_code' => 'required|numeric|digits:10|unique:users,national_code',
            'mobile' => 'required|string|unique:users,mobile',
            'password' => 'required|string|min:6'
        ]);
        $user = User::create([
            'name'          => $request->name,
            'family'        => $request->family,
            'national_code' => $request->national_code,
            'mobile'        => $request->mobile,
            'password'      => Hash::make($request->password),
        ]);
        Auth::login($user);
        return redirect()->route('dashboard');
    }

    // Handling Persian digits.
    private function normalizeNumber($number) {
        $persian = ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'];
        $english = ['0','1','2','3','4','5','6','7','8','9'];
        return str_replace($persian, $english, $number);
    }
}