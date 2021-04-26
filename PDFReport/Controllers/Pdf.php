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
        $regs       = "";
        $title      = "";
        $opp        = "";
        $template   = "";
        switch ($this->postData['selectRel']) {
            case 0:
                # code...
                break;
            case 1:
                $regs = $app->repo('Registration')->findBy(
                    ['opportunity' => $this->postData['idopportunityReport']
                ]);
                $title      = 'Relatório de inscritos na oportunidade';
                $template   = 'pdf/subscribers';
                break;
            case 2:
                $opp = $app->repo('Opportunity')->find($this->postData['idopportunityReport']);
                $regs = $app->repo('Registration')->findBy(
                    ['opportunity' => $this->postData['idopportunityReport'],
                    'status' => 10
                ]);
                $title      = 'Resultado Preliminar do Certame';
                $template   = 'pdf/preliminary';
                break;
            case 3:
                //JOIN COM OPORTUNITY E RESOURCE COM AMBOS PUBLICADO
                $id = $this->postData['idopportunityReport'];
                //SELECT AOS RECURSOS
                $dql = "SELECT r
                FROM 
                Saude\Entities\Resources r
                WHERE r.opportunityId = {$id}";
                $query = $app->em->createQuery($dql);
                $resource = $query->getResult();
                $countPublish = 0;//INICIANDO VARIAVEL COM 0
                foreach ($resource as $key => $value) {
                    if($value->replyPublish == 1 && $value->opportunityId->publishedRegistrations == 1) {
                        $countPublish++;//SE ENTRAR INCREMENTA A VARIAVEL
                    }else{
                        $countPublish = 0;
                    }
                }
                //SE OS DOIS VALORES BATEREM, ENTÃO GERA O PDF
                if($countPublish == count($resource)) {
                    $opp = $app->repo('Opportunity')->find($this->postData['idopportunityReport']);
                    $regs = $app->repo('Registration')->findBy(
                        ['opportunity' => $this->postData['idopportunityReport'],
                        'status' => 10
                    ]);
                    $title      = 'Resultado Preliminar do Certame';
                    $template   = 'pdf/definitive';
                }else{
                    //SE NÃO, VOLTA PARA A PÁGINA DA OPORTUNIDADE COM AVISO
                    $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                }
                break;
            case 4:
                $regs = $app->repo('Registration')->findBy(
                    ['opportunity' => $this->postData['idopportunityReport']
                ]);
                $title      = 'Relatório de contato';
                $template   = 'pdf/contact';
                break;
            default:
                $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                break;
        }
        $app->view->jsObject['opp'] = $opp;
        $app->view->jsObject['subscribers'] = $regs;
        $app->view->jsObject['title'] = $title;

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

