<!DOCTYPE html>
<html>

<head>
    <title>Tu Certificado</title>
</head>

<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px;">
        <h2>Hola, {{ $recipient->name }}</h2>

        <p>Nos complace informarte que tu certificado ya está disponible.</p>

        <p>Puedes descargarlo haciendo clic en el siguiente botón:</p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $url }}" style="background-color: #4F46E5; color: white; padding: 12px 24px; text-decoration: none; border-radius: 4px; font-weight: bold;">
                Descargar Certificado
            </a>
        </div>

        <p>Si el botón no funciona, copia y pega el siguiente enlace en tu navegador:</p>
        <p style="color: #666; font-size: 12px;">{{ $url }}</p>

        <p>Gracias,<br>
            El equipo de Ninari</p>
    </div>
</body>

</html>