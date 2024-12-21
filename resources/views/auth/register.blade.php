<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }

        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 2rem;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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
            margin-bottom: 1.5rem;
            color: rgb(255, 0, 162);
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 0.5rem;
        }

        input {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        .error {
            color: red;
            font-size: 0.875rem;
            margin-top: -0.75rem;
            margin-bottom: 1rem;
        }

        button {
            background-color: rgb(255, 0, 162);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            width: 100%;
        }

        button:hover {
            background-color: #d4008d;
        }

        .links {
            text-align: center;
            margin-top: 1rem;
        }

        .links a {
            color: rgb(255, 0, 162);
            text-decoration: none;
        }

        .links a:hover {
            text-decoration: underline;
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
        <h3>Register</h3>

        <!-- Registration Form -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <label for="name">{{ __('Name') }}</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Email Address -->
            <label for="email">{{ __('Email') }}</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Password -->
            <label for="password">{{ __('Password') }}</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Confirm Password -->
            <label for="password_confirmation">{{ __('Confirm Password') }}</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            @error('password_confirmation')
                <div class="error">{{ $message }}</div>
            @enderror

            <!-- Register Button -->
            <button type="submit">{{ __('Register') }}</button>
        </form>

        <!-- Already Registered? -->
        <div class="links">
            <a href="{{ route('login') }}">{{ __('Already registered? Log in') }}</a>
        </div>

        <small>&copy; {{ now()->year }} Car Sales Dashboard</small>
    </div>
</body>
</html>
