<!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">

            <title></title>

            <!-- Styles -->
            <link href="{{ mix('css/custom.css')}}" rel="stylesheet">
            <link href="{{ mix('css/all.css')}}" rel="stylesheet">

        </head>
        <body>
        @include('frontend.partials.header')

        @yield('content')

        @include('frontend.partials.footer')

        <script src="{{ mix('js/app.js')}}"></script>

        </body>
    </html>
