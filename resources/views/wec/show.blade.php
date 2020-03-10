@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/wec/cards.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php
    use App\Report;
    use Vinkla\Hashids\Facades\Hashids;
    $colors = ["category__01", "category__02", "category__03", "category__04", "category__05"];
    $i = -1;  
    ?>

    <div class="breadcrumbs" aria-expanded="false"> 
        {{ Breadcrumbs::render('show') }}
    </div>
    @include('layouts.drawer') 

    <h1>Websites inspecionados</h1>
    <div class="row"

    @if(count($wecs) >= 1) 
        @foreach($wecs->unique('https') as $wec)
            
        <?php
            $id = Hashids::connection('main')->encode($wec->id);
            $https = $wec->https;
            $all = Report::where('https', $https)
            ->whereNotNull('relatorio')
           ->selectRaw('https, COUNT(*) as occurrences')
           ->groupBy('https')
           ->value('occurrences');

           $unique = Report::where('https', $https)
            ->distinct()->count(['from']);

            $i++;
            if ($i == 5){
                $i = 0;
            }                         
        ?>      

    <section class="cards">   
<!--   card  -->
        <article class="card">
            <picture class="thumbnail">
                <img class="{{ $colors[$i] }}" src="https://abbeyjfitzgerald.com/wp-content/uploads/2018/01/list-1.svg" alt=""/>
            </picture>
            <div class="card-content">
            <p class="category {{$colors[$i] }}"><a href="{{route('wec.show.filter', $https)}}">Visualizar relatórios</a></p>
            <h2>{{$wec->https}}</h2>
            <p>Endereço inspecionado pela ferramenta Website Evidence Collector</p>
        </div>
        <!-- .card-content -->
            <div class="post-meta">
                <span class="comments"> <i class="fa fa-file-text">&nbsp{{$all}} relatórios gerados</i> </span>
                <span class="comments">  <i class="fa fa-user"></i>&nbspPor {{$unique}} utilizadores</span>
                </div>
        
            </article>

    </section>
        
        @endforeach
        
    @else
    
        <p> No wecs found </p>
        
    @endif

@endsection
