<?php

namespace Controller;

use Model\Connect;

class HomeController
{
    public function showHome()
    {
        // Logique pour afficher la vue "home"
        include 'view/home.php';
    }
}
