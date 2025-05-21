<!-- resources/views/emails/notificacion_usuario.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Notificación de Usuario</title>
</head>
<body>
    <h1>Hola, {{ $nombre }}! 👋</h1>
    <p>
        Este es un mensaje de notificación para el correo <strong>{{ $email }}</strong>.
    </p>
    <p>
        ¡Gracias por formar parte de nuestra plataforma!
    </p>
</body>
</html>
