<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Intarnet GRA</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}" >  
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    </head>
    <body>
    
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

        <div class="content">
            <div class="title m-b-md">
                Ferramenta WEC
            </div>
            <div class="links">
            <?php
                if (!Auth::check())
                {
            ?>
            
                <a href="{{ route("anonymous/index") }}"> Inspecionar </a>
            <?php
                }
            ?>
            </div>
            <?php
                if (Auth::check())
                {
                ?>
                <div class="links">
                    <a href="/wec">WEC</a>
                    <a href="https://tuleap-web.tuleap-aio-dev.docker/">Tuleap</a>
                    <a href="/admin">CoreUI</a>
                    <a href="https://github.com/EMRAP/Intranet_GRA">GitHub</a>
                    <a href="https://laravel.com/docs">Docs</a>
                </div>  
                
            <?php
                }
            ?>
            </div>
            <div class="content">
                <div id="GRA_APP" class="title m-b-md">                </div>
            </div>
        </div>
    </body>
    <script type="text/javascript" src="js/app.js"></script>
    <script> $(".links a").length; //dá número de links inside a div </script> 
</html>
