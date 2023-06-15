<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=$, initial-scale=1.0">
    <!-- link à ajouter dans le head pour faire fonctionner bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="public/css/style.css">
    <title><?php $title; ?></title>
</head>

<body>


    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <a class="navbar-brand" href="#"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav justify-content-center">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?action=home">HOME <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?action=films">FILMS <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?action=stars">ACTEURS - REALISATEURS <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?action=genre">GENRE <span class="sr-only">(current)</span></a>
                </li>
                <!-- <li class="nav-item active">
                    <a class="nav-link" href="index.php?action=casting">CASTING <span class="sr-only">(current)</span></a>
                </li> -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        AJOUT
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?action=ajoutStar">AJOUT STARS</a>
                        <a class="dropdown-item" href="index.php?action=addFilm">AJOUT FILM</a>
                        <a class="dropdown-item" href="index.php?action=addGenre">AJOUT GENRE</a>
                        <a class="dropdown-item" href="index.php?action=addCasting">AJOUT CASTING</a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        EDITION
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?action=modifierPersonne">STARS</a>
                        <a class="dropdown-item" href="index.php?action=modifierFilm">FILMS</a>
                    </div>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container">
        <?= $content ?>
    </div>



    <!-- script à ajouter en fin de body pour faire fonctionner bootstrap -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>

</html>