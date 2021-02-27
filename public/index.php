<?php
require_once('../core/route/Route.php');
require_once('../core/model/Model.php');
require_once('../core/controller/Controller.php');

/**
 * Ajout des routes
 */
Model::createConnection();
Route::addAllRoutes(Model::getNodes());

/**
 * Récupération des données à afficher pour l'administrateur via la session
 */
Model::getAdminInfo();

/**
 * Récupération de la route
 */
$route = Route::run();

/**
 * Si la route est trouvée, on va chercher la donnée dans le modèle et on
 * affiche la vue correspondante
 */
if ($route) {
  if ($route["view_name"] == "front" && $route["method"] == "get") {
    $GLOBALS['data'] = Model::getNodeByPath("/");
  }
  // Affichage d'un node
  if ($route["view_name"] == "node" && $route["method"] == "get") {
    $controller_method = $route["controller_method"];
    $data = Controller::$controller_method($route);
    //$data = Controller::$route["controller_method"]($route);
  }

  // Affichage du formulaire de login
  else {
    if ($route["view_name"] == "admin/login" && $route["method"] == "get") {
      $admin_view_folder = "admin/";
      $GLOBALS['title'] = "Identification";

    } // Validation du formulaire de login
    else {
      if ($route["view_name"] == "admin/login_result" && $route["method"] == "post") {
        if (!Model::getUser()) {
          $route["view_name"] = "admin/login";
        }
        else {
          Model::getAdminMenu();
        }
      } // logout
      else {
        if ($route["controller_method"] == "logout" && $route["method"] == "get") {
          Model::logoutUser();
          $data = Model::getNodeByPath("/");
        } // Affichage du formulaire d'ajout d'un node
        else {
          if ($route["controller_method"] == "node_add" && $route["method"] == "get") {
            $admin_view_folder = "admin/";
          } // Affichage de la liste des nodes après l'ajout d'un node
          else {
            if ($route["controller_method"] == "node_add" && $route["method"] == "post") {
              Model::addNode();
              $data = Model::getNodes();
              $page_title = "Liste des nodes pour l'administration";
            } // Affichage du formulaire de modification d'un node
            else {
              if ($route["controller_method"] == "node_edit_form" && $route["method"] == "get") {
                $data = Model::getNode($route["model_parameters"]["nid"]);
              } // Affichage du formulaire de modification d'un node après validation du formulaire
              else {
                if ($route["controller_method"] == "node_submited_form" && $route["method"] == "post") {
                  Model::setNode();
                  $data = Model::getNode($route["model_parameters"]["nid"]);
                } // Affichage de la liste des nodes pour administration après suppression
                else {
                  if ($route["controller_method"] == "node_delete" && $route["method"] == "get") {
                    Model::deleteNode($route["model_parameters"]["nid"]);
                    $data = Model::getNodes();
                  } // Affichage de la liste des nodes pour administration
                  else {
                    if ($route["controller_method"] == "list_node_admin" && $route["method"] == "get") {
                      $data = Model::getNodes();
                      $page_title = "Liste des nodes pour l'administration";
                    }
                  }
                }
              }
            }
          }
        }
      }
    }
  }
  // Chargement du template principal
  require_once __DIR__ . '/../core/view/' . $route["view_name"] . '.php';
}
else {
  $GLOBALS['title'] = "Erreur 404";
  require_once __DIR__ . '/../core/view/404.php';
}


