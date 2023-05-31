<?php

use Controller\CinemaController;

spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

$ctrlCinema = new CinemaController();

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
    }
}
