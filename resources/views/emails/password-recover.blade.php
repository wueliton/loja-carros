<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Recuperação de Senha</title>
</head>

<body>
    <p>Olá!</p>
    <p>Você solicitou a recuperação da senha de sua conta, para dar seguimento no processo de recuperação acesse o link abaixo:</p>
    <a href="{{ env('APP_BASE') }}/password-recover/{{ $mailData['code'] }}"></a>.
</body>

</html>
