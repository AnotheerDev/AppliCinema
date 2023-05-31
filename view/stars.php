<?php
    session_start();
    ob_start();
?>

<p class="uk-label uk-label-warning">Il y a <?= $requete->rowCount() ?> stars</p>

<table class="uk-label uk-label-stripped">
    <thead>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($requete->fetchAll() as $star) { ?>
            <tr>

                <td><a href="#" data-toggle="modal" data-target="#personModal"><?= $star["nom"]?></a></td>
            </tr>
            <?php } ?>
    </tbody>
</table>

<!-- MODAL -->
<div class="modal fade" id="personModal" tabindex="-1" role="dialog" aria-labelledby="personModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="personModalLabel">Détails du film</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2 id="personModalTitre"></h2>
                <p id="personModalDate"></p>
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
$title = "start";
require "template.php";