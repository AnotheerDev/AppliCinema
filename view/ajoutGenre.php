<?php
ob_start();
?>
<style>
    form {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 5px;
    }

    input[type="text"],
    input[type="date"],
    select {
        padding: 5px;
        margin-bottom: 10px;
        border-radius: 5px;
    }

    input[type="submit"] {
        padding: 5px 10px;
        background-color: #4CAF50;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .success-message {
        color: green;
        margin-bottom: 10px;
    }

    .error-message {
        color: red;
        margin-bottom: 10px;
    }
</style>

<div>
    <p>Ajouter un nouveau genre : </p>

    <form action="index.php?action=addGenre" method="post">
        <input type="text" name="nom" maxlength="50" placeholder="genre">
        <input type="submit" name="submit" value="Ajouter">
    </form>
</div>

<?php

$content = ob_get_clean();
$title = "Ajout Genre";
require "template.php";
