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
    <script src="../../javascript/check_register_form.js"></script>
    <?php include("../component/meta_script.php") ?>
</head>
<body class="container-fluid">
    <?php include("../component/header.php") ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 search-movie">
                <h3>Inscription</h3>
                <form id="form-inscription" action="../script/register.php" method="post">
                    <div id="section-email">
                        <div>
                            <label for="email1">Entrez votre email : </label>
                            <input required type="email" name="email1" id="email1">
                        </div>
                        <div>
                            <label for="confirm-email">Confirmez votre email : </label>
                            <input required type="email" name="confirm-email" id="confirm-email">
                        </div>
                    </div>
                    <div id="section-pwd">
                        <div>
                            <label for="pwd">Votre mots de passe : </label>
                            <input required type="password" name="pwd" id="pwd">
                        </div>
                        <div>
                            <label for="confirm-pwd">Confirmez : </label>
                            <input required type="password" name="confirm-pwd" id="confirm-pwd">
                        </div>
                    </div>
                    <div id="info-membre">
                        <div>
                            <label for="nom">Votre nom : </label>
                            <input required type="text" name="nom" id="nom">
                        </div>
                        <div>
                            <label for="prenom">Votre prenom : </label>
                            <input required type="text" name="prenom" id="prenom">
                        </div>
                        <div>
                            <label for="date_naissance">Votre anniversaire : </label>
                            <input required type="date" name="date_naissance" id="date_naissance">
                        </div>
                        <div>
                            <label for="cpostal">Code postal : </label>
                            <input required type="text" name="cpostal" id="cpostal">
                        </div>
                        <div>
                            <label for="ville">Votre ville : </label>
                            <input required type="text" name="ville" id="ville">
                        </div>
                    </div>
                    <input id="date-btn" class="submit-btn btn" type="submit" value="inscription">
                </form>
            </div>
        </div>
    </div>
    
    <?php include("../component/footer.php") ?>

</body>
</html>