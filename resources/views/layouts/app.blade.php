<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>
        @yield('title', 'Password Manager & Generator')
    </title>
    <style>
        /* General */
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f6f8;
            color: #1f2937;
        }

        /* Sidebar */
        .sidebar {
            position: fixed;
            left: 0;
            top: 0;
            width: 250px;
            height: 100vh;
            background-color: #243b5f;
            color: white;
            padding: 25px 15px;
            z-index: 1000;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 10px 25px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.15);
            font-size: 18px;
            font-weight: bold;
            line-height: 1.3;
        }

        .logo img {
            width: 45px;
            height: 45px;
            object-fit: contain;
            flex-shrink: 0;
        }

        /* Menu */
        .menu {
            margin-top: 25px;
        }

        .menu a {
            display: block;
            text-decoration: none;
            color: #e5edf5;
            padding: 13px 15px;
            margin-bottom: 7px;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.2s;
        }

        .menu a:hover {
            background-color: #325481;
            color: white;
        }

        .menu a.active {
            background-color: #325481;
            color: white;
        }

        /* Logout */
        .logout {
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.15);
        }

        .logout-btn {
            width: 100%;
            border: none;
            background-color: #dc3545;
            color: white;
            padding: 12px;
            border-radius: 8px;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }

        .logout-btn:hover {
            background-color: #c82333;
        }

        /* Main Content */
        .main {
            margin-left: 250px;
            min-height: 100vh;
        }

        /* Topbar */
        .topbar {
            height: 70px;
            background-color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 35px;
            border-bottom: 1px solid #e5e7eb;
        }

        .topbar h2 {
            margin: 0;
            color: #243b5f;
            font-size: 22px;
        }

        .user {
            background-color: #eef5f8;
            color: #325481;
            border-radius: 20px;
            font-size: 14px;
            font-weight: bold;
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 5px 12px 5px 6px;
        }

        .user img {
            width: 35px;
            height: 35px;
            object-fit: contain;
            flex-shrink: 0;
        }

        /* Page Content */
        .content {
            padding: 35px;
        }

        /* Responsive */
        @media (max-width: 900px) {

            .sidebar {
                width: 210px;
            }

            .main {
                margin-left: 210px;
            }

            .content {
                padding: 25px;
            }

        }

        @media (max-width: 700px) {

            .sidebar {
                position: relative;
                width: 100%;
                height: auto;
                padding: 15px;
            }

            .main {
                margin-left: 0;
            }

            .logo {
                justify-content: center;
            }

            .menu {
                margin-top: 15px;
            }

            .menu a {
                text-align: center;
            }

            .logout {
                margin-top: 15px;
            }

            .topbar {
                padding: 0 20px;
            }

            .topbar h2 {
                font-size: 18px;
            }

            .user {
                font-size: 12px;

                padding: 7px 10px;
            }

            .content {
                padding: 20px;
            }

        }
    </style>
</head>

<body>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">
            <img src="/images/icon.png" alt="Password Manager Logo">
            <span> Password Manager & Generator </span>
        </div>

        <nav class="menu">

            <!-- Dashboard -->
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}"> Dashboard </a>

            <!-- My Passwords -->
            <a href="{{ route('passwords.index') }}" class="{{ request()->routeIs('passwords.index') ? 'active' : '' }}"> My Passwords </a>

            <!-- Password Generator -->
            <a href="{{ route('passwords.generator') }}" class="{{ request()->routeIs('passwords.generator') ? 'active' : '' }}">
                Password Generator 
            </a>

            <!-- Categories -->
            <a href="{{ route('categories.index') }}" class="{{ request()->routeIs('categories.index') ? 'active' : '' }}"> Categories </a>

            <!-- Profile -->
            <a href="{{ route('profile') }}" class="{{ request()->routeIs('profile') ? 'active' : '' }}"> Profile </a>

            <!-- Settings -->
            <a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active' : '' }}"> Settings </a>

            <!-- Logout -->
            <div class="logout">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="logout-btn"> Logout </button>

                </form>
            </div>
        </nav>
    </aside>


    <!-- Main -->
    <main class="main">

        <!-- Topbar -->
        <header class="topbar">
            <h2> @yield('page-title', 'Dashboard') </h2>

            <div class="user">
                <img src="{{ Auth::user()->profile_pic ? asset(Auth::user()->profile_pic) : asset('images/user.png') }}" alt="User Icon"
                onerror="this.onerror=null; this.src='{{ asset('images/user.png') }}';">
                {{ Auth::user()->name }}

            </div>
        </header>

        <!-- Page Content -->
        <section class="content">

            @yield('content')

        </section>

    </main>

</body>
</html>