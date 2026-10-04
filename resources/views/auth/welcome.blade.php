<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Password Manager & Generator</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f6f8;
            color: #24313f;
        }

        /* Nav Bar */
        .navbar {
            background-color: white;
            padding: 15px 40px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 8px rgba(36, 59, 95, 0.12);
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 22px;
            font-weight: bold;
            color: #243b5f;
        }

        .logo img {
            width: 70px;
            height: 70px;
            object-fit: contain;
        }

        .nav-links {
            display: flex;
            gap: 25px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #24313f;
            font-size: 15px;
        }

        .nav-links a:hover {
            color: #325481;
        }

        .register-btn {
            background-color: #569c54;
            color: white !important;
            padding: 9px 16px;
            border-radius: 5px;
        }

        .register-btn:hover {
            background-color: #478746;
        }

        /* Hero Section */
        .hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
            max-width: 1200px;
            margin: 0 auto;
            padding: 70px 40px;
        }

        .hero-content {
            flex: 1;
        }

        .hero-image {
            flex: 1;
            text-align: center;
        }

        .hero-image img {
            width: 100%;
            max-width: 500px;
            height: auto;
            object-fit: contain;
        }

        .hero h1 {
            font-size: 42px;
            color: #243b5f;
            margin-bottom: 15px;
        }

        .hero h2 {
            font-size: 25px;
            color: #325481;
            margin-bottom: 15px;
        }

        .hero p {
            font-size: 17px;
            color: #5f6b76;
            max-width: 650px;
            margin: 0 0 30px;
            line-height: 1.6;
        }

        .hero-buttons {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
        }

        .btn {
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 5px;
            font-size: 16px;
        }

        .primary-btn {
            background-color: #569c54;
            color: white;
        }

        .primary-btn:hover {
            background-color: #478746;
        }

        .secondary-btn {
            background-color: white;
            color: #325481;
            border: 1px solid #325481;
        }

        .secondary-btn:hover {
            background-color: #eef3f7;
        }

        /* Features Section */
        .features {
            background-color: white;
            text-align: center;
            padding: 70px 40px;
        }

        .features h2 {
            font-size: 30px;
            color: #243b5f;
            margin-bottom: 10px;
        }

        .features>p {
            color: #5f6b76;
            margin-bottom: 40px;
        }

        .feature-container {
            display: flex;
            justify-content: center;
            gap: 25px;
            flex-wrap: wrap;
        }

        .feature-box {
            width: 220px;
            padding: 25px;
            border: 1px solid #dce3e8;
            border-radius: 8px;
            background-color: #f3f6f8;
            box-shadow: 0 2px 8px rgba(36, 59, 95, 0.05);
        }

        .feature-box h3 {
            color: #325481;
            font-size: 18px;
        }

        .feature-box p {
            color: #5f6b76;
            font-size: 14px;
            line-height: 1.5;
        }

        /* About Section */
        .about {
            text-align: center;
            padding: 70px 40px;
            background-color: #f3f6f8;
        }

        .about h2 {
            font-size: 30px;
            color: #243b5f;
            margin-bottom: 20px;
        }

        .about p {
            max-width: 700px;
            margin: 0 auto;
            font-size: 16px;
            color: #5f6b76;
            line-height: 1.7;
        }

        /* Footer Section */
        .footer {
            background-color: #243b5f;
            color: white;
            text-align: center;
            padding: 25px 20px;
        }

        .footer h3 {
            font-size: 20px;
            margin: 0 0 10px;
        }

        .footer p {
            margin: 5px 0;
            font-size: 14px;
        }

        @media (max-width: 900px) {
            .navbar {
                padding: 15px 25px;
            }

            .nav-links {
                gap: 15px;
            }

            .hero {
                flex-direction: column;
                text-align: center;
                padding: 50px 25px;
            }

            .hero-buttons {
                justify-content: center;
            }

            .hero-image img {
                max-width: 400px;
            }
        }

        @media (max-width: 650px) {
            .navbar {
                flex-direction: column;
                gap: 15px;
            }

            .nav-links {
                flex-wrap: wrap;
                justify-content: center;
            }

            .hero h1 {
                font-size: 32px;
            }

            .hero h2 {
                font-size: 22px;
            }

            .features,
            .about {
                padding: 50px 20px;
            }
        }
    </style>
</head>

<body>

    <!-- Header Section -->
    <header class="navbar">

        <div class="logo">
            <img src="/images/icon.png" alt="Password Manager Logo">
            <span>Password Manager & Generator</span>
        </div>

        <nav class="nav-links">
            <a href="/">Home</a>
            <a href="#features">Features</a>
            <a href="#about">About</a>
            <a href="{{ route('login') }}">Login</a>
            <a href="{{ route('register') }}" class="register-btn">Register</a>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-content">
            <h1>Password Manager & Generator</h1>
            <h2>Secure. Simple. Protected.</h2>

            <p>
                Securely manage your passwords in one place and generate strong passwords whenever you need them.
            </p>

            <div class="hero-buttons">
                <a href="{{ route('register') }}" class="btn primary-btn">Get Started</a>
                <a href="{{ route('login') }}" class="btn secondary-btn">Login</a>
            </div>
        </div>

        <div class="hero-image">
            <img src="{{ asset('images/home-security.png') }}" alt="Password Security">
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <h2>Our Features</h2>
        <p>Everything you need to manage your passwords easily.</p>

        <div class="feature-container">

            <div class="feature-box">
                <h3>Secure Password Storage</h3>
                <p>Store your passwords securely in one place.</p>
            </div>

            <div class="feature-box">
                <h3>Password Generator</h3>
                <p>Generate strong passwords for your accounts.</p>
            </div>

            <div class="feature-box">
                <h3>Organize Passwords</h3>
                <p>Organize your passwords using different categories.</p>
            </div>

            <div class="feature-box">
                <h3>Show / Hide Passwords</h3>
                <p>Easily show or hide stored passwords when needed.</p>
            </div>

            <div class="feature-box">
                <h3>Search Passwords</h3>
                <p>Quickly find your saved passwords.</p>
            </div>

            <div class="feature-box">
                <h3>Edit & Delete</h3>
                <p>Update or remove saved password entries easily.</p>
            </div>

        </div>
    </section>

    <!-- About Section -->
    <section class="about" id="about">
        <h2>About Our Web Application</h2>
        <p>
            Password Manager & Generator is designed to help users
            securely manage their passwords and generate strong passwords
            for their online accounts. The web application provides a simple
            and convenient way to store, organize, search, and manage
            passwords in one place.
        </p>
    </section>

    <!-- Footer Section -->
    <footer class="footer">
        <h3>Password Manager & Generator</h3>

        <p>Secure. Simple. Protected.</p>

        <p>© 2026 Password Manager & Generator. All Rights Reserved.</p>
    </footer>

</body>
</html>