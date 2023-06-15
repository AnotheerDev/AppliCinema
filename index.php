<?php


// En utilisant prepare() et execute() avec une requête préparée, vous bénéficiez des avantages de la sécurité offerte par les requêtes préparées, même si la requête elle-même ne contient pas de paramètres dynamiques. ( injection sql)

// Pour la suppression j'ai modifié dans la BDD pour que si je supprime une personnne(idPersonne) ça supprimer aussi son idActeur ou idRealisateur si il en a un pour se faire j'ai  été dans la BDD et clé étrangère et " lors d'un DELETE " mettre sur CASCADE
// par contre pour réalisateur pour que ça ne supprime pas les films qui lui sont liés j'ai été dans la BDD pour la clé étrangère de film et " lors d'un DELETE " mettre sur SET NULL

// reste à faire : pouvoir tout éditer = fait
//                 que tout soit cliquable = fait 
//                 ajout de css = fait
//                 faire fonctionner le casting dans le details star/personne = fait 
//                  faire le remove = fait 
//                  ajouter les acteurs et roles dans les films = fait
//                  ajouter une vue avec les roles et les acteurs qui ont joué ces roles ( vue ) = fait
//                  Quentin me dit plus de css et de mettre dans la vue role les films dans lequel l'acteur à joué ce role
use Controller\HomeController;
use Controller\FilmController;
use Controller\GenreController;
use Controller\PersonneController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});
session_start();

$ctrlHome = new HomeController();
$ctrlFilm = new FilmController();
$ctrlPersonne = new PersonneController();
$ctrlGenre = new GenreController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "home":
            $ctrlHome->showHome();
            break;

        case "films":
            $ctrlFilm->showFilms();
            break;

        case "filmDetails":
            $ctrlFilm->showFilmDetails($id);
            break;

        case "stars":
            $ctrlPersonne->showStars();
            break;

        case "personneDetails":
            $ctrlPersonne->showPersonneDetails($id);
            break;

        case "ajoutStar":
            $ctrlPersonne->showAjoutStar();
            break;

        case "addPersonne":
            $ctrlPersonne->addPersonne();
            break;

        case "addRole":
            $ctrlPersonne->addRole();
            break;

        case "genre":
            $ctrlGenre->showGenre();
            break;

        case "genreDetails":
            $ctrlGenre->showGenreDetails($id);
            break;

        case "addGenreFilm":
            $ctrlGenre->addGenreFilm();
            break;


        case "addFilm":
            $ctrlFilm->addFilm();
            break;


        case "casting":
            $ctrlPersonne->castingDetails();
            break;


        case "modifierPersonne":
            $ctrlPersonne->modifierPersonne();
            break;


        case "modifierFilm":
            $ctrlFilm->modifierFilm();
            break;


        case "addGenre":
            $ctrlGenre->addGenre();
            break;


        case "addCasting":
            $ctrlFilm->addCasting();
            break;


        case "roleDetails":
            $ctrlFilm->roleDetails($id);
            break;


        case "suppPersonne":
            $ctrlPersonne->suppPersonne();
            break;
    }
}
