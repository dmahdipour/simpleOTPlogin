<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\VerifyPaswordRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Http\Requests\StoreUserRequest;
use App\Jobs\SendOtpJob;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;

class AuthController extends Controller
{
    public function showMobileForm() {
        return view('auth.mobile');
    }

    public function sendOtp(LoginRequest $request) {
        $mobile = $request->mobile;

        if (User::where('mobile', $mobile)->exists()) {
            return redirect()->route('password.form')->with('mobile', $mobile);
        }

        SendOtpJob::dispatch($mobile);
        session(['login_mobile' => $mobile]);

        return redirect()->route('otp.form')->with(['success' => 'کد تایید ارسال شد.']);
    }

    public function showOtpForm() {
        return view('auth.otp');
    }

    public function verifyOtp(VerifyOtpRequest $request) {
        $mobile = session('login_mobile');
        $storedOtp = Redis::get("otp:$mobile");
        if ($storedOtp && $storedOtp == $request->otp) {
            return redirect()->route('register.form')->with('mobile', $mobile);
        }
        return back()->withErrors(['otp' => 'کد تایید نامعتبر است.']);
    }

    public function passwordForm() {
        return view('auth.password');
    }

    public function passwordVerify(VerifyPaswordRequest $request) {
        $mobile = session('login_mobile');
        $user = User::where('mobile', $mobile)->first();
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['password' => 'رمز عبور نادرست است.']);
    }


    public function showRegisterForm() {
        $mobile = session('login_mobile') ?? session('mobile');
        return view('auth.register', compact('mobile'));
    }

    public function storeUserData(StoreUserRequest $request) {
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

    public function logout() {
        Auth::logout();
        return redirect()->route('login.form');
    }
}