<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login | WMS</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            display: flex;
            flex-direction: column;
        }

        /* Navbar */
        .navbar {
            background: #ffffff;
            padding: 18px 0;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
        }

        .navbar-brand {
            font-size: 25px;
            font-weight: 800;
            color: #243b80 !important;
            letter-spacing: 1px;
        }

        .navbar-brand i {
            margin-right: 8px;
            color: #4f6df5;
        }

        .home-link {
            text-decoration: none;
            color: #374151;
            font-weight: 600;
            transition: 0.3s;
        }

        .home-link:hover {
            color: #4f46e5;
        }

        /* Login Section */
        .login-section {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 45px 15px;
        }

        .login-card {
            width: 100%;
            max-width: 460px;
            background: #ffffff;
            border-radius: 22px;
            padding: 42px;
            box-shadow: 0 15px 50px rgba(31, 41, 55, 0.10);
            border: 1px solid #edf0f7;
        }

        .login-icon {
            width: 75px;
            height: 75px;
            margin: 0 auto 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #eef2ff;
            color: #4f46e5;
            font-size: 30px;
            border-radius: 20px;
        }

        .login-title {
            text-align: center;
            font-size: 29px;
            font-weight: 750;
            color: #172554;
            margin-bottom: 9px;
        }

        .login-subtitle {
            text-align: center;
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 30px;
        }

        .form-label {
            font-size: 14px;
            font-weight: 650;
            color: #374151;
            margin-bottom: 9px;
        }

        .input-group {
            margin-bottom: 22px;
        }

        .input-group-text {
            background: #f9fafb;
            border: 1px solid #dfe3ec;
            border-right: none;
            color: #64748b;
            padding: 12px 15px;
            border-radius: 10px 0 0 10px;
        }

        .form-control {
            padding: 12px 14px;
            border: 1px solid #dfe3ec;
            border-left: none;
            border-radius: 0 10px 10px 0;
            font-size: 14px;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: #a5b4fc;
            background: #ffffff;
        }

        .input-group:focus-within .input-group-text {
            border-color: #a5b4fc;
            color: #4f46e5;
        }

        .password-toggle {
            background: #f9fafb;
            border: 1px solid #dfe3ec;
            border-left: none;
            color: #64748b;
            border-radius: 0 10px 10px 0;
            padding: 0 14px;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: #4f46e5;
        }

        .password-input {
            border-radius: 0 !important;
        }

        .login-btn {
            width: 100%;
            border: none;
            border-radius: 10px;
            padding: 14px;
            background: linear-gradient(135deg, #4f46e5, #3730a3);
            color: white;
            font-weight: 700;
            font-size: 15px;
            margin-top: 5px;
            transition: all 0.3s ease;
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #4338ca, #312e81);
            transform: translateY(-2px);
            box-shadow: 0 8px 18px rgba(79, 70, 229, 0.25);
        }

        .login-btn i {
            margin-left: 8px;
        }

        .security-note {
            text-align: center;
            color: #6b7280;
            font-size: 12px;
            margin-top: 24px;
        }

        .security-note i {
            color: #16a34a;
            margin-right: 5px;
        }

        .footer {
            text-align: center;
            padding: 18px 10px;
            color: #6b7280;
            font-size: 12px;
        }

        .error-message {
            color: #dc2626;
            font-size: 12px;
            margin-top: -15px;
            margin-bottom: 16px;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 22px;
                border-radius: 18px;
            }

            .login-title {
                font-size: 25px;
            }
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="container d-flex justify-content-between align-items-center">

            <a class="navbar-brand" href="{{ url('/') }}">
                <i class="fa-solid fa-warehouse"></i> WMS
            </a>

            <a href="{{ url('/') }}" class="home-link">
                <i class="fa-solid fa-arrow-left me-2"></i> Back to Home
            </a>

        </div>
    </nav>

    <!-- Login Section -->
    <section class="login-section">
        <div class="login-card">

            <div class="login-icon">
                <i class="fa-solid fa-user-shield"></i>
            </div>

            <h1 class="login-title">Welcome Back!</h1>

            <p class="login-subtitle">
                Sign in to access your Warehouse Management System.
            </p>

            <!-- Login Form -->
            <form action="{{ route('login.submit') }}" method="POST">
                @csrf

                <!-- Email -->
                <label for="email" class="form-label">Email Address</label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-envelope"></i>
                    </span>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control @error('email') is-invalid @enderror"
                        placeholder="Enter your email address"
                        value="{{ old('email') }}"
                        autocomplete="username"
                        required
                    >
                </div>

                @error('email')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>
                @enderror

                <!-- Password -->
                <label for="password" class="form-label">Password</label>

                <div class="input-group">
                    <span class="input-group-text">
                        <i class="fa-solid fa-lock"></i>
                    </span>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control password-input @error('password') is-invalid @enderror"
                        placeholder="Enter your password"
                        autocomplete="current-password"
                        required
                    >

                    <button
                        type="button"
                        class="password-toggle"
                        onclick="togglePassword()"
                        aria-label="Show or hide password"
                    >
                        <i class="fa-solid fa-eye" id="eyeIcon"></i>
                    </button>
                </div>

                @error('password')
                    <div class="error-message">
                        <i class="fa-solid fa-circle-exclamation"></i>
                        {{ $message }}
                    </div>
                @enderror

                <!-- Login Button -->
                <button type="submit" class="login-btn">
                    Sign In <i class="fa-solid fa-arrow-right"></i>
                </button>

            </form>

            <div class="security-note">
                <i class="fa-solid fa-shield-halved"></i>
                Secure login for authorized users
            </div>

        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        &copy; {{ date('Y') }} WMS - Warehouse Management System.
        All rights reserved.
    </footer>

    <!-- Password Toggle -->
    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>

</body>
</html>
