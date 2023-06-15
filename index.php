<?php


// En utilisant prepare() et execute() avec une requête préparée, vous bénéficiez des avantages de la sécurité offerte par les requêtes préparées, même si la requête elle-même ne contient pas de paramètres dynamiques. ( injection sql)

// reste à faire : pouvoir tout éditer = fait
//                 que tout soit cliquable = fait 
//                 ajout de css = fait
//                 faire fonctionner le casting dans le details star/personne
//                  faire le remove
//                  ajouter les acteurs et roles dans les films = fait
//                  ajouter une vue avec les roles et les acteurs qui ont joué ces roles ( vue )
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
    }
}
