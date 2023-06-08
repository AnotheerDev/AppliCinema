<?php

namespace Controller;

use Model\Connect;

class GenreController
{

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
}
