<!DOCTYPE html>
<html>
<head>
    <title>Verificación de Número Teléfonico</title>
</head>
<body>
    <h1>Verificación de Número Teléfonico para laravels</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    @if (session('error'))
        <div>{{ session('error') }}</div>
    @endif

    <form method="POST" action="{{ route('send-verification-code') }}">
        @csrf
        <label for="phone">Número de Teléfono:</label>
        <input type="tel" name="phone" required>
        <button type="submit">Enviar Código de Verificación</button>
    </form>

    <form method="POST" action="{{ route('verify-code') }}">
        @csrf
        <label for="phone">Número de Teléfono:</label>
        <input type="tel" name="phone" required>
        <label for="code">Código de Verificación:</label>
        <input type="text" name="code" required>
        <button type="submit">Verificar Código</button>
    </form>
</body>
</html>