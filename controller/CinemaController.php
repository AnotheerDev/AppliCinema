<?php

namespace Controller;

use Model\Connect;

class CinemaController
{

    // En utilisant prepare() et execute() avec une requête préparée, vous bénéficiez des avantages de la sécurité offerte par les requêtes préparées, même si la requête elle-même ne contient pas de paramètres dynamiques. ( injection sql)

    public function showHome()
    {
        // Logique pour afficher la vue "home"
        include 'view/home.php';
    }


    public function showFilms()
    {
        $pdo = Connect::seConnecter();
        // var_dump($pdo);die;  
        $requete = $pdo->prepare("
            SELECT titre, dateSortie, idFilm
            FROM film
        ");
        $requete->execute();
        require "view/films.php";
    }


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



    public function showFilmDetails($id)
    {
        // Valider et filtrer l'ID pour éviter les attaques par injection SQL
        $id = filter_var($id, FILTER_VALIDATE_INT);
        // if (!$id) {
        //     // Gérer l'erreur si l'ID n'est pas valide
        //     // Par exemple, rediriger vers une page d'erreur
        //     header("Location: home.php"); // ajouter une page error.php
        //     exit;

        // Logique pour obtenir les détails du film à partir de l'ID
        $pdo = Connect::seConnecter();
        $requete = $pdo->prepare("
            SELECT * , CONCAT(prenom, ' ', nom) AS nom
            FROM film
            INNER JOIN realisateur ON film.idRealisateur = realisateur.idRealisateur
            INNER JOIN personne ON realisateur.idPersonne = personne.idPersonne
            WHERE idFilm = :id
        ");
        $requete->bindParam(':id', $id, \PDO::PARAM_INT);
        $requete->execute();
        $film = $requete->fetch();
        // $data = [
        //     'film' => $film
        // ];

        // Afficher la vue des détails du film
        require 'view/filmDetails.php';
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

    public function showGenre()
    {
        $pdo = Connect::seConnecter();
        // var_dump($pdo);die;  
        $requete = $pdo->prepare("
            SELECT *
            FROM genre
        ");
        $requete->execute();
        require "view/genre.php";
    }


    public function showGenreDetails($id)
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
                FROM genre
                WHERE genre.idGenre = :id
            ");
        $requete->bindParam(':id', $id, \PDO::PARAM_INT);
        $requete->execute();
        $genre = $requete->fetch();


        // Afficher la vue des détails
        require 'view/genreDetails.php';
    }
}
