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



<?php

$content = ob_get_clean();
$title = "Genre";
require "template.php";
