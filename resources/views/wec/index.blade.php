@extends('layouts.app')

@section('content')
    <title>WEC GRA</title>
    <style>

        .wecForm {
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            font-size: 0.8em;
            padding: 1em;
            border: 1px solid #ccc;
            border-radius: 3px;
            }
            
            .wecForm * {
            box-sizing: border-box;
            }
            
            .wecForm label {
            padding: 0;
            font-weight: bold;
            }
            
            .wecForm input {
            border: 1px solid #ccc;
            border-radius: 3px;
            font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
            font-size: 0.9em;
            padding: 0.5em;
            }
            
            .wecForm button {
            padding: 0.7em;
            border-radius: 0.5em;
            background: #eee;
            border: none;
            font-weight: bold;
            }
            
            .wecForm button:hover {
            background: #ccc;
            cursor: pointer;
            }

    </style>
</head>

<body>

	<header>
		
	</header>
	
	<section>
	
		<article>
			<header>
				<h2>Ferramenta WEC</h2>
				
			</header>
            <p>The tool collects evidence of personal data processing, such as cookies, or requests to third parties. </p>
		</article>
		
	</section>

    <form class="wecForm" method="POST" action="wec/show">
    @csrf
        <label>Insira um URL https://</label> 
        <input type="url" name="user_website" required placeholder="https://example.com" pattern="https://.*">

        
        <button type="submit" value="submit"> Inspecionar </button><br><br>
        <a href="/wec/show">Show all</a>    
    
    </form>
            
	<aside>
    <p>Website Evidence Collector under the European Union Public License (EUPL-1.2). </p>
	</aside>

	<footer>
		<p> Governo Regional dos Açores </p>
	</footer>

@endsection
