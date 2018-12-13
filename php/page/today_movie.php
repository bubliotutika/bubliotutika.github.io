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
    <?php include("../component/meta_script.php") ?>
</head>
<body class="container-fluid">
    <?php include("../component/header.php") ?>

    <div class="container">
        <div id="find-member">
            <div class="row">
                <a class="btn back-btn" href="./acceuil.php">&lArr;Retour</a>
            </div>
            <div id="today-movie" class="row">
                <?php include('../script/today_movie/index.php') ?>
            </div>
        </div>
    </div>

    <?php include("../component/footer.php") ?>
</body>
</html>