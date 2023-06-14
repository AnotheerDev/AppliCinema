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

    public function addGenreFilm()
    {
        $pdo = Connect::seConnecter();
        $requeteFilms = $pdo->query("SELECT idFilm, titre FROM film;");
        $requeteGenres = $pdo->query("SELECT * FROM genre;");
        // Récupérer les valeurs du formulaire
        $idFilm = $_POST['film'];
        $genres = $_POST['genres'];

        // var_dump($_POST['film']);
        // var_dump($_POST['genres']);
        // die;

        // // Supprimer les genres existants pour le film donné
        $deleteQuery = "DELETE FROM genreFilm 
                        WHERE idFilm = :idFilm";
        $deleteStatement = $pdo->prepare($deleteQuery);
        $deleteStatement->bindParam(':idFilm', $idFilm);
        $deleteStatement->execute();

        // Insérer les nouveaux genres pour le film donné
        $insertQuery = "INSERT INTO genreFilm (idFilm, idGenre) 
                        VALUES (:idFilm, :idGenre)";
        $insertStatement = $pdo->prepare($insertQuery);
        $insertStatement->bindParam(':idFilm', $idFilm);
        $insertStatement->bindParam(':idGenre', $idGenre);

        // Parcourir les genres sélectionnés et les insérer dans la table genreFilm
        foreach ($genres as $idGenre) {
            $insertStatement->execute();
        }
        // Rediriger vers la page genre.php
        header("Location: index.php?action=genre");
        exit();
    }


    public function addGenre()
    {
        if (isset($_POST['submit'])) {
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // var_dump($nom);
            // die;
            if ($nom) {
                $pdo = Connect::seConnecter();
                $sqlQuery =  "INSERT INTO genre (nom)
                                VALUE (:nom)";

                $requete = $pdo->prepare($sqlQuery);
                $requete->execute([
                    'nom' => $nom
                ]);
            }
        }
        require 'view/ajoutGenre.php';
    }
}
