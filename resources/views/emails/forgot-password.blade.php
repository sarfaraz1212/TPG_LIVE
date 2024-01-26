<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Email Verification</title>
</head>
<body style="background-color: #f8f9fa; font-family: Arial, sans-serif;">

    <div style="margin-top: 50px; border-radius: 10px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); background-color: #fff;" align="center">
        <div style="background-color: #007bff; color: #fff; border-top-left-radius: 10px; border-top-right-radius: 10px; text-align: center;">
            <h3 style="margin: 0; padding: 20px;">Email Verification</h3>
        </div>
        <div style="padding: 20px;">
            <p style="font-size: 16px; line-height: 1.8;">Dear Trainer,</p>
            <p style="font-size: 16px; line-height: 1.8;">Please Click the link below to reset your password</p>
            <a href="{{ route('view.reset-password',['token' => $token]) }}" style="display: block; border-color: #007bff; color: black; text-decoration: none; padding: 12px 20px; font-size: 18px; font-weight: bold; letter-spacing: 1px; text-align: center; margin-bottom: 20px; transition: background-color 0.3s ease;">Reset Password</a>
            <p style="font-size: 16px; line-height: 1.8;">The link above is valid for only 60 minutes</p>
            <div style="text-align: right; font-style: italic; font-size: 14px; margin-top: 20px;">
                <p>Best regards,</p>
                <p>The physique gym</p>
            </div>
        </div>
    </div>

</body>
</html>
