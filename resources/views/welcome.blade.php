<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verify</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
        <form action="{{ url('/sends') }}" method="GET">
            <div>
                <label for="">recibir numnero:</label>
                <input type="text" name="phone">
            </div>
            <div>
                <input type="submit" value="Send Sms">
            </div>
        </form>
</body>
</html>