<?php

namespace Controller;
use Model\Connect;

class CinemaController {

    // En utilisant prepare() et execute() avec une requête préparée, vous bénéficiez des avantages de la sécurité offerte par les requêtes préparées, même si la requête elle-même ne contient pas de paramètres dynamiques. ( injection sql)

    public function showHome() {
        // Logique pour afficher la vue "home"
        include 'view/home.php';
    }


    public function showFilms() {
        $pdo = Connect::seConnecter();
        // var_dump($pdo);die;  
        $requete = $pdo -> prepare("
            SELECT titre, dateSortie
            FROM film
        ");
        $requete->execute();
        require "view/films.php";
    }


    public function showStars() {
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT CONCAT(prenom, ' ', nom) AS nom
            FROM personne
        ");
        $requete->execute();
        require 'view/stars.php';
    }
    


    public function showFilmDetails($id) {
        // Logique pour obtenir les détails du film à partir de l'ID
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT *
            FROM film
            WHERE id = :id
        ");
        $requete->execute();
        // Afficher la vue des détails du film
        require 'view/filmDetails.php';
    }

}