@extends('admindashboard.layout')

@section('title', 'Add Staff')

@section('content')

<style>
    .staff-page {
        padding: 20px;
    }

    .page-title {
        font-size: 28px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .page-subtitle {
        color: #64748b;
        margin-bottom: 25px;
        font-size: 14px;
    }

    .staff-form-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 30px;
        max-width: 850px;
        box-shadow: 0 4px 20px rgba(15, 23, 42, 0.06);
        border: 1px solid #e2e8f0;
    }

    .form-section-title {
        font-size: 18px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 6px;
    }

    .form-section-subtitle {
        font-size: 13px;
        color: #64748b;
        margin-bottom: 25px;
    }

    .staff-form-card label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        color: #334155;
        margin-bottom: 8px;
    }

    .staff-form-card .form-control {
        min-height: 46px;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 10px 13px;
        font-size: 14px;
        box-shadow: none;
    }

    .staff-form-card .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .staff-form-card input[type="file"] {
        padding: 9px;
        background: #f8fafc;
    }

    .form-help {
        font-size: 12px;
        color: #64748b;
        margin-top: 7px;
    }

    .form-actions {
        display: flex;
        gap: 12px;
        margin-top: 28px;
        padding-top: 22px;
        border-top: 1px solid #e2e8f0;
    }

    .btn-save {
        background: #2563eb;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 11px 22px;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-save:hover {
        background: #1d4ed8;
        color: #ffffff;
    }

    .btn-back {
        background: #f1f5f9;
        color: #334155;
        border: 1px solid #cbd5e1;
        border-radius: 8px;
        padding: 11px 22px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
    }

    .btn-back:hover {
        background: #e2e8f0;
        color: #1e293b;
    }

    @media (max-width: 576px) {
        .staff-page {
            padding: 12px;
        }

        .staff-form-card {
            padding: 20px;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="staff-page">

    <h1 class="page-title">Add Staff</h1>
    <p class="page-subtitle">
        Enter staff details to add a new staff member.
    </p>

    <div class="staff-form-card">

        <h3 class="form-section-title">Staff Information</h3>
        <p class="form-section-subtitle">
            Fill in the details below.
        </p>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.staff.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="row">

                <div class="col-md-6 mb-4">
                    <label for="name">Full Name *</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="form-control"
                        placeholder="Enter staff name"
                        value="{{ old('name') }}"
                        required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="email">Email Address *</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="staff@example.com"
                        value="{{ old('email') }}"
                        required>
                </div>

                
                <div class="col-md-6 mb-4">
                    <label for="password">Password *</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Enter password"
                        required>
                </div>

                <div class="col-md-6 mb-4">
                    <label for="password_confirmation">Confirm Password *</label>
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Confirm your password"
                        required>
                </div>
                

                <div class="col-md-6 mb-4">
                    <label for="phone">Phone Number</label>
                    <input
                        type="tel"
                        id="phone"
                        name="phone"
                        class="form-control"
                        placeholder="Enter phone number"
                        value="{{ old('phone') }}">
                </div>

                <div class="col-12 mb-3">
                    <label for="image">Staff Profile Image</label>
                    <input
                        type="file"
                        id="image"
                        name="image"
                        class="form-control"
                        accept="image/*">
                    <p class="form-help">
                        Select an image for the staff profile. This field is optional.
                    </p>
                </div>

            </div>

            <div class="form-actions">
                <button type="submit" class="btn btn-save">
                    Save Staff
                </button>

                <a href="{{ route('admin.staff') }}" class="btn btn-back">
                    Back to Staff
                </a>
            </div>

        </form>

    </div>

</div>

@endsection
