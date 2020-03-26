@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/guests/failedLogin.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/wec/sidebar.css') }}" >  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- Scripts -->
<script src="{{ asset('js/validation.js')}}"></script>
</head>

<body>

    <div class="loader hidden">
			<img src="{{ asset('images/loading.gif') }}"  alt="Loading..." />
    </div>

    {{ Breadcrumbs::render('anonymous_inspection') }}
    @include('layouts.drawer_anon') 
    <h1>Relatório WEC</h1>
    
    <br>   
        
    <div class="sticky-sidebar">
       <i class="fa fa-file-pdf-o fa-2x"></i> <a href="{{route('customer.printpdf')}}"> Transferir ficheiro PDF </a>
    </div>

    <div class="sticky-sidebar2">
        <a href="#" onclick="return show()" id="show"> Transferir relatório para área de trabalho</a>
    </div>

    <div id="pop" class="popup">
        
         <!--   <form method="POST" action="/authentication">
                @csrf

                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail Adress" autofocus>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                
                <button type="submit" class="btn auth">
                    {{ __('Login') }}
                </button>
       
               
            </form>     
            <button class="btn register" onclick="window.location='{{ route("register") }}'">Register </button>
            -->
        <div class="login-page">
            <div class="form">
            <i class="fa fa-times-circle fa-2x" onclick="return hide()"> </i>

            <form class="login-form" method="POST" action="/authentication">
                @csrf
                    <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail Adress"/>
                    
                    @if($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif                
               
                    <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password"/>

                    @if($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                   
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <button type="submit" name="form1">{{ __('Login') }}</button>
                    <p class="message">Not registered? <a href="#" onclick="return show_register()">Create an account</a></p>
            </form>

            <form class="register-form" method="POST" action="/registration">
            {{csrf_field()}}
                <input id="name" type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Name" required autocomplete="name" />
                @if($errors->has('name'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('name') }}}</strong>
                    </span>
                @endif
                
                <input id="email" type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail Address" required autocomplete="email" />
                @if($errors->has('email'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

                <input id="username" type="text" name="username" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" placeholder="Username" required />
                @if($errors->has('username'))          
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif

                <input id="password" type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" required autocomplete="new-password" />
                @if($errors->has('password'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                
                <input id="password-confirm" type="password" name="password_confirmation" class="form-control"  placeholder="Confirm Password" required autocomplete="new-password" />
                
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <button type="submit">{{ __('Register') }}</button>
                <p class="message">Already registered? <a href="#" onclick="return show_login()">Sign In</a></p>
            </form>

                
            </div>
        </div>
      
    </div>
    
    <?php
        readfile($relatorio); 
    ?>

@endsection

<script>
    function show(){
        $('.popup').css('display','flex');
        $('.login-page').css('display','flex');
    }

    function hide(){
        $('.popup').css('display','none');
        $('.login-page').css('display','flex');
    }

    function show_register(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    }

    function show_login(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    }

	var msg = '{{Session::get('alert')}}';
	var exist = '{{Session::get('alert')}}';
	if(exist){
		alert(msg);
    }  
       
</script>   

