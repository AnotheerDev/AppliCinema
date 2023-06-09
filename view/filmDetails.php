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
    <img src="<?= $film['afficheFilm'] ?>">
    <p>Date de sortie : <?= $film['dateSortie'] ?></p>
    <p>Durée : <?= $film['duree'] ?> minutes</p>
    <p>Synopsis : <?= $film['synopsis'] ?></p>
    <p>Note : <?= $film['note'] ?></p>
    <p>Réalisateur : <a href="index.php?action=personneDetails&id=<?= $film["idPersonne"] ?>"><?= $film['nom'] ?></a></p>

    <div class="divFilm">Casting : <br>
        <?php
        // boucle pour afficher les castings du films
        foreach ($requeteCasting->fetchAll() as $casting) { ?>
            <a href='index.php?action=roleDetails&id=<?= $casting['idRole'] ?>'><?= $casting["nom"] ?></a> joué par : <a href='index.php?action=personneDetails&id=<?= $casting['idPersonne'] ?>'><?= $casting["acteur"] ?></a><br>
        <?php
        }
        ?></div>
</div>

<?php
$content = ob_get_clean();
$title = "Détails film";
require "template.php";
?>