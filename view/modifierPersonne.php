<?php
ob_start();
?>


<!-- Menu déroulant pour sélectionner une personne -->
<form action="index.php?action=modifierPersonne" method="post">
    <label for="personne">Sélectionnez une personne :</label>
    <select name="personne" id="personne">
        <option value="">SELECTIONNER UNE PERSONNE</option>
        <?php foreach ($personnes as $personneItem) : ?>
            <option value="<?= $personneItem['idPersonne'] ?>"><?= $personneItem['nom'] ?> <?= $personneItem['prenom'] ?></option>
        <?php endforeach; ?>
    </select>
    <input type="submit" value="Modifier">
</form>

<form action="index.php?action=modifierPersonne" method="post">
    <?php if ($personne) : ?>
        <h2>Modifier la personne :</h2>
        <input type="hidden" name="personne" value="<?= $personne['idPersonne'] ?>">
        <label for="nom">Nom :</label>
        <input type="text" name="nom" id="nom" value="<?= $personne['nom'] ?>"><br>
        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" id="prenom" value="<?= $personne['prenom'] ?>"><br>
        <label for="sexe">Sexe :</label>
        <select name="sexe" id="sexe">
            <option value="Homme" <?= $personne['sexe'] === 'Homme' ? 'selected' : '' ?>>Homme</option>
            <option value="Femme" <?= $personne['sexe'] === 'Femme' ? 'selected' : '' ?>>Femme</option>
        </select><br>
        <label for="date_naissance">Date de naissance :</label>
        <input type="date" name="dateNaissance" id="dateNaissance" value="<?= $personne['dateNaissance'] ?>"><br>
        <!-- Ajoutez les autres champs à modifier ici -->
        <input type="submit" name="modifier" value="Modifier">
    <?php endif; ?>
</form>




<?php

$content = ob_get_clean();
$title = "Modifier personne";
require "template.php";
