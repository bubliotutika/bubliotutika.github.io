<?php 
    $distrib = $bdd->query('SELECT * FROM distrib ORDER BY nom ASC');
    while ($data = $distrib->fetch()) 
    {
        ?><option value="<?php echo $data['id_distrib']?>"><?php echo $data['nom'] ?></option><?php
    }
?>