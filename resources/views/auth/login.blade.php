<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - {{ config('app.name', 'CarbonAI') }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <style>
        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #FDFDFC;
            padding: 20px;
        }
        .login-box {
            max-width: 400px;
            width: 100%;
            background: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            padding: 32px;
        }
        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .login-header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #1b1b18;
            margin: 0 0 8px 0;
        }
        .login-header p {
            color: #706f6c;
            margin: 0;
            font-size: 14px;
        }
        .error-message {
            background: #fee2e2;
            border: 1px solid #ef4444;
            color: #991b1b;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 24px;
            font-size: 14px;
        }
        .form-group {
            margin-bottom: 24px;
        }
        .form-label {
            display: block;
            font-size: 14px;
            font-weight: 500;
            color: #1b1b18;
            margin-bottom: 8px;
        }
        .form-input {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 4px;
            font-size: 14px;
            color: #1b1b18;
            background: white;
            box-sizing: border-box;
        }
        .form-input:focus {
            outline: none;
            border-color: #16d3ca;
            box-shadow: 0 0 0 2px rgba(22, 211, 202, 0.1);
        }
        .form-input::placeholder {
            color: #9ca3af;
        }
        .btn-submit {
            width: 100%;
            background: #1b1b18;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 4px;
            font-size: 14px;
            font-weight: 500;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-submit:hover {
            background: #000;
        }
        .btn-submit:focus {
            outline: none;
            box-shadow: 0 0 0 2px rgba(27, 27, 24, 0.2);
        }
        .back-link {
            margin-top: 24px;
            text-align: center;
        }
        .back-link a {
            font-size: 14px;
            color: #706f6c;
            text-decoration: none;
        }
        .back-link a:hover {
            color: #1b1b18;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <div class="login-header">
                <h1>Admin Login</h1>
                <p>Sign in to access the admin panel</p>
            </div>

            @if($errors->any())
                <div class="error-message">
                    @foreach($errors->all() as $error)
                        <p style="margin: 0;">{{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email Address</label>
                    <input type="email"
                           id="email"
                           name="email"
                           value="{{ old('email') }}"
                           autocomplete="email"
                           class="form-input"
                           placeholder="Enter your email"
                           required
                           autofocus>
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Password</label>
                    <input type="password"
                           id="password"
                           name="password"
                           autocomplete="current-password"
                           class="form-input"
                           placeholder="Enter your password"
                           required>
                </div>

                <button type="submit" class="btn-submit">
                    Sign In
                </button>
            </form>

            <div class="back-link">
                <a href="{{ route('home') }}">← Back to Home</a>
            </div>
        </div>
    </div>
</body>
</html>
