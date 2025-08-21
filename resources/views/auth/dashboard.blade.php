@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow text-center">
    <h1 class="text-3xl font-bold text-blue-600 mb-4">خوش آمدید {{ auth()->user()->name ?? '' }} {{ auth()->user()->family ?? '' }}</p>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="text-xl text-red-500 mb-4">خروج</button>
    </form>
</div>
@endsection