<?php

namespace Controller;

use Model\Connect;

class PersonneController
{


    public function showStars()
    {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT CONCAT(prenom, ' ', nom) AS nom , idPersonne
            FROM personne
        ");
        $requete->execute();
        require 'view/stars.php';
    }


    public function showPersonneDetails($id)
    {
        // Valider et filtrer l'ID pour éviter les attaques par injection SQL
        $id = filter_var($id, FILTER_VALIDATE_INT);
        // if (!$id) {
        //     // Gérer l'erreur si l'ID n'est pas valide
        //     // Par exemple, rediriger vers une page d'erreur
        //     header("Location: home.php"); // ajouter une page error.php
        //     exit;

        // Logique pour obtenir les détails du  à partir de l'ID
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
                SELECT * 
                FROM personne
                LEFT JOIN realisateur ON personne.idPersonne = realisateur.idPersonne
                LEFT JOIN acteur ON personne.idPersonne = acteur.idPersonne
                WHERE personne.idPersonne = :id
            ");
        $requete->bindParam(':id', $id, \PDO::PARAM_INT);
        $requete->execute();
        $personne = $requete->fetch();

        // Afficher la vue des détails
        require 'view/personneDetails.php';
    }
}
