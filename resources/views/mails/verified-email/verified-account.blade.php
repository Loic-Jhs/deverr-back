<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Deverr</title>
    <link rel="stylesheet" href="{{ url('/css/verified-account.css') }}">
</head>
<body>
    <div id="content">
        <img id="logo" src="{{ url('/images/deverr.jpg') }}" alt="Logo Deverr">
        <h1>Votre email a été vérifié avec succès !</h1>
        <h2> Nous sommes heureux de vous accueillir sur notre plateforme. <br> Deverr </h2>
        <button id="button" class="btn">
            <a href="{{ config('app.front_url') . '/login' }}">
                Se connecter
            </a>
        </button>
    </div>
</body>
</html>




