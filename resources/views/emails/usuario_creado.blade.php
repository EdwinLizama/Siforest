<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuario Creado</title>
</head>
<body>
    <h1>¡Bienvenido a SIFOREST!</h1>
    <p>Hola {{ $usuario->name }} {{ $usuario->apellido }},</p>
    <p>Tu cuenta ha sido creada exitosamente.</p>
    <p>A continuación, tus credenciales de acceso:</p>
    <ul>
        <li><strong>Usuario:</strong> {{ $usuario->usuario }}</li>
        <li><strong>Correo Electrónico:</strong> {{ $usuario->email }}</li>
        <li><strong>Contraseña Temporal:</strong> {{ $passwordTemporal }}</li>
    </ul>
    <p>Te recomendamos que cambies tu contraseña una vez inicies sesión.</p>
    <p>Gracias por unirte a nosotros.</p>
</body>
</html>
