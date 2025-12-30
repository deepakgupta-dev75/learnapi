@extends('layouts.app')

@section('title', 'Change Password')

@section('content')
<div class="container mt-5" style="max-width: 400px;">
    <h3 class="text-center mb-4">Change Password</h3>
    <form method="POST" action="#">
        <div class="form-group mb-3">
            <label>Old Password</label>
            <input type="password" class="form-control" name="oldpassword" placeholder="Enter old password" required>
        </div>
        <div class="form-group mb-3">
            <label>New Password</label>
            <input type="password" class="form-control" name="newpassword" placeholder="Enter new password" required>
        </div>
        <div class="form-group mb-3">
            <label>Confirm New Password</label>
            <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm new password" required>
        </div>
        <button class="btn btn-success">Update Password</button>
    </form>
</div>
@endsection