<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="shadow-sm bg-white p-4 rounded" style="width: 400px;">
      <h3 class="text-center mb-4">Register</h3>
      <form method="POST" action="{{ route('register.test') }}">
        @csrf
        <div class="form-group mb-3">
          <label class="form-label">Full Name</label>
          <input type="text" class="form-control" name="fullname" placeholder="Enter name" required>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Enter email" required>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">DOB</label>
          <input type="date" class="form-control" name="dob" placeholder="Enter DOB" required>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Phone</label>
          <input type="number" class="form-control" name="phone" placeholder="Enter Phone Number" required>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Create password" required>
        </div>
        <div class="form-group mb-3">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="confirmpassword" placeholder="Re-enter password" required>
        </div>
        <div class="form-group form-check mb-3">
            <input type="checkbox" class="form-check-input" id="terms" required>
            <label class="form-check-label" for="terms">
                I agree to the Terms & Conditions
            </label>
        </div>
        <button class="btn btn-success w-100">Create Account</button>
      </form>
        <div class="mt-2 text-center">
           Have an account? <a href="{{ route('login')}}">Login Here</a>
        </div>
    </div>
</body>
</html>