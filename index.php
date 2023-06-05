<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();
$id = (isset($_GET["id"])) ? $_GET["id"] : null;

if (isset($_GET["action"])) {
    switch ($_GET["action"]) {
        case "home":
            $ctrlCinema->showHome();
            break;

        case "films":
            $ctrlCinema->showFilms();
            break;

        case "stars":
            $ctrlCinema->showStars();
            break;

        case "filmDetails":
            $ctrlCinema->showFilmDetails($id);
            break;

        case "personneDetails":
            $ctrlCinema->showPersonneDetails($id);
            break;

        case "genre":
            $ctrlCinema->showGenre();
            break;

        case "genreDetails":
            $ctrlCinema->showGenreDetails($id);
            break;

        case "ajoutCasting":
            $ctrlCinema->showAjoutCasting();
            break;
    }
}
