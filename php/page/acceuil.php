<?php include('../script/bdd.php'); $bdd = getBdd(); ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>My cinema</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="../../css/image/fallout_icon.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="../../css/master.css" />
    <script src="../../javascript/acceuil/check.js"></script>
    <?php include("../component/meta_script.php") ?>
</head>
<body class="container-fluid">
    <?php include("../component/header.php") ?>
    <div class="container">
        <div class="row" id="movie" >
            <div class="col-md-8 search-movie">
                <h3>Rechercher un film</h3>
                <form action="./movie_result.php" method="post">
                    <div class="form-item">
                        <label for="title">Titre : </label>
                        <input type="text" name="title" id="title" placeholder="Choisir un titre">
                    </div>
                    
                    <div class="form-item">
                        <label for="categorie">Categorie : </label>
                        <select name="categorie" id="categorie">
                            <option value="-1">Choisir un categorie</option>
                            <?php include('../script/get_categorie.php') ?>
                        </select>
                    </div>
                    
                    <div class="form-item">
                        <label for="distributeur">Distributeur : </label>
                        <select name="distributeur" id="distributeur">
                            <option value="-1">Choisir un distributeur</option>
                            <?php include('../script/get_distributeur.php') ?>
                        </select>
                    </div>

                    <input id="submit-btn" class="submit-btn btn" type="submit" value="Rechercher">
                </form>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-8 search-movie">
                <h3>Quel film se soir ?</h3>
                <form action="./today_movie.php" method="post">
                    <div class="form-item">
                        <label for="date">Choisir une date : </label>
                        <input type="date" name="date" id="date">
                    </div>
                    <input id="date-btn" class="submit-btn btn" type="submit" value="Rechercher">
                </form>
            </div>
        </div>
    </div>

    <?php include("../component/footer.php") ?>
</body>
</html>
