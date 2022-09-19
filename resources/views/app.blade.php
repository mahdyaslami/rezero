<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link href="/fonts/montserrat/style.css" rel="stylesheet" type="text/css">
        <link href="/fonts/vazirmatn/style.css" rel="stylesheet" type="text/css">
        <link href="/fonts/google-font-icon/style.css" rel="stylesheet" type="text/css">

        <!-- Scripts -->
        @routes
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="font-app antialiased" dir="rtl">
        @inertia
    </body>
</html>
