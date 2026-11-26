
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Staff Login - WMS</title>

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #eef3f8;
        }

        .login-page {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 25px;
            background: linear-gradient(
                135deg,
                #eef3f8,
                #dbeafe
            );
        }

        .login-container {
            width: 100%;
            max-width: 950px;
            min-height: 560px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            background: white;
            border-radius: 22px;
            overflow: hidden;
            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.12);
        }

        /* ================= LEFT ================= */

        .left-section {
            background: linear-gradient(
                145deg,
                #0f172a,
                #1d4ed8
            );

            color: white;
            padding: 55px;

            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 60px;
        }

        .logo-box {
            width: 48px;
            height: 48px;

            background: rgba(255, 255, 255, 0.12);
            border-radius: 12px;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 25px;
        }

        .logo-text {
            font-size: 23px;
            font-weight: bold;
        }

        .logo-text small {
            display: block;
            font-size: 9px;
            letter-spacing: 2px;
            opacity: 0.7;
            margin-top: 3px;
        }

        .left-section h1 {
            font-size: 40px;
            line-height: 1.15;
            margin-bottom: 20px;
        }

        .left-section h1 span {
            color: #93c5fd;
        }

        .left-section p {
            color: #cbd5e1;
            line-height: 1.7;
            font-size: 15px;
            margin-bottom: 30px;
        }

        .features {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .feature {
            display: flex;
            align-items: center;
            gap: 12px;

            color: #e2e8f0;
            font-size: 14px;
        }

        .feature-icon {
            width: 32px;
            height: 32px;

            border-radius: 8px;
            background: rgba(255, 255, 255, 0.1);

            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* ================= RIGHT ================= */

        .right-section {
            padding: 55px;

            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-form {
            width: 100%;
            max-width: 360px;
        }

        .staff-icon {
            width: 65px;
            height: 65px;

            border-radius: 50%;
            background: #eff6ff;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 30px;
            margin-bottom: 22px;
        }

        .small-heading {
            color: #2563eb;
            font-size: 12px;
            font-weight: bold;

            text-transform: uppercase;
            letter-spacing: 1.5px;

            margin-bottom: 8px;
        }

        .login-form h2 {
            font-size: 30px;
            color: #0f172a;
            margin-bottom: 8px;
        }

        .subtitle {
            color: #64748b;
            font-size: 14px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            font-size: 13px;
            font-weight: bold;
            color: #334155;

            margin-bottom: 8px;
        }

        .input-box {
            position: relative;
        }

        .input-box span {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            color: #94a3b8;
        }

        input[type="email"],
        input[type="password"] {
            width: 100%;
            height: 50px;

            border: 1px solid #dbe2ea;
            border-radius: 10px;

            padding: 0 15px 0 43px;

            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #2563eb;

            box-shadow:
                0 0 0 4px
                rgba(37, 99, 235, 0.08);
        }

        .options {
            display: flex;
            justify-content: space-between;
            align-items: center;

            margin-bottom: 25px;
            font-size: 13px;
        }

        .remember {
            color: #64748b;

            display: flex;
            align-items: center;

            gap: 6px;
        }

        .forgot {
            color: #2563eb;
            text-decoration: none;
            font-weight: bold;
        }

        .forgot:hover {
            text-decoration: underline;
        }

        .login-button {
            width: 100%;
            height: 52px;

            border: none;
            border-radius: 10px;

            background: linear-gradient(
                135deg,
                #2563eb,
                #1d4ed8
            );

            color: white;

            font-size: 15px;
            font-weight: bold;

            cursor: pointer;

            box-shadow:
                0 8px 20px
                rgba(37, 99, 235, 0.25);
        }

        .login-button:hover {
            opacity: 0.9;
        }

        .security {
            text-align: center;

            color: #64748b;
            font-size: 12px;

            margin-top: 20px;
        }

        .copyright {
            text-align: center;

            color: #94a3b8;
            font-size: 11px;

            margin-top: 25px;
        }

        .error {
            display: block;

            color: #dc2626;
            font-size: 12px;

            margin-top: 5px;
        }

        /* ================= RESPONSIVE ================= */

        @media (max-width: 750px) {

            .login-container {
                grid-template-columns: 1fr;
                max-width: 450px;
            }

            .left-section {
                display: none;
            }

            .right-section {
                padding: 40px 25px;
                min-height: 520px;
            }

        }

    </style>

</head>

<body>

    <div class="login-page">

        <div class="login-container">

            <!-- ================= LEFT SIDE ================= -->

            <div class="left-section">

                <div class="logo">

                    <div class="logo-box">
                        📦
                    </div>

                    <div class="logo-text">
                        Stockora

                        <small>
                            WAREHOUSE MANAGEMENT
                        </small>
                    </div>

                </div>

                <h1>
                    Work smarter<br>

                    <span>
                        inside the warehouse.
                    </span>
                </h1>

                <p>
                    Access your staff workspace to manage daily
                    warehouse operations, inventory and product
                    activities efficiently.
                </p>

                <div class="features">

                    <div class="feature">

                        <div class="feature-icon">
                            📦
                        </div>

                        Manage daily warehouse operations

                    </div>

                    <div class="feature">

                        <div class="feature-icon">
                            📋
                        </div>

                        Update inventory and stock

                    </div>

                    <div class="feature">

                        <div class="feature-icon">
                            ⚡
                        </div>

                        Fast and organized workflow

                    </div>

                </div>

            </div>


            <!-- ================= RIGHT SIDE ================= -->

            <div class="right-section">

                <form action="{{ route('staff.login.submit') }}" method="POST">

                    @csrf

                    <!-- Staff Icon -->

                    <div class="staff-icon">
                        👤
                    </div>


                    <!-- Heading -->

                    <div class="small-heading">
                        WMS Staff Portal
                    </div>

                    <h2>
                        Staff Login
                    </h2>

                    <p class="subtitle">
                        Sign in to access your staff workspace.
                    </p>


                    <!-- ================= EMAIL ================= -->

                    <div class="form-group">

                        <label for="email">
                            Staff Email
                        </label>

                        <div class="input-box">

                            <span>✉</span>

                            <input
                                type="email"
                                id="email"
                                name="email"
                                placeholder="staff@example.com"
                                value="{{ old('email') }}"
                                required
                                autofocus
                            >

                        </div>

                        @error('email')

                            <small class="error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    <!-- ================= PASSWORD ================= -->

                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <div class="input-box">

                            <span>🔑</span>

                            <input
                                type="password"
                                id="password"
                                name="password"
                                placeholder="Enter your password"
                                required
                            >

                        </div>

                        @error('password')

                            <small class="error">
                                {{ $message }}
                            </small>

                        @enderror

                    </div>


                    <!-- ================= OPTIONS ================= -->

                    <div class="options">

                        <label class="remember">

                            <input
                                type="checkbox"
                                name="remember"
                                value="1"
                            >

                            Remember me

                        </label>


                        <a
                            href="{{ route('staff.forgot-password') }}"
                            class="forgot"
                        >
                            Forgot password?
                        </a>

                    </div>


                    <!-- ================= LOGIN BUTTON ================= -->

                    <button
                        type="submit"
                        class="login-button"
                    >
                        👤 Sign In to Staff Portal
                    </button>


                    <!-- Security -->

                    <div class="security">
                        🛡 Secure Staff Access
                    </div>


                    <!-- Copyright -->

                    <div class="copyright">
                        © {{ date('Y') }}
                        WMS · Warehouse Management System
                    </div>

                </form>

            </div>

        </div>

    </div>

</body>

</html>
