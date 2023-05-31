<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=$, initial-scale=1.0">
    <!-- link à ajouter dans le head pour faire fonctionner bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/style.css">
    <title><?php $title; ?></title>
</head>

<body>
    <ul class="nav justify-content-center">
        <li class="nav-item">
            <a class="nav-link active text-dark" aria-current="page" href="index.php?action=home">HOME</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-dark" aria-current="page" href="index.php?action=films">FILMS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-dark" aria-current="page" href="index.php?action=stars">ACTEURS - REALISATEURS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-dark" href="#">GENRE</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-dark" href="#">AJOUT CASTING - STARS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active text-dark" href="#">AJOUT FILM</a>
        </li>
    </ul>


    <div class="container">
        <?= $content ?>
    </div>



    <!-- script à ajouter en fin de body pour faire fonctionner bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>