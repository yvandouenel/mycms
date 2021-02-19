<?php

$request = $_SERVER['REQUEST_URI'];
$title_answer = "";
$message_answer = "";

$route_finded = false;
while (!$route_finded) {
    preg_match('~/(node)/([0-9]+)/(.+)~', $request, $matches, PREG_OFFSET_CAPTURE);
    if (isset($matches[1][0]) && isset($matches[2][0]) && isset($matches[3][0])) {
        if($matches[3][0] == "edit") {
            echo "on va mettre à jour le node d'id " . $matches[2][0];
            $route_finded = true;
            break;
        }

    }
    preg_match('~/(node)/([0-9]+)~', $request, $matches, PREG_OFFSET_CAPTURE);
    if (isset($matches[1][0]) && isset($matches[2][0])) {
        echo "on va chercher le node d'id " . $matches[2][0];
        $route_finded = true;
        break;
    }
    if(preg_match('~^/admin/node/add/?$~', $request)) {
        echo "on va ajouter un node ";
        $route_finded = true;
        break;
    };
    if (isset($matches[1][0]) && isset($matches[2][0])) {
        echo "on va chercher le node d'id " . $matches[2][0];
        $route_finded = true;
        break;
    }
    $title_answer = "Erreur de route";
    $message_answer = "Votre requête ne correspond à aucun contenu";
    $route_finded = true;
    break;
}




//print_r($matches);
/*echo $matches[1][0];
echo "\n";
echo $matches[2][0];*/
/*switch ($request) {
    case preg_match('~/(article)/([0-9]+)~', $request, $matches, PREG_OFFSET_CAPTURE) :
        print_r($matches);
        $title_answer = $matches[1][0];
        $message_answer = $matches[2][0];
        break;
    case '/' :
        $title_answer = "Page d'accueil";
        $message_answer = "Page d'accueil";
        break;
    case '/about' :
        $title_answer = "A propos";
        $message_answer = "A propos";
        break;
    default:
        $title_answer = "Erreur de route";
        $message_answer = "Votre requête ne correspond à aucun contenu";
        break;
}*/