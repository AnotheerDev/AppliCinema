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

            $_SESSION["errors"] = [];

            ($nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ? false : $_SESSION['errors'][] = "Le nom est incorrecte";
            ($prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS)) ? false : $_SESSION['errors'][] = "Le prénom est incorrecte";
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            ($dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_NUMBER_INT)) ? false : $_SESSION['errors'][] = "La date de naissance est incorrecte";
            $estActeur = isset($_POST['acteur']);
            $estRealisateur = isset($_POST['realisateur']);


                // Vérifier si le sexe est valide (Homme ou Femme)
            if (!in_array($sexe, ['Homme', 'Femme', 'Non Binaire'])) {
                $_SESSION['errors'][] = "Le sexe doit être 'Homme' ou 'Femme' ou 'Non Binaire' ";
            }

            elseif ($nom && $prenom && $sexe && $dateNaissance) {
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

                $_SESSION['messageSucces'] = 'La personne ' . $nom . ' ' . $prenom . ' a bien été ajoutée !';
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
            } else {
                if (isset($_SESSION["errors"])) {
                    foreach ($_SESSION["errors"] as $error) {
                        $_SESSION['messageAlert'][] = $error;
                    }
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
                $_SESSION['messageSucces'] = 'Le rôle ' . $nom . ' a bien été ajouté !';
                // var_dump($nom);
                // die;
            
            } else {
            $_SESSION['messageAlert'] = 'Le rôle ne peut pas être ajouté !';
        }
    }
        self::showAjoutStar();
    }


    public function castingDetails()
    {
        $pdo = Connect::seConnecter();

        $requeteFilms = $pdo->query("
            SELECT *
            FROM film
        ");
        $films = $requeteFilms->fetchAll(\PDO::FETCH_ASSOC);

        $requete = $pdo->query("
            SELECT f.titre, CONCAT(p.nom,' ', p.prenom) AS nom, r.nom as roleNom, p.idPersonne, f.idFilm
            FROM casting c
            INNER JOIN film f ON c.idFilm = f.idFilm
            INNER JOIN acteur a ON c.idActeur = a.idActeur
            INNER JOIN role r ON c.idRole = r.idRole
            INNER JOIN personne p ON c.idActeur = p.idPersonne
        ");

        require "view/casting.php";
    }


    public function modifierPersonne()
    {
        $pdo = Connect::seConnecter();

        $requete = $pdo->prepare("
            SELECT *
            FROM personne
        ");
        $requete->execute();
        $personnes = $requete->fetchAll(\PDO::FETCH_ASSOC);

        // var_dump($_POST);
        // die;

        $personne = null; // Initialise la variable $personne à null
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['modifier'])) {
            $idPersonne = filter_input(INPUT_POST, "personne", FILTER_SANITIZE_NUMBER_INT);
            $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $prenom = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $sexe = filter_input(INPUT_POST, "sexe", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $dateNaissance = filter_input(INPUT_POST, "dateNaissance", FILTER_SANITIZE_NUMBER_INT);

            // Effectuer les opérations de modification en utilisant les valeurs récupérées
            $requeteModification = $pdo->prepare("
                UPDATE personne
                SET nom = :nom, prenom = :prenom, sexe = :sexe, dateNaissance = :dateNaissance
                WHERE idPersonne = :idPersonne
            ");
            $requeteModification->bindParam(':nom', $nom);
            $requeteModification->bindParam(':prenom', $prenom);
            $requeteModification->bindParam(':sexe', $sexe);
            $requeteModification->bindParam(':dateNaissance', $dateNaissance);
            $requeteModification->bindParam(':idPersonne', $idPersonne);
            $requeteModification->execute();

            // Afficher un message de succès ou rediriger vers une page de confirmation
            echo "Les informations ont été modifiées avec succès.";
            // Rediriger vers la page personneDetails.php
            header("Location: index.php?action=personneDetails&id=$idPersonne");
            exit();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['personne'])) {
            $idPersonne = $_POST['personne'];

            // Effectuer une requête pour récupérer les informations de la personne sélectionnée par son id
            $requetePersonne = $pdo->prepare("
                SELECT *
                FROM personne
                WHERE idPersonne = :idPersonne
            ");
            $requetePersonne->bindParam(':idPersonne', $idPersonne);
            $requetePersonne->execute();
            $personne = $requetePersonne->fetch(\PDO::FETCH_ASSOC);
        }
        require "view/modifierPersonne.php";
        exit();
    }
}
