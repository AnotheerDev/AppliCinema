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
}