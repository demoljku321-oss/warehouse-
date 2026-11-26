@extends('admindashboard.layout')

@section('title', 'Edit Staff')

@section('content')

<div class="staff-page">

    {{-- Page Header --}}
    <div class="staff-page-header">
        <div>
            <h1 class="page-title">Edit Staff</h1>
            <p class="page-subtitle">
                Update staff information and account details.
            </p>
        </div>

        <a href="{{ route('admin.staff') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i>
            Back to Staff
        </a>
    </div>

    {{-- Form Card --}}
    <div class="staff-form-card">

        <div class="form-card-header">
            <div class="header-icon">
                <i class="bi bi-person-gear"></i>
            </div>
            <div>
                <h5>Staff Information</h5>
                <p>Update the details below</p>
            </div>
        </div>

        <div class="form-card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.staff.update', $staff->id) }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Profile Image --}}
                <div class="current-profile">
                    @if ($staff->image)
                        <img
                            src="{{ asset('storage/' . $staff->image) }}"
                            alt="Staff Image"
                            class="profile-image"
                        >
                    @else
                        <div class="profile-placeholder">
                            <i class="bi bi-person"></i>
                        </div>
                    @endif

                    <div class="profile-details">
                        <h6>{{ $staff->name }}</h6>
                        <p>{{ $staff->email }}</p>
                        <span class="staff-status">
                            <i class="bi bi-circle-fill"></i>
                            Staff Account
                        </span>
                    </div>
                </div>

                {{-- Personal Details --}}
                <div class="form-section">
                    <div class="section-heading">
                        <i class="bi bi-person"></i>
                        <h6>Personal Details</h6>
                    </div>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="name" class="form-label">
                                Full Name <span>*</span>
                            </label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                class="form-control"
                                placeholder="Enter full name"
                                value="{{ old('name', $staff->name) }}"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="email" class="form-label">
                                Email Address <span>*</span>
                            </label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                class="form-control"
                                placeholder="Enter email address"
                                value="{{ old('email', $staff->email) }}"
                                required
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="phone" class="form-label">
                                Phone Number
                            </label>
                            <input
                                id="phone"
                                name="phone"
                                type="tel"
                                class="form-control"
                                placeholder="Enter phone number"
                                value="{{ old('phone', $staff->phone) }}"
                            >
                        </div>

                    </div>
                </div>

                {{-- Password --}}
                <div class="form-section">
                    <div class="section-heading">
                        <i class="bi bi-shield-lock"></i>
                        <h6>Password Settings</h6>
                    </div>

                    <p class="section-description">
                        Leave the password fields blank to keep the current password.
                    </p>

                    <div class="row g-3">

                        <div class="col-md-6">
                            <label for="password" class="form-label">
                                New Password
                            </label>
                            <input
                                id="password"
                                name="password"
                                type="password"
                                class="form-control"
                                minlength="8"
                                autocomplete="new-password"
                                placeholder="Enter new password"
                            >
                        </div>

                        <div class="col-md-6">
                            <label for="password_confirmation"
                                   class="form-label">
                                Confirm New Password
                            </label>
                            <input
                                id="password_confirmation"
                                name="password_confirmation"
                                type="password"
                                class="form-control"
                                minlength="8"
                                autocomplete="new-password"
                                placeholder="Confirm new password"
                            >
                        </div>

                    </div>
                </div>

                {{-- Profile Image Upload --}}
                <div class="form-section">
                    <div class="section-heading">
                        <i class="bi bi-image"></i>
                        <h6>Profile Image</h6>
                    </div>

                    <div class="image-upload-area">
                        <div class="upload-icon">
                            <i class="bi bi-cloud-arrow-up"></i>
                        </div>

                        <div class="upload-content">
                            <label for="image" class="form-label">
                                Change Profile Image
                            </label>
                            <p>Choose a new image if you want to update the current photo.</p>

                            <input
                                id="image"
                                name="image"
                                type="file"
                                class="form-control"
                                accept=".jpg,.jpeg,.png,.webp"
                            >

                            <small>Supported formats: JPG, JPEG, PNG, WEBP</small>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="form-actions">
                    <a href="{{ route('admin.staff') }}"
                       class="cancel-btn">
                        Cancel
                    </a>

                    <button type="submit" class="update-btn">
                        <i class="bi bi-check2-circle"></i>
                        Update Staff
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

