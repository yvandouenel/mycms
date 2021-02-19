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
        try {
            $data = [
                'nid' => $_POST['nid'],
                'title' => $_POST['title'],
                'seo_title' => $_POST['seo_title'],
                'body' => $_POST['body'],
                'path' => $_POST['path'],
            ];

            $req = self::$pdo->prepare('UPDATE node SET 
                title = :title, seo_title = :seo_title, seo_title = :seo_title, body = :body, path = :path   
                WHERE nid = :nid');
            $req->execute($data);

        } catch (PDOException $e) {
            echo "Pb de requête", $e->getMessage();
        }
    }


}