@extends('layouts.app')

@section('content')
<div class="hero-section bg-blue-500 text-white py-20 text-center">
    <h1 class="text-4xl font-semibold">Welcome to Our Platform</h1>
    <p class="mt-4 text-lg">An easy and efficient way to manage your loans</p>
    <a href="{{ route('login') }}" class="mt-6 inline-block bg-yellow-500 text-black py-2 px-6 rounded-full text-xl">Login</a>
    <a href="{{ route('register') }}" class="mt-4 inline-block bg-transparent text-yellow-500 py-2 px-6 border-2 border-yellow-500 rounded-full text-xl">Sign Up</a>
</div>
@endsection
