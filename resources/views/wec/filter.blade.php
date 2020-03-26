@extends('layouts.app')

@section('content')

<link rel="stylesheet" type="text/css" href="{{ asset('css/wec/cards.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <?php
    use App\Report;
    use Vinkla\Hashids\Facades\Hashids;
    $colors = ["category__01", "category__02", "category__03", "category__04", "category__05"];
    ?>

    <div class="breadcrumbs">
        {{ Breadcrumbs::render('filter') }}
    </div>

    @include('layouts.drawer') 
    
    <h1>Os meus relatórios WECS</h1>

    <div class="row">

    <?php
        $https = $_SERVER['QUERY_STRING'];
    ?>

    @if(count($data['wecs']) >= 1)
        @foreach($data['wecs']->where('https', $https) as $wec)
    
        <?php
            $id = Hashids::connection('main')->encode($wec->id);
        ?>

    <section class="cards">
<!--   card  -->
        <article class="card">
            <picture class="thumbnail">
                <img class="category__03" src="https://abbeyjfitzgerald.com/wp-content/uploads/2018/01/list-1.svg" alt="" />
            </picture>
            <div class="card-content">
            <p class="category category__03"><a href="/wec/find/{{$id}}">Visualizar relatórios</p></a>
            <h2>{{$wec->https}}</h2>
            
            <p>Relatório gerado pela ferramenta Website Evidence Collector &emsp;&emsp;&nbsp;</p> 
        </div><!-- .card-content -->
            <div class="post-meta">
                <span class="comments"><i class="fa fa-calendar"></i> Criado a: {{$wec->created_at}}</span>
                </div>
        
            </article>

    </section>

        @endforeach
        
    @else
    
        <p> No wecs found </p>
        
    @endif

@endsection
