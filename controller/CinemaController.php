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






}