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
      <h3 class="text-center mb-4">Login</h3>
      <form method="POST" action="#">
        <div class="form-group mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email" placeholder="Enter your email" required>
        </div>
        <div class="form-group mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>
        <div class="d-flex justify-content-between align-items-center mb-3">
        
            <div class="form-group form-check mb-0">
                <input type="checkbox" class="form-check-input" id="rememberMe">
                <label class="form-check-label" for="rememberMe">Remember Me</label>
            </div>

            <div class="my-2 text-right">
                <a href="{{ route('forgotPassword')}}">Forgot password?</a>
            </div>
        </div>
        <button class="btn btn-primary w-100">Login</button>
      </form>
        <div class="mt-2 text-center">
            Don't have an account? <a href="{{ route('register')}}">Register Here</a>
        </div>
    </div>
</body>
</html>