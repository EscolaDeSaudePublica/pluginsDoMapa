<?php
namespace PDFReport;

use MapasCulturais\App;

class Plugin extends \MapasCulturais\Plugin {
    public function _init() {
        // enqueue scripts and styles

        // add hooks
        $app = App::i();

        //
        $app->hook('template(opportunity.single.header-inscritos):end', function () use ($app) {
            $app->view->enqueueScript('app', 'pdfreport', 'js/pdfreport.js');
            $this->part('reports/buttons-report');
        });
    }

    public function register() {
        // register metadata, taxonomies
        $app = App::i();
        $app->registerController('pdf', 'PDFReport\Controllers\Pdf');
    }
}