<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Forgot Password - WMS</title>

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

        .page {
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            padding: 25px;

            background: linear-gradient(
                135deg,
                #eef3f8,
                #dbeafe
            );
        }

        .card {
            width: 100%;
            max-width: 950px;

            min-height: 595px;

            background: white;

            border-radius: 22px;

            overflow: hidden;

            display: flex;

            box-shadow:
                0 20px 50px rgba(0, 0, 0, 0.12);
        }


        /* =========================
           LEFT SIDE
        ========================== */

        .left-section {

            width: 50%;

            padding: 68px 55px;

            color: white;

            background: linear-gradient(
                145deg,
                #172554,
                #1e40af,
                #2563eb
            );

            display: flex;
            flex-direction: column;
            justify-content: center;
        }


        /* WMS LOGO */

        .logo {

            display: flex;

            align-items: center;

            margin-bottom: 55px;
        }

        .logo-icon {

            width: 48px;
            height: 48px;

            border-radius: 12px;

            background: rgba(255,255,255,0.13);

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 24px;

            margin-right: 12px;
        }

        .logo-text h3 {

            font-size: 24px;

            letter-spacing: 0.5px;

            margin-bottom: 3px;
        }

        .logo-text span {

            font-size: 9px;

            font-weight: bold;

            letter-spacing: 2px;

            color: #b9c8ef;
        }


        /* LEFT HEADING */

        .left-section h1 {

            font-size: 40px;

            line-height: 1.15;

            margin-bottom: 25px;
        }

        .left-section h1 span {

            color: #60a5fa;
        }


        .left-description {

            max-width: 390px;

            color: #dbeafe;

            font-size: 14px;

            line-height: 1.8;

            margin-bottom: 35px;
        }


        /* FEATURES */

        .feature {

            display: flex;

            align-items: center;

            margin-bottom: 20px;
        }

        .feature-icon {

            width: 36px;
            height: 36px;

            border-radius: 10px;

            background: rgba(255,255,255,0.12);

            display: flex;

            align-items: center;
            justify-content: center;

            margin-right: 12px;

            font-size: 16px;
        }

        .feature span {

            font-size: 14px;

            color: #e0e7ff;
        }


        /* =========================
           RIGHT SIDE
        ========================== */

        .right-section {

            width: 50%;

            padding: 55px;

            display: flex;

            flex-direction: column;

            justify-content: center;
        }


        /* EMAIL ICON */

        .icon {

            width: 65px;
            height: 65px;

            background: #eff6ff;

            border-radius: 50%;

            display: flex;

            align-items: center;
            justify-content: center;

            font-size: 28px;

            margin-bottom: 20px;
        }


        /* SMALL HEADING */

        .small-heading {

            color: #2563eb;

            font-size: 12px;

            font-weight: bold;

            text-transform: uppercase;

            letter-spacing: 1.5px;

            margin-bottom: 8px;
        }


        /* TITLE */

        h2 {

            font-size: 30px;

            color: #0f172a;

            margin-bottom: 10px;
        }


        /* SUBTITLE */

        .subtitle {

            color: #64748b;

            font-size: 14px;

            line-height: 1.6;

            margin-bottom: 28px;

            max-width: 380px;
        }


        /* FORM */

        .form-group {

            margin-bottom: 20px;
        }

        label {

            display: block;

            font-size: 13px;

            font-weight: bold;

            color: #334155;

            margin-bottom: 8px;
        }


        /* INPUT */

        .input-wrapper {

            position: relative;
        }

        .input-icon {

            position: absolute;

            left: 15px;

            top: 50%;

            transform: translateY(-50%);

            color: #94a3b8;

            font-size: 16px;
        }

        input {

            width: 100%;

            height: 52px;

            border: 1px solid #dbe2ea;

            border-radius: 10px;

            padding: 0 15px 0 43px;

            font-size: 14px;

            outline: none;

            transition: 0.2s;
        }

        input:focus {

            border-color: #2563eb;

            box-shadow:
                0 0 0 4px rgba(37,99,235,0.08);
        }


        /* BUTTON */

        .button {

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
                0 10px 22px rgba(37,99,235,0.22);

            transition: 0.2s;
        }

        .button:hover {

            transform: translateY(-1px);

            box-shadow:
                0 14px 28px rgba(37,99,235,0.28);
        }


        /* BACK LINK */

        .back {

            display: block;

            text-align: center;

            margin-top: 20px;

            color: #2563eb;

            text-decoration: none;

            font-size: 14px;

            font-weight: bold;
        }

        .back:hover {

            text-decoration: underline;
        }


        /* SECURITY TEXT */

        .security {

            text-align: center;

            color: #94a3b8;

            font-size: 12px;

            margin-top: 28px;
        }


        /* COPYRIGHT */

        .copyright {

            text-align: center;

            color: #94a3b8;

            font-size: 11px;

            margin-top: 20px;
        }


        /* ERROR */

        .error {

            color: #dc2626;

            font-size: 12px;

            margin-top: 5px;
        }


        /* =========================
           RESPONSIVE
        ========================== */

        @media (max-width: 800px) {

            .card {

                flex-direction: column;

                max-width: 500px;
            }

            .left-section,
            .right-section {

                width: 100%;
            }

            .left-section {

                padding: 40px;
            }

            .right-section {

                padding: 40px;
            }

            .left-section h1 {

                font-size: 32px;
            }
        }

        @media (max-width: 500px) {

            .page {

                padding: 15px;
            }

            .left-section,
            .right-section {

                padding: 30px 25px;
            }

            .logo {

                margin-bottom: 35px;
            }

            .left-section h1 {

                font-size: 28px;
            }

            h2 {

                font-size: 26px;
            }
        }

    </style>

