<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
            color: #333;
        }
        header {
            background-color:rgb(255, 0, 162);
            color: white;
            text-align: center;
            padding: 1em 0;
        }
        main {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 80vh;
            text-align: center;
        }
        h1 {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }
        p {
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }
        .buttons {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }
        a {
            display: inline-block;
            text-decoration: none;
            background-color:rgb(255, 0, 162);
            color: white;
            padding: 0.75em 1.5em;
            border-radius: 5px;
            font-size: 1rem;
            transition: background-color 0.3s;
        }
        a:hover {
            background-color: #0056b3;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1em 0;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>
<body>
    <header>
        <h1>Welcome to the Car Sales Dashboard</h1>
    </header>
    <main>
        <h1>Manage Your Sales Effectively!</h1>
        <p>Track, analyze, and optimize your car sales performance with our dynamic dashboard.</p>
        <div class="buttons">
    @auth
        <!-- If the user is logged in -->
        <a class="btn" href="{{ route('dashboard') }}">Dashboard</a>
    @else
        <!-- If the user is not logged in -->
        <a class="btn" href="{{ route('login') }}">Login</a>
        <a class="btn" href="{{ route('register') }}">Register</a>
    @endauth
</div>

    </main>
    <footer>
        &copy; 2024 Car Sales Dashboard. All rights reserved.
    </footer>
</body>
</html>
