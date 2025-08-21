@extends('layouts.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow">
    <h2 class="text-2xl font-bold mb-4 text-center">ورود با موبایل و رمز عبور</h2>
    <form method="POST" action="{{ route('password.verify') }}">
        @csrf
        <input type="password" name="password" placeholder="رمز عبور" required class="w-full p-3 mb-3 border rounded focus:outline-none focus:ring-2 focus:ring-blue-500">
        @error('password')<p class="text-red-500 text-sm mb-2">{{ $message }}</p>@enderror
        <button type="submit" class="w-full bg-blue-500 text-white p-3 rounded hover:bg-blue-600">ورود</button>
    </form>
@endsection