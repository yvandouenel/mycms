<?php
class Controller {
 public static function displayNode($route) {
   $data = Model::getNode($route["model_parameters"]["nid"]);
   // si ce node a un alias et qu'il n'est pas utilisé, on redirige
   if($data->path && !preg_match($route["pattern"], "/" .$data->path)) {
     header("location:/" . $data->path);
   }
   return $data;
 }
}