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

<!-- Menu déroulant pour sélectionner un film -->
<form action="index.php?action=addCasting" method="post">
    <div>
        <label for="film">Sélectionnez un film :</label>
        <select name="film" id="film">
            <option value="">SELECTIONNER UN FILM</option>
            <?php foreach ($requeteFilms->fetchAll() as $filmItem) : ?>
                <option value="<?= $filmItem['idFilm'] ?>"><?= $filmItem['titre'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>



    <!-- Menu déroulant pour sélectionner une personne -->
    <div>
        <label for="acteur">Sélectionnez un acteur :</label>
        <select name="acteur" id="acteur">
            <option value="">SELECTIONNER UN ACTEUR</option>
            <?php foreach ($requeteActeurs->fetchAll() as $acteurItem) : ?>
                <option value="<?= $acteurItem['idActeur'] ?>"><?= $acteurItem['nom'] ?> <?= $acteurItem['prenom'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>


    <!-- Menu déroulant pour sélectionner un role -->

    <div>
        <label for="role">Sélectionnez un role :</label>
        <select name="role" id="role">
            <option value="">SELECTIONNER UN ROLE</option>
            <?php foreach ($requeteRoles->fetchAll() as $roleItem) : ?>
                <option value="<?= $roleItem['idRole'] ?>"><?= $roleItem['nom'] ?></option>
            <?php endforeach; ?>
        </select>
    </div>

    <div>
        <input type="submit" name="submit" value="Modifier">
    </div>

</form>

<?php

$content = ob_get_clean();
$title = "Ajout Casting";
require "template.php";
