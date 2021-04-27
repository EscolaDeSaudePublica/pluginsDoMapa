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
                $regs = $this->oportunityRegistrationApreved($this->postData['idopportunityReport']);
                if(empty($regs['regs'])){
                    $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                }
                $title      = 'Relatório de inscritos na oportunidade';
                $template   = 'pdf/subscribers';
                break;
            case 2:
                //BUSCANDO TODOS OS REGISTROS
                $regs = $this->oportunityRegistrationApreved($this->postData['idopportunityReport']);
                if(empty($regs['regs'])){
                    $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                }
                $title      = 'Resultado Preliminar do Certame';
                $template   = 'pdf/preliminary';
                break;
            case 3:
                //ESSE CASE, VERIFICA SE OS RECURSOS E A OPORTUNIDADE
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
                //O PDF SOMENTE SERÁ GERADO NA EVENTUALIDADE DA AOPORTUNIDADE ESTÁ PUBLICADA E OS RECURSOS TBM ESTIVEREM PUBLICADOS
                if($countPublish == count($resource) && $countPublish > 0 && count($resource) > 0) {
                    $regs = $this->oportunityRegistrationApreved($this->postData['idopportunityReport']);
                    $title      = 'Resultado Definitivo do Certame';
                    $template   = 'pdf/definitive';
                }else{
                    //SE NÃO, VOLTA PARA A PÁGINA DA OPORTUNIDADE COM AVISO
                    $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                }
                break;
            case 4:
                $regs = $this->oportunityRegistrationApreved($this->postData['idopportunityReport']);
                if(empty($regs['regs'])){
                    $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                }
                $title      = 'Relatório de contato';
                $template   = 'pdf/contact';
                break;
            default:
                $app->redirect($app->createUrl('oportunidade/'.$this->postData['idopportunityReport']), 401);
                break;
        }
        $app->view->jsObject['opp'] = $regs['opp'];
        $app->view->jsObject['subscribers'] = $regs['regs'];
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

    /**
     * Busca a oportunidade e todos os aprovados da inscrição 
     *
     * @param [integer] $idopportunity
     * @return void array
     */
    function oportunityRegistrationApreved($idopportunity) 
    {
        $app = App::i();
        $opp = $app->repo('Opportunity')->find($idopportunity);
        $regs = $app->repo('Registration')->findBy(
            [
            'opportunity' => $idopportunity,
            'status' => 10
            ]
        );

        return ['opp' => $opp, 'regs' => $regs];
    }

}

