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



    // ajouter le fait de pouvoir add des genres à un film ( un film peut posseder plusieurs genre) avec des checkbox



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
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_NUMBER_INT);
            $estActeur = isset($_POST['acteur']);
            $estRealisateur = isset($_POST['realisateur']);

            if ($nom && $prenom && $sexe && $dateNaissance) {
                $pdo = Connect::seConnecter();
                $sqlQuery = "INSERT INTO personne (nom, prenom, sexe, dateNaissance)
                                VALUES (:nom, :prenom, :sexe, :dateNaissance)";

                $requete = $pdo->prepare($sqlQuery);
                $requete->execute([
                    'nom' => $nom,
                    'prenom' => $prenom,
                    'sexe' => $sexe,
                    'dateNaissance' => $dateNaissance
                ]);

                $idPersonne = $pdo->lastInsertId(); // Récupère l'ID de la personne insérée

                if ($estActeur) {
                    $sqlQueryActeur = "INSERT INTO acteur (idPersonne)
                                        VALUES (:idPersonne)";

                    $requeteActeur = $pdo->prepare($sqlQueryActeur);
                    $requeteActeur->execute([
                        'idPersonne' => $idPersonne
                    ]);
                }

                if ($estRealisateur) {
                    $sqlQueryRealisateur = "INSERT INTO realisateur (idPersonne)
                                            VALUES (:idPersonne)";

                    $requeteRealisateur = $pdo->prepare($sqlQueryRealisateur);
                    $requeteRealisateur->execute([
                        'idPersonne' => $idPersonne
                    ]);
                }
            }
        }

        self::showAjoutStar();
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


    public function addRole()
    {
        if (isset($_POST['submit'])) {
            $nom = filter_input(INPUT_POST, "nomRole", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // var_dump($nom);
            // die;
            if ($nom) {
                $pdo = Connect::seConnecter();
                $sqlQuery =  "INSERT INTO role (nom)
                                VALUE (:nom)";

                $requete = $pdo->prepare($sqlQuery);
                $requete->execute([
                    'nom' => $nom
                ]);
            }
        }
        self::showAjoutStar();
    }
}
