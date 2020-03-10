<?php

namespace App\Http\Controllers;
  
use Illuminate\Http\Request;// This is important to add here. 

  
class PdfController extends Controller
{
    public function printPDF()
    {
        $home = getenv('HOME');

        $file = ($home . "/GRA_APP/public/relatorios_wec/relatorio_WEC.pdf");   
                
        /*copy($file, $dest_file); */
        
        header('Content-Description: File Transfer');
        header('Content-type: application/octet-stream');
        header('Content-Disposition; attachment; filename="'. $file .'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));
        readfile($file);

        exit;


        /*
        $file = ("../public/output/inspection.html");   
        $dest_file = ("relatorios_wec/relatorio_WEC.html");
        copy($file, $dest_file); 
        
        echo "Download na pasta de Downloads:"; */
    }
}

?>