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
                <td><a href="#" data-toggle="modal" data-target="#filmModal"><?= $film["titre"] ?></a></td>
                <td><?= $film["dateSortie"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<!-- MODAL -->
<div class="modal fade" id="filmModal" tabindex="-1" role="dialog" aria-labelledby="filmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filmModalLabel">Détails du film</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 id="filmModalTitre"></h2>
                <p id="filmModalDate"></p>
                <!-- Ajoutez d'autres éléments du contenu modal si nécessaire -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<?php

$content = ob_get_clean();
$title = "films";
require "template.php";
