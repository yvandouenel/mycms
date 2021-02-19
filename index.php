<?php
require_once('core/controler/Route.php');
require_once('core/model/Model.php');

// Ajout des routes
Route::add('~^/$~',"get","front","front");
Route::add('~^/test.html$~');
Route::add('~^/node/([0-9]+)/?$~',"get","node","node");
Route::add('~^/node/([0-9]+)/edit$~',"get","node_edit_form","node_edit_form");
Route::add('~^/node/[0-9]+/edited$~',"post","node_edit_form","node_submited_form");
$route = Route::run();

// si la route est trouvée, on va chercher la donnée dans le modèle et on affiche la vue correspondante
if($route) {
    Model::createConnection();
    // Affichage d'un node
    if($route["model_name"] == "node" && $route["method"] == "get") {
        $GLOBALS['data'] = Model::getNode($route["model_parameters"]["nid"]);
    }
    // Affichage du formulaire de modification d'un node
    else if($route["model_name"] == "node_edit_form" && $route["method"] == "get") {
        $GLOBALS['data'] = Model::getNode($route["model_parameters"]["nid"]);
    }
    // Affichage du formulaire de modification d'un node après validation du formulaire
    else if($route["model_name"] == "node_submited_form" && $route["method"] == "post") {
        Model::setNode();
        $GLOBALS['data'] = Model::getNode($route["model_parameters"]["nid"]);
    }
    require_once('core/view/' . $route["view_name"] .'.php');
} else {
    require_once('core/view/404.php');
}


