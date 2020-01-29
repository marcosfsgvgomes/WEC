@extends('layouts.app')

@section('content')
    <h1>Relatórios WECS</h1>
    
    @if(count($wecs) > 1)
        @foreach($wecs as $wec)
        <div class="well">
            <small>Website inspecionado:<a href="/wec/show/{{$wec->id}}"> {{$wec->https}}</a></small><br>
            <small> Produzido por {{$wec->from}}</small><br>
            <small> Inspecionado a {{$wec->created_at}}</small>
            <br><br>
            
        </div>
        @endforeach

    @else
        <p> No wecs found </p>
    @endif

@endsection