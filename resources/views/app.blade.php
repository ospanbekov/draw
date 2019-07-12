<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>DRAW</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <style charset="utf-8">
        html,
        body {
            margin: 0px;
            padding: 0px;
        }

        body {
            font-size: 90%;
            font-weight: 400;
        }

        * {
            box-sizing: border-box;
        }
    </style>
</head>
<body>
    <div id="App">
        <login-component ref="LoginComponent" v-if="!isLoggedIn"></login-component>
        <draw-component ref="DrawComponent" v-if="isLoggedIn"></draw-component>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
