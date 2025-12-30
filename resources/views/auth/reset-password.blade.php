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
    <h3 class="text-center mb-4">Reset Password</h3>
    <form method="POST" action="#">
        <div class="form-group mb-3">
            <label>New Password</label>
            <input type="password" class="form-control" name="password" placeholder="Enter new password" required>
        </div>
        <div class="form-group mb-3">
            <label>Confirm Password</label>
            <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm new password" required>
        </div>
        <button class="btn btn-warning">Reset Password</button>
    </form>
    </div>
</body>
</html>