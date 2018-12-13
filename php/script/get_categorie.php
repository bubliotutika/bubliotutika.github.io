<?php 
    $categorie = $bdd->query('SELECT * FROM genre ORDER BY nom ASC');
    while ($data = $categorie->fetch())
    {
        ?><option value="<?php echo $data['id_genre']?>"><?php echo $data['nom'] ?></option><?php
    }
?>