<?php
ob_start();
?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> films</p>

<table class="uk-label uk-label-stripped">
    <thead>
        <tr>
            <th>TITRE</th>
            <th>ANNEE DE SORTIE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($requete->fetchAll() as $film) {
            var_dump($film) ?>
            <tr>
                <td><a href="index.php?action=filmDetails&id='<?php $film['idFilm'] ?>'"><?= $film["titre"] ?></a></td>
                <td><?= date('Y', strtotime($film["dateSortie"])) ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>



<?php

$content = ob_get_clean();
$title = "films";
require "template.php";
