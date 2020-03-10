@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/wec/report.css') }}">
<link rel="stylesheet" type="text/css" href="{{ asset('css/wec/sidebar.css') }}" >  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body>

    {{ Breadcrumbs::render('find') }} 
    @include('layouts.drawer') 
    <h1>Relatório WEC</h1>
    
    <br>

    <div class="sticky-sidebar">
       <i class="fa fa-file-pdf-o fa-2x"></i> <a href="{{route('customer.printpdf')}}"> Transferir ficheiro PDF </a>
    </div>

    <?php
    if (!is_readable($data['relatorio'])){
        echo "Este relatório não existe no sistema";
    }
    else{
        readfile($data['relatorio']); 
        $pdf_file = ("relatorios_wec/relatorio_WEC.pdf");
        exec("wkhtmltopdf " . $data['relatorio'] . "  " . $pdf_file); 
    }
    ?>

@endsection
