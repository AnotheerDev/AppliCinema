<?php
session_start();
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
        foreach ($requete->fetchAll() as $film) { ?>
            <tr>
                <td><?= $film["titre"] ?></td>
                <td><?= $film["dateSortie"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>



<?php

$content = ob_get_clean();
$title = "films";
require "template.php";
