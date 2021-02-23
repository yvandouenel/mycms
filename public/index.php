<?php
require_once('../core/controler/Route.php');
require_once('../core/model/Model.php');

// Ajout des routes
Route::add('~^/$~',"get","front","front");
Route::add('~^/login(/error)?$~',"get","login","login");
Route::add('~^/logout$~',"get","front","logout");
Route::add('~^/login$~',"post","login_result","login");
Route::add('~^/node/([0-9]+)/?$~',"get","node","node");
Route::add('~^/node/([0-9]+)/edit$~',"get","node_edit_form","node_edit_form");
Route::add('~^/node/[0-9]+/edited$~',"post","node_edit_form","node_submited_form");



// Récupération de la route
$route = Route::run();

// si la route est trouvée, on va chercher la donnée dans le modèle et on affiche la vue correspondante
if($route) {
    Model::createConnection();
    $admin_view_folder = "";
    if($route["model_name"] == "front" && $route["method"] == "get") {
        $GLOBALS['data'] = Model::getNodeByPath("/");
    }
    // Affichage d'un node
    if($route["model_name"] == "node" && $route["method"] == "get") {
        $GLOBALS['data'] = Model::getNode($route["model_parameters"]["nid"]);
    }
    // Affichage du formulaire de login
    else if($route["model_name"] == "login" && $route["method"] == "get") {
        $admin_view_folder = "admin/";
        $GLOBALS['title'] = "Identification";
        if(isset($route["error"]) && $route["error"]) {
            $GLOBALS['login'] = false;
            $GLOBALS['info']['msg'] = "Problème d'identification";
            $GLOBALS['info']['type'] = "warning";
        }

    }
    else if($route["model_name"] == "login" && $route["method"] == "post") {
        $admin_view_folder = "admin/";
        if( !Model::getUser()) {
            header('Location: /login/error');
            die();
        }
    }
    // logout
    else if($route["model_name"] == "logout" && $route["method"] == "get") {
        Model::logoutUser();
        $GLOBALS['data'] = Model::getNodeByPath("/");
    }
    // Affichage du formulaire de modification d'un node
    else if($route["model_name"] == "node_edit_form" && $route["method"] == "get") {
        $GLOBALS['data'] = Model::getNode($route["model_parameters"]["nid"]);
        $admin_view_folder = "admin/";
    }
    // Affichage du formulaire de modification d'un node après validation du formulaire
    else if($route["model_name"] == "node_submited_form" && $route["method"] == "post") {
        Model::setNode();
        $GLOBALS['data'] = Model::getNode($route["model_parameters"]["nid"]);
        $admin_view_folder = "admin/";
    }
    require_once('../core/view/' . $admin_view_folder . $route["view_name"] .'.php');
} else {
    require_once('../core/view/404.php');
}


