<?php
ob_start();
?>


<p>Ajouter une nouvelle personne : </p>

<form action="index.php?action=addPersonne" method="post">
    <input type="text" name="nom" maxlength="50" placeholder="Nom"><br>
    <input type="text" name="prenom" maxlength="50" placeholder="Prenom"><br>
    <input type="text" name="sexe" maxlength="5" placeholder="Genre"><br>
    <input type="date" name="dateNaissance"><br>
    <label for="acteur">Acteur :</label>
    <input type="checkbox" name="acteur" id="acteur">
    <label for="realisateur">Réalisateur :</label>
    <input type="checkbox" name="realisateur" id="realisateur"><br>
    <input type="submit" name="submit" value="Ajouter">
</form>


<div>
    <p>Ajouter un nouveau rôle : </p>

    <form action="index.php?action=addRole" method="post">
        <input type="text" name="nomRole" maxlength="50" placeholder="Rôle">
        <input type="submit" name="submit" value="Ajouter">
    </form>
</div>

<?php

if (isset($_SESSION['messageSucces'])) {
    echo $_SESSION['messageSucces'];
    unset($_SESSION['messageSucces']);
}

if (isset($_SESSION['messageAlert'])) {
    echo $_SESSION['messageAlert'];
    unset($_SESSION['messageAlert']);
}

$content = ob_get_clean();
$title = "Ajout Star";
require "template.php";
