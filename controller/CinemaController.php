<?php

namespace Controller;
use Model\Connect;

class CinemaController {


    public function showHome() {
        // Logique pour afficher la vue "home"
        include 'view/home.php';
    }

    public function showFilms() {
        // Logique pour afficher la vue "films"
        include 'view/films.php';
    }


    public function listFilms() {
        $pdo = Connect::seConnecter();
        $requete = $pdo -> query("
            SELECT titre, dateSortie
            FROM film
        ");
        require "view/films.php";
    }






}