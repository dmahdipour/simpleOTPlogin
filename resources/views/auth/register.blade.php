@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center">ثبت اطلاعات کاربر</h2>
    <form method="POST" action="{{ route('register.store') }}">
        @csrf
        <input type="hidden" name="mobile" value="{{ session('mobile') }}">
        <input type="text" name="name" placeholder="نام" required class="w-full p-3 mb-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('name')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror
        <input type="text" name="family" placeholder="نام خانوادگی" required class="w-full p-3 mb-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('family')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror
        <input type="text" name="national_code" placeholder="کد ملی" required class="w-full p-3 mb-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('national_code')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror
        <input type="password" name="password" placeholder="رمز عبور" required class="w-full p-3 mb-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="w-full bg-green-500 text-white p-3 rounded hover:bg-green-600">ثبت</button>
    </form>
@endsection