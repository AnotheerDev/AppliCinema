<?php
ob_start();
?>


<p>Ajouter un nouveau film</p>

<form action="index.php?action=addFilm" method="post">
    <div>
        <label for="titre"></label>
        <input type="text" name="titre" maxlength="50" placeholder="Titre" required>
    </div>
    <div>
        <label for="date_sortie"></label>
        <input type="date" name="dateSortie" placeholder="Date de Sortie">
    </div>
    <div>
        <label for="synopsis"></label>
        <textarea name="synopsis" maxlength="500" placeholder="Synopsis"></textarea>
    </div>
    <div>
        <label for="duree"></label>
        <input type="number" name="duree" placeholder="Durée">
    </div>
    <div>
        <label for="note"></label>
        <input type="number" name="note" placeholder="Note">
    </div>
    <div>
        <select name="idRealisateur">
        <option value="">SELECTIONNER UN REALISATEUR</option>
            <?php
            foreach ($requeteRealisateur->fetchAll() as $realisateur) { ?>
                <option value="<?= $realisateur["idRealisateur"] ?>">
                    <?= $realisateur["idRealisateur"] ?><?= $realisateur["nom"] ?> <?= $realisateur["prenom"] ?>
                </option>
            <?php } ?>
        </select>
    </div>  
    <div>
        <input type="submit" name="submit" value="Ajouter">
    </div>
</form>

<form action="index.php?action=addGenreFilm" method="post">
    <div>
        <label for="film">Film :</label><br>
        <select name="film" required>
            <option value="">Sélectionner un film</option>
            <?php
            // Faire une requête pour obtenir la liste des films

            foreach ($requeteFilms->fetchAll() as $film) { ?>
                <option value="<?= $film["idFilm"] ?>">
                    <?= $film["titre"] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <div>
        <label for="genres">Genres :</label><br>
        <?php
        // Faire une requête pour obtenir la liste des genres

        foreach ($requeteGenres->fetchAll() as $genre) { ?>
            <input type="checkbox" name="genres[]" value="<?= $genre["idGenre"] ?>">
            <?= $genre["nom"] ?><br>
        <?php } ?>
    </div>

    <div>
        <input type="submit" name="submit" value="Ajouter">
    </div>
</form>
<?php

$content = ob_get_clean();
$title = "Ajout Film";
require "template.php";
