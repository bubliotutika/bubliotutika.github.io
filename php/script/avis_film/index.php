<?php

$bdd = getBdd();
$request = 'SELECT * FROM avis_film WHERE id_film = \'' . $_GET['avis'] . '\' ORDER BY date DESC';
$avis = $bdd->query($request);

if ($data = $avis->fetch())
{
    $avis = $bdd->query($request);
    while ($data = $avis->fetch()) 
    {
        ?>
        <div class="movie-item col-md-8">
            <p><b>Auteur : </b> <?php echo getMembreName($data['id_fiche_personne']) ?> </p>
            <p><b>Publier le : </b> <?php echo $data['date'] ?> </p>
            <p class='commentaire'><b>Commentaire : </b> <?php echo $data['commentaire'] ?></p>
            <p><b>Note : </b><?php echo $data['note'] ?>/20</p>
    </div>
        <?php
    }
}
else
{
    ?>
    <div class="movie-item col-md-8">
        <p>Il n'y aucun avis pour ce film</p>
    </div>
    <?php
}



function getMembreName($id_membre)
{
    $bdd = getBdd();
    $request = 'SELECT nom,prenom FROM fiche_personne WHERE id_perso = \'' . $id_membre . '\'' ;
    $user_name = $bdd->query($request);
    $data = $user_name->fetch();
    return strtoupper($data['nom']) . " " . ucfirst($data['prenom']);
}

?>