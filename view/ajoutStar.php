<?php
ob_start();
?>
<p>Ajouter une nouvelle personne : </p>

<form action="index.php?action=addPersonne" method="post">
    <input type="text" name="nom" maxlength="50" placeholder="Nom">
    <input type="text" name="prenom" maxlength="50" placeholder="Prenom">
    <input type="text" name="sexe" maxlength="5" placeholder="Genre">
    <input type="date" name="dateNaissance">
    <label for="acteur">Acteur :</label>
    <input type="checkbox" name="acteur" id="acteur">
    <label for="realisateur">Réalisateur :</label>
    <input type="checkbox" name="realisateur" id="realisateur">
    <input type="submit" name="submit" value="Ajouter">



    <?php

    $content = ob_get_clean();
    $title = "Ajout Star";
    require "template.php";
