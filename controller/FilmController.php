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


    public function modifierFilm()
    {
        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT *
            FROM film
        ");
        $requete->execute();
        $films = $requete->fetchAll(\PDO::FETCH_ASSOC);
        $requeteRealisateur = $pdo->query("SELECT r.idRealisateur, p.nom, p.prenom
        FROM realisateur r
        JOIN personne p ON r.idPersonne = p.idPersonne;");

        $film = null; // Initialise la variable $film à null
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
            $idFilm = filter_input(INPUT_POST, "idFilm", FILTER_SANITIZE_NUMBER_INT);
            $titre = filter_input(INPUT_POST, "titre", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateSortie = filter_input(INPUT_POST, "dateSortie", FILTER_SANITIZE_NUMBER_INT);
            $duree = filter_input(INPUT_POST, "duree", FILTER_SANITIZE_NUMBER_INT);
            $synopsis = filter_input(INPUT_POST, "synopsis", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $note = filter_input(INPUT_POST, "note", FILTER_SANITIZE_NUMBER_INT);
            $idRealisateur = filter_input(INPUT_POST, "idRealisateur", FILTER_SANITIZE_NUMBER_INT);


            if (isset($_FILES['file'])) {
                // Récupère les informations du fichier téléchargé
                $tmpName = $_FILES['file']['tmp_name'];
                $name = $_FILES['file']['name'];
                $size = $_FILES['file']['size'];
                $error = $_FILES['file']['error'];
                $type = $_FILES['file']['type'];

                // Récupère l'extension du fichier
                $tabExtension = explode('.', $name);
                $extension = strtolower(end($tabExtension));

                // Liste des extensions autorisées
                $extensionAutorised = ['jpg', 'jpeg', 'gif', 'png'];

                // Taille maximale autorisée en octets
                $maxSize = 1000000000;

                // Vérifie si l'extension du fichier est autorisée, que la taille est inférieure à la limite et qu'il n'y a pas d'erreur lors du téléchargement
                if (in_array($extension, $extensionAutorised) && $size <= $maxSize && $error == 0) {

                    // Génère un nom unique pour le fichier
                    $uniqueName = uniqid('', true);
                    $fileName = $uniqueName . '.' . $extension;

                    // Déplace le fichier téléchargé vers un dossier spécifié
                    move_uploaded_file($tmpName, './public/upload/' . $fileName);
                } else {
                    // Affiche un message d'erreur si les conditions ne sont pas remplies
                    echo "un problème est survenu";
                }
                if ($fileName) {
                    $afficheFilm = "./public/upload/'.$fileName";
                }
            }
            // var_dump($_FILES);
            // die;
            // var_dump($_POST);
            // die;
            // Effectuer les opérations de modification en utilisant les valeurs récupérées
            $requeteModification = $pdo->prepare("
                UPDATE film
                SET titre = :titre, dateSortie = :dateSortie, duree = :duree, synopsis = :synopsis, note = :note, idRealisateur = :idRealisateur, afficheFilm = :afficheFilm
                WHERE idFilm = :idFilm
            ");

            // var_dump("UPDATE film
            // SET titre = $titre, dateSortie = $dateSortie, duree = $duree, synopsis = $synopsis, note = $note, idRealisateur = $idRealisateur, afficheFilm = $afficheFilm
            // WHERE idFilm = $idFilm");
            // die;

            $requeteModification->bindParam(':titre', $titre);
            $requeteModification->bindParam(':dateSortie', $dateSortie);
            $requeteModification->bindParam(':duree', $duree);
            $requeteModification->bindParam(':synopsis', $synopsis);
            $requeteModification->bindParam(':note', $note);
            $requeteModification->bindParam(':afficheFilm', $afficheFilm);
            $requeteModification->bindParam(':idRealisateur', $idRealisateur);
            $requeteModification->bindParam(':idFilm', $idFilm);
            $requeteModification->execute();

            // Afficher un message de succès ou rediriger vers une page de confirmation
            echo "Les informations ont été modifiées avec succès.";
            // header("Location: index.php?action=filmDetails&id=$idFilm");
            // exit();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['film'])) {
            $idFilm = $_POST['film'];

            // Effectuer une requête pour récupérer les informations du film sélectionné par son id
            $requeteFilm = $pdo->prepare("
                SELECT *
                FROM film
                WHERE idFilm = :idFilm
            ");
            $requeteFilm->bindParam(':idFilm', $idFilm);
            $requeteFilm->execute();
            $film = $requeteFilm->fetch(\PDO::FETCH_ASSOC);
        }

        require "view/modifierFilm.php";
    }
}
