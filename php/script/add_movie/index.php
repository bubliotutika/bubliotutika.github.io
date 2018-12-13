<?php

function getMemberHisto($id_membre)
{
    $bdd = getBdd();
    $historique = $bdd->query('SELECT id_film FROM historique_membre WHERE id_membre = \'' . $id_membre. '\'');
    return $historique;
}

function updateHistorique()
{
    $bdd = getBdd();
    $id = explode(';', $_POST['titre']);
    $updateRequest = 'INSERT INTO historique_membre (date, id_film, id_membre)
        VALUE (\'' . date('Y-m-d') . '\'' .  ',' . '\'' . $id[0] . '\'' . ',' . '\'' . $id[1] . '\'' . ")";
    if ($bdd->query($updateRequest))
    {
        ?><p style="margin:0;padding:0;">Le film a ete ajouter</p><?php
    }
    else
    {
        ?><p style="margin:0;padding:0;">Une erreur est survenue le film n'a pu etre ajouter</p><?php
    }
}

$id = explode(';', $_POST['titre']);
$historique = getMemberHisto($id[1]);
while ($data = $historique->fetch()) 
{
    if ($data['id_film'] == $id[0]) 
    {
        ?><p style="margin:0;padding:0;">Le film que vous voulez ajouter fait deja partie de la liste</p><?php
        return null;
    }
}
updateHistorique();
?>

