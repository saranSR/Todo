<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"  class="h-full bg-gray-50">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

       
<!-- CSS only -->

        <!-- Fonts -->
        @vite('resources/css/app.css')
    </head>
    <body  class="h-full">
        <div id="app"></div>
        @vite('resources/js/app.js')
    </body>
</html>
