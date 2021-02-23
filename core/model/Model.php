<?php

class Model
{
    public static $pdo;

    public static function createConnection()
    {
        try {
            self::$pdo = new PDO('mysql:host=localhost;dbname=mycms;charset=utf8', 'yvan', '51biba95');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            echo "Pb de connexion à la base de données ", $e->getMessage();
        }
    }

    public static function getUser()
    {
        if ($_POST["login"] == "yvan" && $_POST["pwd"] == "123") {
            $GLOBALS['login'] = true;
            $GLOBALS['info']['msg'] = "Identification réussie";
            $GLOBALS['info']['type'] = "success";
            // Set sessions
            if(!isset($_SESSION)) {
                if(session_start()) {
                    $_SESSION["login"] = true;
                    return true;
                }
                else return false;
            }
        } else {
            $GLOBALS['login'] = false;
            $GLOBALS['info']['msg'] = "Problème d'identification";
            $GLOBALS['info']['type'] = "warning";
            return false;
        }
    }

    public static function logoutUser()
    {
        if(!isset($_SESSION)) {
            if(session_start()) unset($_SESSION['login']);
        }
    }
    

    public static function getNode($node_id)
    {
        try {
            $data = [
                'nid' => $node_id
            ];
            $req = self::$pdo->prepare('SELECT * FROM node WHERE nid = :nid');
            $req->execute($data);
            return $req->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Pb de requête", $e->getMessage();
        }
    }

    public static function setNode()
    {
        // gestion de l'image
        $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/images/original/';
        $uploadfile = $uploaddir . basename($_FILES['image']['name']);

        if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
            $GLOBALS['info']["msg"] = "Fichier uploadé";
            $GLOBALS['info']["type"] = "success";
        } else {
            $GLOBALS['info']["msg"] = "Problème de téléchargement";
            $GLOBALS['info']["type"] = "warning";
        }


        echo '</pre>';

        // enregistrement en base de données
        try {
            $data = [
                'nid' => $_POST['nid'],
                'title' => $_POST['title'],
                'seo_title' => $_POST['seo_title'],
                'body' => $_POST['body'],
                'image' => $_FILES['image']['name'],
                'path' => $_POST['path'],
            ];

            $req = self::$pdo->prepare('UPDATE node SET 
                title = :title, 
                seo_title = :seo_title, 
                seo_title = :seo_title, 
                body = :body, 
                image = :image, 
                path = :path   
                WHERE nid = :nid');
            $req->execute($data);
            //var_dump($_POST['image']);

        } catch (PDOException $e) {
            echo "Pb de requête", $e->getMessage();
        }
    }

    public static function getNodeByPath($path)
    {
        try {
            $data = [
                'path' => $path
            ];
            $req = self::$pdo->prepare('SELECT * FROM node WHERE path = :path');
            $req->execute($data);
            return $req->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Pb de requête", $e->getMessage();
        }
    }


}