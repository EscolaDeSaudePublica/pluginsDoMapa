<?php
namespace PDFReport\Controllers;
use \MapasCulturais\App;
use Dompdf\Dompdf;

class Pdf extends \MapasCulturais\Controller{

    function POST_gerarPdf() {
        $domPdf = new Dompdf(array('enable_remote' => true));
        // dump($this->postData);
        // dump($domPdf);
        ini_set('display_errors', 1);
        error_reporting(E_ALL);
        $app = App::i();
        if($this->postData['selectRel'] != 1) {
            
        }
        $regs = "";
        $title = "";
        $opp = "";
        $template = "";
        switch ($this->postData['selectRel']) {
            case 0:
                # code...
                break;
            case 1:
                $regs = $app->repo('Registration')->findBy(
                    ['opportunity' => $this->postData['idopportunityReport']
                ]);
                $title = 'Relatório de inscritos na oportunidade';
                $template = 'pdf/subscribers';
                break;
            case 2:
                $opp = $app->repo('Opportunity')->find($this->postData['idopportunityReport']);
                $regs = $app->repo('Registration')->findBy(
                    ['opportunity' => $this->postData['idopportunityReport'],
                    'status' => 10
                ]);
                $title = 'Resultado Preliminar do Certame';
                $template = 'pdf/preliminary';
                break;
            case 3:
                
                $regs = $app->repo('Registration')->findBy(
                    ['opportunity' => $this->postData['idopportunityReport'],
                    'status' => 10
                ]);
                $title = 'Relatório definitivo';
                break;
            
            default:
                $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                break;
        }
        
        
        $app->view->jsObject['opp'] = $opp;
        $app->view->jsObject['subscribers'] = $regs;
        $app->view->jsObject['title'] = $title;
        //$app->render('pdf/preliminary');
        //die();
        //$content = $app->render('pdf/preliminary');
        $content = $app->view->fetch($template);
        //$content = $app->render('pdf/layout', array('report' => $report)); 
        $domPdf->loadHtml($content);
        $domPdf->setPaper('A4', 'portrait');
        $domPdf->render();
        // Output the generated PDF to Browser
        //$domPdf->stream();
        $domPdf->stream("dompdf_out.pdf", array("Attachment" => false));
        exit(0);
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

