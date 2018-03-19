<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">


<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
<link rel="stylesheet" href="{{ URL::to('css/style.css') }}">
<link rel="stylesheet" href="{{ URL::to('css/app.css') }}">

@yield('extra-content')

    </head>
    <body>
        @include('includes.header')

        <title>@yield('title')</title>
            <div class="container">
                @yield('content')
            </div>  



<script src="https://use.fontawesome.com/df09a2f94d.js"></script>
<script src="{{ asset('js/app.js') }}"></script>


@yield('extra-content-bottom')
    </body>
    
</html>
