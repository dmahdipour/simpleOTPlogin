@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center">کد تایید</h2>

    <form method="POST" action="{{ route('login.otpSend') }}">
        @csrf
        <button type="submit" class="w-full bg-yellow-500 text-white p-3 rounded hover:bg-yellow-600 mb-3">ارسال کد تایید</button>
    </form>

    @if(session('status'))
        <p class="text-center mb-4">{{ session('status') }}</p>
    @endif
    
    <form method="POST" action="{{ route('login.otpVerify') }}">
        @csrf
        <input type="text" name="otp" placeholder="کد تایید" required class="w-full p-3 mb-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('otp')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600">تایید</button>
    </form>
</div>
@endsection