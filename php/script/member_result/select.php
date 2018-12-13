<?php

$option = [6,10,25,50];

foreach ($option as $value) 
{
    if (isset($_GET['nbr']) && $value == $_GET['nbr'])
    {
        ?> <option selected="selected" value="<?php echo $_GET['nbr']?>"><?php echo $_GET['nbr'] ?></option> <?php
    }
    else
    {
        ?> <option value="<?php echo $value?>"><?php echo $value ?></option> <?php
    }
}

?>