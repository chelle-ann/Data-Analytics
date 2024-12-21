<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 1.5rem;
        }
        .logo img {
            width: 100px;
        }
        h3 {
            text-align: center;
            margin-bottom: 1rem;
            color: rgb(255, 0, 162);
        }
        .form-label {
            margin-bottom: 0.5rem;
            display: inline-block;
            font-weight: bold;
        }
        .form-control {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1.5rem;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .btn {
            background-color: rgb(255, 0, 162);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: 100%;
        }
        .btn:hover {
            background-color: #d4008d;
        }
        .links {
            text-align: center;
            margin-top: 1rem;
        }
        .links a {
            color: rgb(255, 0, 162);
            text-decoration: none;
            transition: color 0.3s;
        }
        .links a:hover {
            color: #d4008d;
        }
        small {
            display: block;
            text-align: center;
            margin-top: 2rem;
            color: #888;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Logo Section -->
        <div class="logo">
            <img src="{{ asset('image/carlogo.png') }}" alt="Logo">
        </div>
        <h3>Welcome Back</h3>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        @endif

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Input -->
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>
            @error('email')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            <!-- Password Input -->
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <input type="password" id="password" class="form-control" name="password" required>
            @error('password')
                <div class="text-danger small">{{ $message }}</div>
            @enderror

            <!-- Remember Me -->
            <div class="mb-3">
                <input type="checkbox" id="remember_me" name="remember">
                <label for="remember_me">{{ __('Remember Me') }}</label>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn">{{ __('Log in') }}</button>
        </form>

        <!-- Forgot Password & Register Links -->
        <div class="links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
            @endif
            <br>
            <a href="{{ route('register') }}">{{ __('Don’t have an account? Register') }}</a>
        </div>

        <small>&copy; {{ now()->year }} Car Sales Dashboard</small>
    </div>
</body>
</html>
