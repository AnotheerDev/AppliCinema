<?php
ob_start();
?>

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
