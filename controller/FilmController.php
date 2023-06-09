<?php

namespace Controller;

use Model\Connect;

class FilmController
{
    public function showFilms()
    {
        $pdo = Connect::seConnecter();
        // var_dump($pdo);
        //die;  
        $requete = $pdo->prepare("
            SELECT titre, dateSortie, idFilm
            FROM film
        ");
        $requete->execute();
        require "view/films.php";
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


    public function addFilm()
    {
        $pdo = Connect::seConnecter();
        $requeteRealisateur = $pdo->query("SELECT r.idRealisateur, p.nom, p.prenom
        FROM realisateur r
        JOIN personne p ON r.idPersonne = p.idPersonne;");
        $requeteFilms = $pdo->query("SELECT idFilm, titre FROM film;");
        $requeteGenres = $pdo->query("SELECT * FROM genre;");

        if (isset($_POST['submit'])) {
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateSortie = filter_input(INPUT_POST, "dateSortie", FILTER_SANITIZE_NUMBER_INT);
            $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);
            $idRealisateur = filter_input(INPUT_POST, "idRealisateur", FILTER_SANITIZE_NUMBER_INT);

            // var_dump($_POST);
            // die;
            // faire après le if pour voir si on passe la condition
            if ($titre && $dateSortie && $duree && $synopsis && $note && $idRealisateur) {
                $sqlQuery =  "INSERT INTO film (titre ,dateSortie ,synopsis ,duree ,note ,idRealisateur)
                                VALUES (:titre, :dateSortie, :synopsis, :duree, :note, :idRealisateur)";

                $requete = $pdo->prepare($sqlQuery);
                $requete->execute([
                    'titre' => $titre,
                    'dateSortie' => $dateSortie,
                    'synopsis' => $synopsis,
                    'duree' => $duree,
                    'note' => $note,
                    'idRealisateur' => $idRealisateur,
                ]);
            }
        }
        require 'view/ajoutFilm.php';
    }
}