</head>


<body>

<div class="page">

    <div class="card">


        <!-- =========================
             LEFT SECTION
        ========================== -->

        <div class="left-section">

            <div class="logo">

                <div class="logo-icon">
                    📦
                </div>

                <div class="logo-text">

                    <h3>WMS</h3>

                    <span>WAREHOUSE MANAGEMENT</span>

                </div>

            </div>


            <h1>
                Recover your
                <br>
                <span>staff access.</span>
            </h1>


            <p class="left-description">

                Enter your registered staff email address
                and we'll help you securely reset your WMS
                account password.

            </p>


            <div class="feature">

                <div class="feature-icon">
                    🔐
                </div>

                <span>
                    Secure password recovery
                </span>

            </div>


            <div class="feature">

                <div class="feature-icon">
                    ✉️
                </div>

                <span>
                    Reset link sent to your email
                </span>

            </div>


            <div class="feature">

                <div class="feature-icon">
                    🛡️
                </div>

                <span>
                    Protected staff access
                </span>

            </div>

        </div>


        <!-- =========================
             RIGHT SECTION
        ========================== -->

        <div class="right-section">


            <div class="icon">
                ✉️
            </div>


            <div class="small-heading">
                WMS STAFF PORTAL
            </div>


            <h2>
                Forgot Password?
            </h2>


            <p class="subtitle">

                No worries. Enter your staff email
                address and we'll send you a password
                reset link.

            </p>


            <form method="POST" action="#">

                @csrf


                <div class="form-group">

                    <label for="email">
                        Staff Email Address
                    </label>


                    <div class="input-wrapper">

                        <span class="input-icon">
                            ✉
                        </span>

                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="staff@example.com"
                            value="{{ old('email') }}"
                            required
                        >

                    </div>


                    @error('email')

                        <div class="error">
                            {{ $message }}
                        </div>

                    @enderror

                </div>


                <button
                    type="submit"
                    class="button"
                >
                    ✉ &nbsp; Send Password Reset Link
                </button>


            </form>


            <a
                href="{{ route('staff.login') }}"
                class="back"
            >
                ← Back to Staff Login
            </a>


            <div class="security">
                🔒 &nbsp; Your account security is our priority.
            </div>


            <div class="copyright">
                © {{ date('Y') }} WMS · Warehouse Management System
            </div>


        </div>

    </div>

</div>

</body>

</html>