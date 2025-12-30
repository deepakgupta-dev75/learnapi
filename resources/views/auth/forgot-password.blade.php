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
        <h3 class="text-center mb-4">Forgot Password</h3>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="form-group mb-3">
                <label>Email Address</label>
                <input type="email" class="form-control" name="email" placeholder="Enter your registered email" required>
            </div>
            <button class="btn btn-primary w-100 mb-3" type="submit">Send Reset Link</button>
        </form>

        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">
                Back to Login
            </a>
        </div>
    </div>
</body>

</html>