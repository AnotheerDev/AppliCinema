<?php

namespace Controller;

use Model\Connect;

class PersonneController
{


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
