<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Password Reset</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f4f4f7; padding: 0; margin: 0;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 8px;">

        <h2 style="text-align: center; color: #333;">Reset Your Password</h2>
        <p style="font-size: 16px; color: #555;">
            Hello, {{ $user['name'] }}
            <br><br>
            We received a request to reset your password. Click the button below to create a new password:
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $resetUrl }}"
                style="background: #007bff; color: #ffffff; padding: 12px 20px; text-decoration: none;
                       font-size: 16px; border-radius: 5px; display: inline-block;">
                Reset Password
            </a>
        </div>

        <p style="font-size: 14px; color: #555;">
            If you did not request a password reset, please ignore this email.
        </p>

        <p style="font-size: 14px; color: #555;">
            This password reset link will expire in <strong>60 minutes</strong>.
        </p>

        <hr style="margin: 30px 0;">

        <p style="text-align: center; font-size: 14px; color: #999;">
            © <?php echo date('Y') ?> OBS. All rights reserved.
        </p>
    </div>
</body>

</html>