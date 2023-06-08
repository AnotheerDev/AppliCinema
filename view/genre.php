<?php
ob_start();
?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> genres :</p>

<table class="uk-label uk-label-stripped">
    <thead>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($requete->fetchAll() as $genre) { ?>
            <tr>
                <td><a href="index.php?action=genreDetails&id=<?= $genre["idGenre"] ?>"><?= $genre["nom"] ?></a></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<form>
    <div>
        <label for="film">Film :</label><br>
        <select name="film" required>
            <option value="">Sélectionner un film</option>
            <?php
            // Faire une requête pour obtenir la liste des films
            $requeteFilms = $pdo->query("SELECT idFilm, titre FROM film;");
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
        $requeteGenres = $pdo->query("SELECT * FROM genre;");
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
$title = "Genre";
require "template.php";
