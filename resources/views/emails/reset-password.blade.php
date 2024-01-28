<!-- resources/views/emails/reset-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
</head>
<body>
    <h2>Reset Password</h2>
    <p>Click the following link to reset your password:</p>
    <a href="{{ url('/reset-password', $resetToken) }}">Reset Password</a>
</body>
</html>
