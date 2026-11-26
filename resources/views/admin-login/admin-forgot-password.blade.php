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

    .forgot-page {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 25px;
        background: linear-gradient(135deg, #eef3f8, #dbeafe);
    }

    .forgot-container {
        width: 100%;
        max-width: 950px;
        min-height: 540px;
        display: grid;
        grid-template-columns: 1fr 1fr;
        background: white;
        border-radius: 22px;
        overflow: hidden;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
    }

    /* LEFT SIDE */

    .left-section {
        background: linear-gradient(145deg, #0f172a, #1d4ed8);
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
        background: rgba(255,255,255,0.12);
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
        font-size: 38px;
        line-height: 1.2;
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

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .info-item {
        display: flex;
        align-items: center;
        gap: 12px;
        color: #e2e8f0;
        font-size: 14px;
    }

    .info-icon {
        width: 34px;
        height: 34px;
        border-radius: 9px;
        background: rgba(255,255,255,0.1);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* RIGHT SIDE */

    .right-section {
        padding: 55px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .forgot-form {
        width: 100%;
        max-width: 360px;
    }

    .icon-circle {
        width: 65px;
        height: 65px;
        border-radius: 50%;
        background: #eff6ff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 28px;
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

    .forgot-form h2 {
        font-size: 30px;
        color: #0f172a;
        margin-bottom: 10px;
    }

    .subtitle {
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
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

    input[type="email"] {
        width: 100%;
        height: 50px;
        border: 1px solid #dbe2ea;
        border-radius: 10px;
        padding: 0 15px 0 43px;
        font-size: 14px;
        outline: none;
    }

    input[type="email"]:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 4px rgba(37,99,235,0.08);
    }

    .reset-button {
        width: 100%;
        height: 52px;
        border: none;
        border-radius: 10px;
        background: linear-gradient(135deg, #2563eb, #1d4ed8);
        color: white;
        font-size: 15px;
        font-weight: bold;
        cursor: pointer;
        box-shadow: 0 8px 20px rgba(37,99,235,0.25);
    }

    .reset-button:hover {
        opacity: 0.9;
    }

    .back-login {
        display: block;
        text-align: center;
        margin-top: 22px;
        color: #2563eb;
        text-decoration: none;
        font-size: 13px;
        font-weight: bold;
    }

    .back-login:hover {
        text-decoration: underline;
    }

    .security {
        text-align: center;
        color: #64748b;
        font-size: 12px;
        margin-top: 25px;
    }

    .copyright {
        text-align: center;
        color: #94a3b8;
        font-size: 11px;
        margin-top: 22px;
    }

    @media (max-width: 750px) {

        .forgot-container {
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

<div class="forgot-page">


<div class="forgot-container">

    <!-- LEFT SIDE -->

    <div class="left-section">

        <div class="logo">

            <div class="logo-box">
                📦
            </div>

            <div class="logo-text">
                WMS
                <small>WAREHOUSE MANAGEMENT</small>
            </div>

        </div>

        <h1>
            Recover your<br>
            <span>admin access.</span>
        </h1>

        <p>
            Enter your registered administrator email address
            and we'll help you securely reset your WMS account
            password.
        </p>

        <div class="info-list">

            <div class="info-item">
                <div class="info-icon">🔐</div>
                Secure password recovery
            </div>

            <div class="info-item">
                <div class="info-icon">✉️</div>
                Reset link sent to your email
            </div>

            <div class="info-item">
                <div class="info-icon">🛡️</div>
                Protected administrator access
            </div>

        </div>

    </div>


    <!-- RIGHT SIDE -->

    <div class="right-section">

        <form
            class="forgot-form"
            method="POST"
            action=""
        >

            @csrf

            <div class="icon-circle">
                ✉️
            </div>

            <div class="small-heading">
                WMS Account Recovery
            </div>

            <h2>Forgot Password?</h2>

            <p class="subtitle">
                No worries. Enter your admin email address
                and we'll send you a password reset link.
            </p>


            <!-- EMAIL -->

            <div class="form-group">

                <label for="email">
                    Admin Email Address
                </label>

                <div class="input-box">

                    <span>✉</span>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="admin@example.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    >

                </div>

                @error('email')
                    <small style="color:#dc2626;">
                        {{ $message }}
                    </small>
                @enderror

            </div>


            <!-- BUTTON -->

            <button type="submit" class="reset-button">
                ✉ Send Password Reset Link
            </button>


            <!-- BACK TO LOGIN -->

            <a href="{{ route('admin-login.admin') }}" class="back-login">
                ← Back to Admin Login
            </a>


            <div class="security">
                🛡 Your account security is our priority.
            </div>

            <div class="copyright">
                © {{ date('Y') }} WMS · Warehouse Management System
            </div>

        </form>

    </div>

</div>


</div>

</body>
</html>
