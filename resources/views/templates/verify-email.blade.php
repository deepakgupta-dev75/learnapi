<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Email Verification</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f7; padding: 0; margin: 0;">
    <div style="max-width: 600px; margin: auto; background: #ffffff; padding: 30px; border-radius: 8px;">
        
        <h3 style="text-align: center; color: #333;">Verify Your Email</h2>
        <h4>Hello {{ $user->name }},</h2>
        <p style="font-size: 12px; color: #555;">
            Thank you for creating an account. Please verify your email address by clicking the button below:
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $verifyUrl }}"
                style="background: #28a745; color: #ffffff; padding: 12px 20px; text-decoration: none;
                       font-size: 16px; border-radius: 5px; display: inline-block;">
                Verify Email
            </a>
        </div>

        <p style="font-size: 12px; color: #555;">
            If you didn’t create an account, you can safely delete this email.
        </p>

        <hr style="margin: 30px 0;">

        <p style="text-align: center; font-size: 13px; color: #999;">
            &copy; <?php echo date('Y') ?> OBS. All rights reserved.
        </p>
    </div>
</body>
</html>
