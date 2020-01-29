<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Wec;

class WecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $wec = Wec::all();
        return view('wec.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
                
        /* Executa comando na shell */
    $https = request('user_website');
    $cmd = ("website-evidence-collector --quiet --yaml --overwrite {$https} -- --no-sandbox"); 

    exec($cmd, $output, $result);

    /*Se der erro: $result > 0 */
    if ($result > 0){
        return view('wec.error');
    }    
    
    /* Capta ficheiro de inspecao e replica-o */
    $file = ("../public/output/inspection.html");   
    $dest_file = ("relatorios_wec/relatorio_WEC.html");
    $dest_file = preg_replace("/\.[^\.]{3,4}$/i", time(). "$0", $dest_file);
    readfile($file);
    copy($file, $dest_file); 
    
    /* Guarda informaçao na BD */
    $wec = new Wec;
    $wec->https = request('user_website');
    $wec->from = $request->user()->name;
    $wec->relatorio = $dest_file;
    $wec->save();

    /* Retorna vista com o relatório de inspecao */
    return view('wec.update')->with($file); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $wecs = Wec::all();
        return view('wec.show')->with('wecs', $wecs);
        
    }

    public function find($id)
    {
        $wecs = Wec::find($id);
        return view('wec.single')->with('wecs', $wecs);
        
    }

/**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $https->https = request('user_website');
        $a = system('website-evidence-collector --quiet --yaml --overwrite' . $https . '-- --no-sandbox'); 
        return view('wec.update')->with('wec', $a);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
