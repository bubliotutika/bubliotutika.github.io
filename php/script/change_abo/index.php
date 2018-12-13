<?php
    $abo_info = explode(';', $_POST['abo']);
    $id_abo = $abo_info[0];
    $id_membre = $abo_info[1];

    $updateRequest = 'UPDATE membre SET id_abo = \''. $id_abo . '\' WHERE  id_membre = \'' . $id_membre . '\'';
    $bdd->query($updateRequest);
?>

<p style="margin:0;padding:0;">L'abonnement a ete mis a jour</p>