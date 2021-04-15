<?php
namespace PDFReport\Controllers;
use \MapasCulturais\App;
use Dompdf\Dompdf;

class Pdf extends \MapasCulturais\Controller{

    function POST_gerarPdf() {
        $domPdf = new Dompdf();
        // dump($this->postData);
        // dump($domPdf);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $app = App::i();
        $report = ['dev01' => 'fernanda', 'dev02' => 'Jr'];
        // $app->view->appendData(array(
        //     'dev01' => 'fernanda',
        //     'dev02' => 'Jr'
        //   ));
        //   $app->view->fetch('pdf/meuNome');
        // $content = $app->view->fetch('pdf/meuNome');
        
        $content = $app->view->fetch('pdf/meuNome');
        // $lay = $app->render('pdf/layout', array('content' => $content)); 
        $domPdf->loadHtml($content);
        $domPdf->setPaper('A4', 'portrait');
        $domPdf->render();
        // Output the generated PDF to Browser
        $domPdf->stream();
    }

    function GET_dadosCandidato() {
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
//         $app = App::i();
//         //dump($this->getData);
//         $dompdf = new Dompdf();
//         $report = EntitiesResources::find($this->getData['id']);
//         // $this->render('printResource', ['report' => $report, 'dompdf' => $dompdf]);
//         $content = $app->view->fetch('recursos/printResource', ['report' => $report, 'dompdf' => $dompdf]);
// //         $html = file_get_contents("https://github.com/dompdf/dompdf"); 
//         $dompdf->loadHtml($content);

// // (Optional) Setup the paper size and orientation
//         $dompdf->setPaper('A4', 'landscape');

//         // Render the HTML as PDF
//         $dompdf->render();

//         // Output the generated PDF to Browser
//         $dompdf->stream();


    }
}

