<?php
session_start();
$_SESSION = [];
session_destroy();
if (!isset($_SESSION['id']) && !isset($_SESSION['email']))
{
    echo "<script type='text/javascript'>
        document.location.assign('../page/acceuil.php');
    </script>";
}

?>