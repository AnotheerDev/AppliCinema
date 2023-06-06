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

        // Logique pour obtenir les détails du genre à partir de l'ID
        $pdo = Connect::seConnecter();
        $requeteGenre = $pdo->prepare("
            SELECT *
            FROM genre
            WHERE genre.idGenre = :id
        ");
        $requeteGenre->bindParam(':id', $id, \PDO::PARAM_INT);
        $requeteGenre->execute();
        $genre = $requeteGenre->fetch();

        // Logique pour obtenir les identifiants des films du genre spécifié
        $requeteFilms = $pdo->prepare("
            SELECT film.idFilm
            FROM genreFilm
            INNER JOIN film ON genreFilm.idFilm = film.idFilm
            WHERE idGenre = :id
        ");
        $requeteFilms->bindParam(':id', $id, \PDO::PARAM_INT);
        $requeteFilms->execute();
        $filmIds = $requeteFilms->fetchAll(\PDO::FETCH_COLUMN);

        // Afficher la vue des détails
        require 'view/genreDetails.php';
    }


    public function showAjoutStar()
    {
        require 'view/ajoutStar.php';
    }


    public function addPersonne()
    {
        if (isset($_POST['submit'])) {
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "date_naissance", FILTER_SANITIZE_NUMBER_INT);

            if ($nom && $prenom && $sexe && $dateNaissance) {
                $pdo = Connect::seConnecter();
                $sqlQuery =  "INSERT INTO personne (nom, prenom, sexe, dateNaissance)
                                VALUES (:nom, :prenom, :sexe, :dateNaissance)";

                $requete = $pdo->prepare($sqlQuery);
                $requete->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'sexe' => $sexe,
                    'dateNaissance' => $dateNaissance
                ]);
            }
        }

        self::showAjoutStar();
    }
}
