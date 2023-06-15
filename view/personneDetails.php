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

    .person-details {
        margin-top: 20px;
        padding: 20px;
        background-color: #f7f7f7;
        border-radius: 5px;
    }

    .person-details p:last-child {
        margin-bottom: 0;
    }
</style>

<div class="person-details">
    <h2><?= $personne['nom'] ?> <?= $personne['prenom'] ?></h2>
    <img src="public/upload/561836.jpg-c_310_420_x-f_jpg-q_x-xxyxx.jpg">
    <p>Est un(e) : <?= $personne['sexe'] ?></p>
    <p>Né(e) le : <?= date('d / m / Y', strtotime($personne['dateNaissance'])) ?></p>
    <p>Est un(e) :
        <?php if ($personne['idRealisateur'] && $personne['idActeur']) : ?>
            Acteur et réalisateur
        <?php elseif ($personne['idRealisateur']) : ?>
            Réalisateur
        <?php elseif ($personne['idActeur']) : ?>
            Acteur
        <?php else : ?>
            Aucun rôle spécifié
        <?php endif; ?>
    </p>
</div>

<?php
$content = ob_get_clean();
$title = "Détails personne";
require "template.php";
?>