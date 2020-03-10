@extends('layouts.app')

@section('content')
    <h1>  ERROR - Website not found</h1>
    <small> Please enter a valid https:// </small>

    <?php
        abort(404);
    ?>
    
   

@endsection