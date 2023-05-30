<?php

namespace Model;

abstract class Connect{

    // Hôte de la base de données
    const HOST = "localhost";
    // Nom de la base de données
    const DB = "cinema";
    // Nom d'utilisateur de la base de données
    const USER = "root";
    // Mot de passe de la base de données ( vide puisque pas de pass)
    const PASS = "";


    // function pour se connecter à la BDD
    public static function seConnecter(){
        // Retourne une instance PDO en cas de connexion réussie
        try {
            return new \PDO(
                "mysql:host=" . self::HOST . ";dbname=" . self::DB . ";charset=utf8",
                self::USER,
                self::PASS
            );
        // Ou un message d'erreur sous forme de chaîne de caractères en cas d'échec
        } catch (\PDOException $ex) {
            return $ex->getMessage();
        }
    }
}
