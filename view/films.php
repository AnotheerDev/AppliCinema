<?php
ob_start();
?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>

<div class="film-container">
    <?php
    foreach ($requete->fetchAll() as $film) { ?>
        <a href="index.php?action=filmDetails&id=<?= $film["idFilm"] ?>">
            <div class="film-card">
                <p class="film-title"><?= $film["titre"] ?></p>
                <img class="film-affiche" src="<?= $film["afficheFilm"] ?>">
                <p class="film-year"><?= date('Y', strtotime($film["dateSortie"])) ?></p>
            </div>
        </a>
    <?php } ?>
</div>


<?php

$content = ob_get_clean();
$title = "films";
require "template.php";
?>