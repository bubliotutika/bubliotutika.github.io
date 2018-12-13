<?php
include('script/bdd.php');
$bdd = getBdd();
$queryRequest = 'SELECT * FROM fiche_personne INNER JOIN membre ON fiche_personne.id_perso = membre.id_fiche_perso';
$allMember = $bdd->query($queryRequest);

while ($data = $allMember->fetch())
{
    $request = "INSERT INTO connexion (email, id_fiche_perso, id_membre, inscription_date, password) 
                    VALUE (" . ' \'' . $data['email'] . '\'' . ',' 
                    . '\'' . $data['id_fiche_perso'] . '\'' . ',' 
                    . '\'' . $data['id_membre'] . '\'' . ',' 
                    . '\'' . date('Y-m-d') . '\'' . ',' 
                    . '\'' . hash('sha512', 'test') . '\'' . ")";

    $bdd->query($request);
}
?>