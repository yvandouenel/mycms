<?php
require_once('../core/controler/Route.php');
require_once('../core/model/Model.php');

/**
 * Ajout des routes
 */
Route::addAllRoutes();

/**
 * Récupération des données à afficher pour l'administrateur via la session
 */
Model::getAdminInfo();

/**
 * Récupération de la route
 */
$route = Route::run();

/**
 * Si la route est trouvée, on va chercher la donnée dans le modèle et on affiche la vue correspondante
 */
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

    }
    // Validation du formulaire de login
    else if($route["model_name"] == "login" && $route["method"] == "post") {
        $admin_view_folder = "admin/";
        if( !Model::getUser()) {
            $route["view_name"] = "login";
        } else {
            Model::getAdminMenu();
        }
    }
    // logout
    else if($route["model_name"] == "logout" && $route["method"] == "get") {
        Model::logoutUser();
        $GLOBALS['data'] = Model::getNodeByPath("/");
    }
    // Affichage du formulaire d'ajout d'un node
    else if($route["model_name"] == "node_add" && $route["method"] == "get") {
        $admin_view_folder = "admin/";
    }
    // Affichage de la liste des nodes après l'ajout d'un node
    else if($route["model_name"] == "node_add" && $route["method"] == "post") {
        Model::addNode();
        $GLOBALS['data'] = Model::getNodes();
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
    // Affichage de la liste des nodes pour administration après suppression
    else if($route["model_name"] == "node_delete" && $route["method"] == "get") {
        Model::deleteNode($route["model_parameters"]["nid"]);
        $GLOBALS['data'] = Model::getNodes();
    }
    // Affichage de la liste des nodes pour administration
    else if($route["model_name"] == "list_node_admin" && $route["method"] == "get") {
        $GLOBALS['data'] = Model::getNodes();
    }
    require_once('../core/view/' . $route["view_name"] .'.php');
} else {
    $GLOBALS['title'] = "Erreur 404";
    require_once('../core/view/404.php');
}


