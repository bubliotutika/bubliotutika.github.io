<?php
function getBdd()
{
    $host = 'localhost';
    $dbname = 'id8218918_my_cinema';
    $username = 'benjam';
    $password = 'prejent';

    try 
    {
        $bdd = new PDO("mysql:host=$host;dbname=$dbname;charset=UTF8", $username, $password);
    } 
    catch (PDOException $e) 
    {
        die('Connexion échouée : ' . $e->getMessage());
    }
    return $bdd;
}
?>