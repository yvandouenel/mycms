<?php

class Model
{
    public static $pdo;

    public static function createConnection()
    {
        try {
            self::$pdo = new PDO('mysql:host=localhost;dbname=mycms;charset=utf8', 'yvan', '51biba95');
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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
            if (!isset($_SESSION)) {
                if (session_start()) {
                    $_SESSION["login"] = true;
                    return true;
                } else return false;
            } else {
                $_SESSION["login"] = true;
                return true;
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
        if (!isset($_SESSION)) {
            if (session_start()) unset($_SESSION['login']);
        } else {
            unset($_SESSION['login']);
        }
    }

    public static function getAdminMenu()
    {
        $GLOBALS["admin_menu"] = [
            "contents" => ["path" => "/list-node-admin", "label" => "Contenus"],
            "logout" => ["path" => "/logout", "label" => "Déconnexion"]
        ];
    }

    public static function getNode($nid)
    {
        try {
            $data = [
                'nid' => $nid
            ];
            $req = self::$pdo->prepare('SELECT * FROM node WHERE nid = :nid');
            $req->execute($data);
            return $req->fetch(PDO::FETCH_OBJ);
        } catch (PDOException $e) {
            echo "Pb de requête", $e->getMessage();
        }
    }

    public static function addimage() {
        if (isset($_FILES['image']['name']) && $_FILES['image']['name']) {
            $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/images/original/';
            $uploadfile = $uploaddir . basename($_FILES['image']['name']);

            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
               return "Fichier uploadé";
            } else {
                return "Problème de téléchargement de l'image";
            }
        } else return "";
    }
    public static function addNode()
    {
        // gestion de l'image
        $msg_img = self::addImage();

        // enregistrement en base de données
        try {
            $data = [
                'title' => $_POST['title'],
                'seo_title' => $_POST['seo_title'],
                'body' => $_POST['body'],
                'image' => $_FILES['image']['name'],
                'path' => $_POST['path'],
            ];

            $req = self::$pdo->prepare('INSERT node SET 
                title = :title, 
                seo_title = :seo_title, 
                body = :body, 
                image = :image, 
                path = :path');
            $req->execute($data);
            $GLOBALS['info']["msg"] = "Insertion d'un node. <br>" . $msg_img;
            $GLOBALS['info']["type"] = "success";
        } catch (PDOException $e) {
            $GLOBALS['info']["msg"] = "Problème d'insertion en base de données : " . $e->getMessage() . "<br>" . $msg_img;
            $GLOBALS['info']["type"] = "warning";
        }
    }

    public static function deleteNode($nid)
    {
        try {
            $data = [
                'nid' => $nid
            ];
            $req = self::$pdo->prepare('DELETE FROM node WHERE nid = :nid');
            $req->execute($data);
            $GLOBALS['info']["msg"] = "Suppression d'un node.";
            $GLOBALS['info']["type"] = "success";
        } catch (PDOException $e) {
            $GLOBALS['info']["msg"] = "Problème de suppresion d'un node en base de données : " . $e->getMessage();
            $GLOBALS['info']["type"] = "warning";
        }
    }

    public static function getNodes()
    {
        try {
            $sql = 'SELECT * FROM node;';
            $req = self::$pdo->query($sql);

            return $req;
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