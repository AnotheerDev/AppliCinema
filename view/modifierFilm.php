<?php
ob_start();
?>

<!-- Menu déroulant pour sélectionner un film -->
<form action="index.php?action=modifierFilm" method="post">
    <label for="film">Sélectionnez un film :</label>
    <select name="film" id="film">
        <option value="">SELECTIONNER UN FILM</option>
        <?php foreach ($films as $filmItem) : ?>
            <option value="<?= $filmItem['idFilm'] ?>"><?= $filmItem['titre'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Modifier">
</form>


<form action="index.php?action=modifierFilm" method="post" enctype="multipart/form-data">
    <?php if ($film) : ?>
        <h2>Modifier le film :</h2>

        <input type="hidden" name="idFilm" value="<?= $film['idFilm'] ?>">

        <label for="nom">titre :</label>
        <input type="text" name="titre" id="titre" value="<?= $film['titre'] ?>"><br>

        <label for="dateSortie">Date de sortie :</label>
        <input type="date" name="dateSortie" id="dateSortie" value="<?= $film['dateSortie'] ?>"><br>

        <label for="duree">Durée :</label>
        <input type="number" name="duree" id="duree" value="<?= $film['duree'] ?>"><br>

        <label for="synopsis">Synopsis :</label>
        <textarea name="synopsis" id="synopsis" maxlength="500" id="synopsis"><?= $film['synopsis'] ?> </textarea><br>

        <label for="note">Note :</label>
        <input type="number" name="note" id="note" value="<?= $film['note'] ?>"><br>

        <label for="file">Affiche du film</label>
        <input type="file" name="file"><br>

        <select name="idRealisateur" id="idRealisateur">
            <?php
            foreach ($requeteRealisateur->fetchAll() as $realisateur) {
                $selected = ($realisateur['idRealisateur'] == $film['idRealisateur']) ? 'selected' : '';
            ?>
                <option value="<?= $realisateur["idRealisateur"] ?>" <?= $selected ?>>
                    <?= $realisateur["idRealisateur"] ?><?= $realisateur["nom"] ?> <?= $realisateur["prenom"] ?>
                </option>
            <?php } ?>
        </select>


        <!-- Ajoutez les autres champs à modifier ici -->
        <input type="submit" name="modifier" value="Modifier">
    <?php endif; ?>
</form>


<?php

$content = ob_get_clean();
$title = "Modifier film";
require "template.php";
