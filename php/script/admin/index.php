<?php

if (isset($_SESSION['grade']) && $_SESSION['grade'] == 1)
{
    ?>
    <div class="container">
        <div id="find-member">
            <div class="row">
                <h5>Rechercher un membre :</h5>
            </div>
            <form class="row" action="./member_result.php" method="get">
                <input id="text-name" type="text" name="name" placeholder="nom">
                <input id="text-surname" type="text" name="surname"  placeholder="prenom">
                <input id="submit-btn" class="btn" type="submit" value="rechercher">
            </form>
        </div>
    </div>
    <?php
}
else
{
    ?>
    <div class="container">
        <div id="find-member">
            <h5 id="not-acces">Vous n'avez pas les droit pour acceder a cette page</h5>
        </div>
    </div>
    <?php
}

?>