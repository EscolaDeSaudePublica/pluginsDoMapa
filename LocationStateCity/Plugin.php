<?php
namespace LocationStateCity;
use MapasCulturais\App;
use MapasCulturais\i;

class Plugin extends \MapasCulturais\Plugin {

    public function registerAssets()
    {
        $app = App::i();

        // enqueue scripts and styles
    }

    public function _init() {
        // enqueue scripts and styles

        // add hooks
        $app = App::i();
        $app->view->enqueueScript('app', 'locationStateCity', 'js/locationStateCity.js'); 
        $app->hook('GET(location.locationState)', function () use($app){
            echo "Location";
        });
    }

    public function register() {
        // register metadata, taxonomies
        $app = App::i();
        $app->registerController('location', 'LocationStateCity\Controllers\Location');
    }
}