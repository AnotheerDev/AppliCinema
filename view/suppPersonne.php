<?php
ob_start();
?>
<style>
    form {
        margin-bottom: 20px;
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
        background-color: red;
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


<!-- Menu déroulant pour sélectionner une personne -->
<form action="index.php?action=suppPersonne" method="post">
    <label for="personne">Sélectionnez une personne :</label>
    <select name="personne" id="personne">
        <option value="">SELECTIONNER UNE PERSONNE</option>
        <?php foreach ($personnes as $personneItem) : ?>
            <option value="<?= $personneItem['idPersonne'] ?>"><?= $personneItem['nom'] ?> <?= $personneItem['prenom'] ?></option>
        <?php endforeach; ?>
    </select><br>
    <input type="submit" value="SUPPRIMER DEFINITIVEMENT LA PERSONNE">
</form>

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
$title = "Suppression de personne";
require "template.php";
