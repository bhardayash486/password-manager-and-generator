<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Password Manager & Generator - Register</title>
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

        .register {
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

        .register:hover {
            background-color: #478746;
        }

        .error {
            background-color: #fdecec;
            color: #b42318;
            padding: 12px 20px;
            margin-bottom: 20px;
            border: 1px solid #f5b5b0;
            border-radius: 6px;
        }

        .error ul {
            margin: 0;
            padding-left: 20px;
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
                <img src="/images/register_icon.png" alt="Registration Icon">
            </div>

            <h1>Welcome to Password Manager & Generator</h1>
            <h2>Create Account</h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                @if(session('success'))
                    <div class="success-message">
                        {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                <div class="error">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <!-- Label & Text Field for Name -->
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" placeholder="Enter Your Name" required>
                </div>

                <!-- Label & Text Field for Email -->
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" placeholder="Enter Your Email" required>
                </div>

                <!-- Label & Text Field for Password -->
                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input type="password" id="password" name="password" placeholder="Enter Your Password" minlength="8" required>
                        <button type="button" onclick="toggleInputPassword(this)">Show</button>
                    </div>
                </div>

                <!-- Label & Text Field for Confirm Password -->
                <div class="form-group">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation"
                        placeholder="Enter Your Confirm Password" minlength="8" required>
                </div>

                <!-- Submit Button for Registration -->
                <button type="submit" class="register">Create Account</button>
            </form>

            <a href="{{ route('login') }}" class="back-link">Already have an account? Login</a>
            <a href="/" class="back-link">Back to Home</a>

        </div>
    </div>

    <script>
        const form = document.querySelector('form');
        const password = document.getElementById('password');
        const passwordConfirmation = document.getElementById('password_confirmation');

        form.addEventListener('submit', function(event) {
            if (password.value !== passwordConfirmation.value) {
                event.preventDefault();
                alert('Password and Confirm Password Do Not Match');
            }
        });

        // Show or Hide Button Logic
        function toggleInputPassword(btn) {
            if (password.type === 'password') {
                password.type = 'text';
                btn.innerText = 'Hide';
            } else {
                password.type = 'password';
                btn.innerText = 'Show'
            }
        }
    </script>

</body>
</html>