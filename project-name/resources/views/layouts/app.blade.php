<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Webshop API')</title>
    <style>
        body {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        @yield('content') {{-- Ovdje će se ubaciti sadržaj pojedinog view-a koji proširuje ovaj layout --}}
    </div>

</body>
</html>
