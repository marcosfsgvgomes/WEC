@extends('layouts.app')

<link rel="stylesheet" type="text/css" href="{{ asset('css/wec/index.css') }}" >  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

@section('content')	

<?php
	use App\Report;
	use Vinkla\Hashids\Facades\Hashids;
	session_start();
	$id = "Anon_";
	session(['sessionid' => uniqid($id)]);

?>

	<div class="breadcrumbs" aria-expanded="false">
		{{ Breadcrumbs::render('wec') }}
	</div>	
    

	<div class="container-index">  	
		
		<div class="logo">
			<img src="{{ asset('images/wec.png') }}" alt="logo">
		</div>
		
		<section>			
			<article>		
				<p>Aplicação para inspeccionar sítios de internet</p>
				<p>Website Evidence Collector</p>
			</article>			
		</section>

		<div class="loader hidden">
			<img src="{{ asset('images/loading.gif') }}"  alt="Loading..." />
		</div>

		<form class="wecForm" method="POST" action="/anonymous/inspect">
		@csrf
			<label>Insira um URL:</label> 
			<input type="url" size="50" name="user_website" required placeholder="https://example.com" pattern="https://.*" value="https://">
			<button class="button" title="Inspecionar website" type="submit" value="submit">
				<i class="fa fa-search fa-2x"> </i>
			</button><br><br>
		</form>		

		<div class="box">
        <?php
			$all = Report::count();
			$sites = Report::distinct('https')->whereNotNull('relatorio')->count('https');
			$reports = Report::count('relatorio');
		   echo "Inspeções realizadas: " . $all;  
		   echo "<br> Sítios web inspecionados: " . $sites;   
		   echo "<br>Relatórios gerados: " . $reports;             
		?> 
		
		</div>
		
	</div>

	
@endsection

<script>
	var msg = '{{Session::get('alert')}}';
	var exist = '{{Session::get('alert')}}';
	if(exist){
		alert(msg);
	}

	window.addEventListener("load", function (){
		const loader = document.querySelector(".loader");
		loader.className += " hidden";
	}

</script>