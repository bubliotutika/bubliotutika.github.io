<?php include('../script/bdd.php')  ?>
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
    <script src="../../javascript/header_drop_menu.js"></script>
</head>
<body class="container-fluid">
    <?php include("../component/header.php") ?>

    <div class="container">
        <div class="row">
            <div class="col-md-8 search-movie">
            <?php
                 if (isset($_POST['contact-email']) && isset($_POST['message']) && isset($_POST['object']))
                {
                    include('../script/contact/send_email.php');
                }
                else
                {
                    include('../script/contact/contact_form.php');
                }
            ?>
            </div>
        </div>
    </div>

    <?php include("../component/footer.php") ?>
</body>
</html>