<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Recipe App')</title>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        /* priekš pilnekrāna */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            overflow-x: hidden; /* Atspējo horizontālo scrollošanu */
        }

        .full-height {
            height: 100%;
        }

        /* Pielāgo citus īpašos stilus pēc vajadzības */
    </style>
</head>
<body class="">
    <header>

    </header>

    <nav>

    </nav>

    <main class="">
        @yield('content')
    </main>

    <footer>

    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
