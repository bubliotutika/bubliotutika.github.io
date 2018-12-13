<?php

$bdd = getBdd();
$request = 'SELECT titre,date_fin_affiche FROM film WHERE date_debut_affiche <= \'' . $_POST['date'] . '\' AND date_fin_affiche >= \'' . $_POST['date'] . '\'';
$todayMovie = $bdd->query($request);

if ($data = $todayMovie->fetch())
{
    ?> <h3>Film a l'affiche :</h3> <?php
    printMovie($data['titre'], $data['date_fin_affiche']);
    while ($data = $todayMovie->fetch()) 
    {
        printMovie($data['titre'], $data['date_fin_affiche']);
    }
}
else
{
    ?> <p>Aucun film a l'affiche aujourd'hui</p> <?php
}

function printMovie($title, $dateFin)
{
    ?> <p>"<?php echo $title ?>" est actuelement en salle jusqu'au <?php echo $dateFin ?></p> <?php
}

?>