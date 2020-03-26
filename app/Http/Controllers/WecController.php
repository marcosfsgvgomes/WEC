<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;
use Vinkla\Hashids\Facades\Hashids;

class WecController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
            $wec = new Report;
            $wec->https = request('user_website');
            $wec->from = $request->user()->name;
            $wec->relatorio = null;
            $wec->save();
            return redirect()->back()->with('alert', 'Relatório não foi gerado! Por favor confirme se o https inserido é válido.'); 
        }    
        
        /* Capta ficheiro de inspecao e replica-o */
        $file = ("../public/output/inspection.html");   
        $dest_file = ("relatorios_wec/");
        $pdf_file = ("relatorios_wec/relatorio_WEC.pdf");
        exec("wkhtmltopdf " . $file . "  " . $pdf_file); 
        $dest_file = uniqid($dest_file) . ".html";
        copy($file, $dest_file); 

        /* Guarda informaçao na BD */
        $wec = new Report;
        $wec->https = request('user_website');
        $wec->from = $request->user()->name;
        $wec->relatorio = $dest_file;
        $wec->save();

        /* Retorna vista com o relatório de inspecao */
        return view('wec.inspection')->with('relatorio', $dest_file); 
    }

    public function storeAnon(Request $request)
    {    
       
        /* Executa comando na shell */
        $https = request('user_website');
        $cmd = ("website-evidence-collector --quiet --yaml --overwrite {$https} -- --no-sandbox"); 

        exec($cmd, $output, $result);

        /*Se der erro: $result > 0 */
        if ($result > 0){
            $wec = new Report;
            $wec->https = request('user_website');
            $wec->from = $request->session()->get('sessionid');
            $wec->relatorio = null;
            $wec->save();
            return redirect()->back()->with('alert', 'Relatório não foi gerado! Por favor confirme se o https inserido é válido.'); 
        }    
        
        /* Capta ficheiro de inspecao e replica-o */
        $file = ("../public/output/inspection.html");   
        $dest_file = ("relatorios_wec/");
        $pdf_file = ("relatorios_wec/relatorio_WEC.pdf");
        exec("wkhtmltopdf " . $file . "  " . $pdf_file); 
        $dest_file = uniqid($dest_file) . ".html";
        copy($file, $dest_file); 

        /* Guarda informaçao na BD */
        $wec = new Report;
        $wec->https = request('user_website');
        $wec->from = $request->session()->get('sessionid');
        $wec->relatorio = $dest_file;
        $wec->save();

        /* Retorna vista com o relatório de inspecao */
        return view('anonymous/inspection')->with('relatorio', $dest_file); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        /* Apresenta todos os relatórios gerados previamente pelo utilizador em sessão */
        $user = auth()->user();
        $wecs = Report::where('from', $user->name)->whereNotNull('relatorio')->get();
        return view('wec.show')->with('wecs', $wecs);
    }

    public function filter(Request $request)
    {
        /* Apresenta todos os relatórios gerados previamente pelo utilizador em sessão */
        $https = $request->https;
        $user = auth()->user();
        $wecs = Report::where('from', $user->name)->get();
        $data = array (
            'wecs'=> $wecs,
            'https' => $https
        );
        return view('wec.filter')->with('data', $data);;
    }

    public function find($id)
    {
        /* Encontra relatório especifico */
        $relatorio = Report::where('id', Hashids::decode($id))->value('relatorio');
        if ($relatorio === null){
            return abort(404);
        }
        $data = array (
            'id'=>$id,
            'relatorio'=>$relatorio
        );
        $pdf_file = ("relatorios_wec/relatorio_WEC.pdf");
        exec("wkhtmltopdf " . $data['relatorio'] . "  " . $pdf_file); 
        return view('wec.update')->with('data', $data);         
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
