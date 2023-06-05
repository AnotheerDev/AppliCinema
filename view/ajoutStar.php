<?php
ob_start();
?>
<p>Ajouter une nouvelle personne : </p>

<form action="index.php?action=addPersonne" method="post">
    <div>
        <input type="text" name="nom" maxlength="50" placeholder="Nom">
    </div>
    <div>
        <input type="text" name="prenom" maxlength="50" placeholder="Prenom">
    </div>
    <div>
        <input type="text" name="sexe" maxlength="5" placeholder="Genre">
    </div>
    <div>
        <input type="date" name="dateNaissance">
    </div>
    <div>
        <input type="submit" name="submit" value="Ajouter">
    </div>




    <?php

    $content = ob_get_clean();
    $title = "Ajout Star";
    require "template.php";
