<?php
ob_start();
?>

<style>
    h2 {
        font-size: 24px;
        margin-bottom: 10px;
    }

    p {
        font-size: 18px;
        margin-bottom: 5px;
    }

    .film-details {
        margin-top: 20px;
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 5px;
    }

    .film-details p:last-child {
        margin-bottom: 0;
    }
</style>

<div class="film-details">
    <h2><?= $film['titre'] ?></h2>
    <p>Date de sortie : <?= $film['dateSortie'] ?></p>
    <p>Durée : <?= $film['duree'] ?> minutes</p>
    <p>Synopsis : <?= $film['synopsis'] ?></p>
    <p>Note : <?= $film['note'] ?></p>
    <p>Réalisateur : <?= $film['nom'] ?></p>
</div>

<?php
$content = ob_get_clean();
$title = "Détails film";
require "template.php";
?>