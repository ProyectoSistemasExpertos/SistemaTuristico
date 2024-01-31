<!-- resources/views/emails/reset-password.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer contraseña</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<div class="container">
        <h2>Restablecer contraseña</h2>
        <p>Haz click en el siguiente enlace para restablecer tu contraseña:</p>
        <a href="{{ $resetToken }}">Restablecer contraseña</a>
    </div>
</body>
</html>
