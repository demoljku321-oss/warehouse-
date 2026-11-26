@extends('staffdashboard/layout')

@section('title', 'My Profile')

@section('content')

<h1 class="page-title">My Profile</h1>

<div class="card profile-card" style="padding: 25px; max-width: 850px;">

    <div style="display:flex; align-items:center; gap:20px; margin-bottom:30px; flex-wrap:wrap;">

        @if(!empty($staff->image))
            <img
                src="{{ asset('storage/' . $staff->image) }}"
                alt="Staff Profile"
                style="width:100px; height:100px; border-radius:50%; object-fit:cover; border:3px solid #0d6efd;"
            >
        @else
            <div style="width:100px; height:100px; border-radius:50%; background:#e9f2ff; color:#0d6efd; display:flex; align-items:center; justify-content:center; font-size:35px; font-weight:bold;">
                {{ strtoupper(substr($staff->name ?? 'S', 0, 1)) }}
            </div>
        @endif

        <div>
            <h2 style="margin:0 0 8px;">{{ $staff->name }}</h2>
            <span class="badge badge-success">Staff Account</span>
            <p style="margin:8px 0 0; color:#6c757d;">
                Your account information
            </p>
        </div>

    </div>

    <hr>

    <div class="profile-row" style="display:flex; padding:15px 0; border-bottom:1px solid #eee; gap:20px;">
        <div class="profile-label" style="width:160px; font-weight:600;">Full Name</div>
        <div class="profile-value">{{ $staff->name }}</div>
    </div>

    <div class="profile-row" style="display:flex; padding:15px 0; border-bottom:1px solid #eee; gap:20px;">
        <div class="profile-label" style="width:160px; font-weight:600;">Email Address</div>
        <div class="profile-value">{{ $staff->email }}</div>
    </div>

    <div class="profile-row" style="display:flex; padding:15px 0; border-bottom:1px solid #eee; gap:20px;">
        <div class="profile-label" style="width:160px; font-weight:600;">Phone Number</div>
        <div class="profile-value">{{ $staff->phone ?: 'Not provided' }}</div>
    </div>

    <div class="profile-row" style="display:flex; padding:15px 0; border-bottom:1px solid #eee; gap:20px;">
        <div class="profile-label" style="width:160px; font-weight:600;">Role</div>
        <div class="profile-value">
            <span class="badge badge-success">Staff</span>
        </div>
    </div>

    <div class="profile-row" style="display:flex; padding:15px 0; gap:20px;">
        <div class="profile-label" style="width:160px; font-weight:600;">Account Status</div>
        <div class="profile-value">
            <span class="badge badge-success">Active</span>
        </div>
    </div>

</div>

@endsection
