<?php

include_once('./bdd.php');

$password = hash('sha512', $_POST['password']);
$bdd = getBdd();
$request = 'SELECT * FROM connexion WHERE email = \'' . $_POST['email'] . '\' AND password = \'' . $password . '\'';
$membre = $bdd->query($request);

if ($data = $membre->fetch())
{   
    session_start();
    $_SESSION['id'] = $data['id'];
    $_SESSION['email'] = $data['email'];
    $_SESSION['grade'] = $data['grade'];
 
    echo "<script type='text/javascript'>
        document.location.assign('../page/acceuil.php');
    </script>";
    exit();
}
else
{
    echo "<script type='text/javascript'>
        alert('Identifiant incorrect, verifier votre email et votre mot de passe');
        document.location.assign('../page/acceuil.php');
    </script>";
    exit();
}

?>