{{-- Page UI Styles --}}
<style>
    .staff-page {
        max-width: 1050px;
        margin: 0 auto;
        padding: 24px 20px;
        color: #1f2937;
    }

    .staff-page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 16px;
        margin-bottom: 26px;
    }

    .page-title {
        font-size: 27px;
        font-weight: 700;
        margin: 0 0 7px;
        color: #111827;
    }

    .page-subtitle {
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 10px 15px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        color: #374151;
        background: #fff;
        text-decoration: none;
        font-size: 14px;
        white-space: nowrap;
    }

    .back-btn:hover {
        background: #f9fafb;
        color: #111827;
    }

    .staff-form-card {
        background: #fff;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.04);
        overflow: hidden;
    }

    .form-card-header {
        display: flex;
        align-items: center;
        gap: 13px;
        padding: 22px 28px;
        border-bottom: 1px solid #e5e7eb;
        background: #fff;
    }

    .header-icon {
        width: 44px;
        height: 44px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 22px;
    }

    .form-card-header h5 {
        font-size: 16px;
        font-weight: 700;
        margin: 0 0 4px;
    }

    .form-card-header p {
        font-size: 13px;
        color: #6b7280;
        margin: 0;
    }

    .form-card-body {
        padding: 28px;
    }

    .current-profile {
        display: flex;
        align-items: center;
        gap: 18px;
        padding-bottom: 25px;
        margin-bottom: 26px;
        border-bottom: 1px solid #e5e7eb;
    }

    .profile-image,
    .profile-placeholder {
        width: 82px;
        height: 82px;
        border-radius: 50%;
        flex-shrink: 0;
        border: 3px solid #f3f4f6;
    }

    .profile-image {
        object-fit: cover;
    }

    .profile-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        color: #6b7280;
        font-size: 36px;
    }

    .profile-details h6 {
        font-size: 17px;
        font-weight: 700;
        margin: 0 0 5px;
    }

    .profile-details p {
        color: #6b7280;
        font-size: 13px;
        margin: 0 0 8px;
        overflow-wrap: anywhere;
    }

    .staff-status {
        color: #15803d;
        font-size: 12px;
        font-weight: 600;
    }

    .staff-status i {
        font-size: 8px;
        margin-right: 4px;
    }

    .form-section {
        margin-bottom: 28px;
        padding-bottom: 27px;
        border-bottom: 1px solid #e5e7eb;
    }

    .section-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 19px;
    }

    .section-heading i {
        color: #2563eb;
        font-size: 18px;
    }

    .section-heading h6 {
        font-size: 15px;
        font-weight: 700;
        margin: 0;
    }

    .section-description {
        font-size: 13px;
        color: #6b7280;
        margin: -8px 0 18px;
    }

    .staff-page .form-label {
        display: block;
        font-size: 13px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .staff-page .form-label span {
        color: #dc2626;
    }

    .staff-page .form-control {
        min-height: 44px;
        border: 1px solid #d1d5db;
        border-radius: 7px;
        font-size: 14px;
        padding: 10px 12px;
        box-shadow: none;
    }

    .staff-page .form-control:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.10);
    }

    .image-upload-area {
        display: flex;
        align-items: flex-start;
        gap: 16px;
        padding: 20px;
        border: 1px dashed #cbd5e1;
        border-radius: 9px;
        background: #f9fafb;
    }

    .upload-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 45px;
        height: 45px;
        flex-shrink: 0;
        border-radius: 8px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 23px;
    }

    .upload-content {
        flex: 1;
        min-width: 0;
    }

    .upload-content p {
        color: #6b7280;
        font-size: 13px;
        margin: -2px 0 12px;
    }

    .upload-content small {
        display: block;
        color: #6b7280;
        font-size: 12px;
        margin-top: 8px;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
        padding-top: 2px;
    }

    .cancel-btn,
    .update-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 10px 19px;
        border-radius: 7px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
    }

    .cancel-btn {
        color: #374151;
        background: #fff;
        border: 1px solid #d1d5db;
    }

    .cancel-btn:hover {
        background: #f9fafb;
        color: #111827;
    }

    .update-btn {
        color: #fff;
        background: #2563eb;
        border: 1px solid #2563eb;
    }

    .update-btn:hover {
        background: #1d4ed8;
        border-color: #1d4ed8;
    }

    @media (max-width: 576px) {
        .staff-page {
            padding: 18px 10px;
        }

        .staff-page-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .form-card-header,
        .form-card-body {
            padding: 19px;
        }

        .current-profile {
            gap: 13px;
        }

        .profile-image,
        .profile-placeholder {
            width: 68px;
            height: 68px;
        }

        .image-upload-area {
            padding: 14px;
            gap: 12px;
        }

        .form-actions {
            flex-direction: column-reverse;
        }

        .cancel-btn,
        .update-btn {
            width: 100%;
        }
    }
</style>

@endsection
