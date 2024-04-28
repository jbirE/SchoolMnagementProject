<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Application</title>

    <style>
        body {
            margin: 0;
            font-family: 'your-preferred-font', sans-serif; /* Remplacez 'your-preferred-font' par la police que vous préférez */
            background: url('https://res.cloudinary.com/dtjj1rxjq/image/upload/v1701987025/oyhnjmhs34kwf7gjdwaw.webp') no-repeat center center fixed;
            background-size: cover;
        }

      
    </style>
</head>
<body>
    <div id="app"></div>
    @vite('resources/js/app.js')
</body>
</html>
