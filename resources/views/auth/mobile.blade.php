@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center">ورود با موبایل</h2>
    <form method="POST" action="{{ route('login.checkMobile') }}">
        @csrf
        <input type="text" name="mobile" placeholder="شماره موبایل" required class="w-full p-3 mb-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('mobile')
            <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
        @enderror
        <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600">ادامه</button>
    </form>
</div>
@endsection