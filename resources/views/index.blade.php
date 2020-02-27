<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Laravel</title>
    </head>
    <body>
        <h1>Welcome!</h1>
        <ol>
            <li><a href="{{ route('about') }}">About</a></li>
            <li><a href="{{ route('articles') }}">Articles</a></li>
        </ol>
    </body>
</html>