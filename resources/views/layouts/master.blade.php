<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>
            @hasSection('page_title')
                Weather App - @yield('page_title')
            @else
                Weather App
            @endif
        </title>

        @include('layouts.import')
    </head>
    <body>
        @include('layouts.loader')
        <div class="d-flex flex-column" id="app">
            
            <div class="main-content" id="panel">
                @yield('page-content')
            </div>
        </div>
        
        @include('layouts.scripts')
    </body>
</html>
