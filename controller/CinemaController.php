<?php

namespace Controller;
use Model\Connect;

class CinemaController {


    public function showHome() {
        // Logique pour afficher la vue "home"
        include 'view/home.php';
    }


    public function showFilms() {
        $pdo = Connect::seConnecter();
        // var_dump($pdo);die;  
        $requete = $pdo -> query("
            SELECT titre, dateSortie
            FROM film
        ");
        require "view/films.php";
    }


    public function showStars() {
        // Logique pour afficher la vue "home"
        $pdo = Connect::seConnecter();
        $requete = $pdo -> query("
            SELECT CONCAT (prenom,' ', nom) as nom
            FROM personne
        ");
        require 'view/stars.php';
    }




}