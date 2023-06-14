<?php
ob_start();
?>

<style>
    form {
        margin-bottom: 20px;
        background-color: #f7f7f7;
        padding: 20px;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    select {
        padding: 5px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    input[type="submit"] {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .success-message {
        color: green;
        margin-bottom: 10px;
    }

    .error-message {
        color: red;
        margin-bottom: 10px;
    }
</style>

<p>Ajouter une nouvelle personne : </p>

<form action="index.php?action=addPersonne" method="post">
    <input type="text" name="nom" maxlength="50" placeholder="Nom"><br>
    <input type="text" name="prenom" maxlength="50" placeholder="Prenom"><br>
    <label for="sexe">Sexe :</label>
    <select name="sexe" id="sexe">
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
        <option value="Non Binaire">Non Binaire</option>
    </select><br>
    <label for="acteur">Date de naissance :</label>
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
