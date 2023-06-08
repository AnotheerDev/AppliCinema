<?php

use Controller\CinemaController;
use Controller\FilmController;
use Controller\GenreController;
use Controller\PersonneController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$ctrlFilm = new FilmController();
$ctrlPersonne = new PersonneController();
$ctrlGenre = new GenreController();

$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "home":
            $ctrlCinema->showHome();
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

        case "genre":
            $ctrlGenre->showGenre();
            break;

        case "genreDetails":
            $ctrlGenre->showGenreDetails($id);
            break;

        case "ajoutStar":
            $ctrlCinema->showAjoutStar();
            break;

        case "addPersonne":
            $ctrlCinema->addPersonne();
            break;

        case "addFilm":
            $ctrlCinema->addFilm();
            break;

        case "addRole":
            $ctrlCinema->addRole();
            break;

        case "addGenreFilm":
            $ctrlCinema->addGenreFilm();
            break;
    }
}
