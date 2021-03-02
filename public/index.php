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
  // Récupération des données via la méthode du controller associée à cette route
  $controller_method = $route["controller_method"];
  $data = Controller::$controller_method($route);

  // Chargement du template principal
  require_once __DIR__ . '/../core/view/' . $route["view_name"] . '.php';
}
else {
  $GLOBALS['title'] = "Erreur 404";
  require_once __DIR__ . '/../core/view/404.php';
}


