@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/wec/report.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/wec/sidebar.css') }}" >  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    {{ Breadcrumbs::render('inspection') }}
    @include('layouts.drawer') 
    <h1>Relatório WEC</h1>
    
    <br>

    <div class="sticky-sidebar">
       <i class="fa fa-file-pdf-o fa-2x"></i> <a href="{{route('customer.printpdf')}}"> Transferir ficheiro PDF </a>
    </div>

    <?php
        readfile($relatorio); 
    ?>

@endsection
