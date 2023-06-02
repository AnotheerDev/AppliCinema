<?php
ob_start();
?>

<table class="uk-label uk-label-stripped">
    <thead>
        <tr>
            <th></th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($requete->fetchAll() as $genre) {?>
            <tr>
                <td><?= $genre["nom"] ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>



<?php

$content = ob_get_clean();
$title = "Genre";
require "template.php";
