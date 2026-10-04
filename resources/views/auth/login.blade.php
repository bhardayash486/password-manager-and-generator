<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Password Manager & Generator - Login</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 30px 15px;
            font-family: Arial, sans-serif;
            background-color: #f3f6f8;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 20px auto;
        }

        .form-card {
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(36, 59, 95, 0.10);
        }

        .logo-section {
            text-align: center;
            margin-bottom: 15px;
        }

        .logo-section img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        h1 {
            text-align: center;
            color: #243b5f;
            font-size: 26px;
            margin-bottom: 15px;
            line-height: 1.3;
        }

        h2 {
            text-align: center;
            color: #325481;
            font-size: 24px;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 7px;
            color: #243b5f;
        }

        input,
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #cfd6dc;
            border-radius: 6px;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        input:focus,
        select:focus {
            border-color: #325481;
            box-shadow: 0 0 5px rgba(50, 84, 129, 0.20);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper input {
            padding-right: 70px;
        }

        .password-wrapper button {
            position: absolute;
            right: 8px;
            top: 50%;
            transform: translateY(-50%);
            padding: 5px 8px;
            border: none;
            background-color: transparent;
            color: #325481;
            font-weight: bold;
            cursor: pointer;
        }

        .password-wrapper button:hover {
            color: #243b5f;
        }

        .login {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 6px;
            background-color: #569c54;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            margin-top: 8px;
            transition: 0.2s;
        }

        .login:hover {
            background-color: #478746;
        }

        .success-message {
            background-color: #e8f5e9;
            color: #478746;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #b7dfbf;
            border-radius: 5px;
            text-align: center;
            font-weight: bold;
        }

        .error {
            background-color: #fdecec;
            color: #b42318;
            text-align: center;
            padding: 12px 20px;
            margin-bottom: 20px;
            border: 1px solid #f5b5b0;
            border-radius: 6px;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #325481;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            color: #243b5f;
            text-decoration: underline;
        }

        @media (max-width: 500px) {
            body {
                padding: 15px;
            }

            .form-card {
                padding: 22px;
            }

            h1 {
                font-size: 23px;
            }

            h2 {
                font-size: 21px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-card">

            <!-- Logo -->
            <div class="logo-section">
                <img src="/images/login_icon.png" alt="Login Icon">
            </div>

            <h1>Welcome to Password Manager & Generator</h1>
            <h2>Login</h2>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                @if(session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
                @endif

                @if(session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
                @endif

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" placeholder="Enter Your Password" minlength="8" required>
                        <button type="button" onclick="toggleInputPassword(this)">Show</button>
                    </div>
                </div>

                <button type="submit" class="login">Login</button>
            </form>

            <a href="{{ route('register') }}" class="back-link">Don't have an account? Register</a>
            <a href="/" class="back-link">Back to Home</a>

        </div>
    </div>

    <script>
        function toggleInputPassword(btn) {
            let pwdInput = document.getElementById('password');

            if (pwdInput.type === 'password') {
                pwdInput.type = 'text';
                btn.innerText = 'Hide';
            } else {
                pwdInput.type = 'password';
                btn.innerText = 'Show';
            }
        }
    </script>

</body>
</html>