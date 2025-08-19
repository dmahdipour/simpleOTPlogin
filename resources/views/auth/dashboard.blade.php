@extends('layouts.app')

@section('content')
<div class="max-w-lg mx-auto bg-white p-6 rounded shadow text-center">
    <h1 class="text-3xl font-bold text-blue-600 mb-4">خوش آمدید {{ auth()->user()->name ?? '' }} {{ auth()->user()->family ?? '' }}</p>
    <a href="{{route('login')}}" class="text-xl text-red-500 mb-4">Logout</a>
</div>
@endsection