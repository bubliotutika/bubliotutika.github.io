<?php 
$name = $_GET['name'] . '%';
$surname = $_GET['surname'] . '%';
$totalRequest = 'SELECT COUNT(*) FROM fiche_personne AS total WHERE nom LIKE \'' . $name . '\' AND prenom LIKE  \'' . $surname . '\'';
$total = getTotal($totalRequest);

if(isset($_GET['nbr']))
{
    $messageParPage = intval($_GET['nbr']);
}
else
{
    $messageParPage = 6;
}

$nombreDePages = ceil($total / $messageParPage);

if(isset($_GET['page']))
{
     $pageActuelle = intval($_GET['page']);
 
     if($pageActuelle > $nombreDePages)
     {
          $pageActuelle = $nombreDePages;
     }
}
else
{
     $pageActuelle = 1;  
}

$debutPage = ($pageActuelle - 1) * $messageParPage;
$queryRequest = 'SELECT * FROM fiche_personne INNER JOIN membre ON fiche_personne.id_perso = membre.id_fiche_perso WHERE fiche_personne.nom LIKE \'' . $name . '\' AND fiche_personne.prenom LIKE  \'' . $surname .  '\'' . 'ORDER BY fiche_personne.nom ASC LIMIT ' . $debutPage . ', ' . $messageParPage . '';
askData($queryRequest);

?>
<div class="col-md-8 member-item" id="pagination" >
    <?php
    
    for ($i=1; $i <= $nombreDePages; $i++) 
    { 
        if ($i == $pageActuelle)
        {
            ?> <p><b> <?php echo $i ?> </b></p> <?php
        }
        elseif ($pageActuelle + 6 >= $i && $i >= $pageActuelle - 6)
        {
            $lien =  "./member_result.php?page=" . $i . "&amp;name=" . $_GET['name'] . "&amp;surname=" . $_GET['surname'] . "&amp;nbr=" . $messageParPage;
            ?><a href="<?php echo $lien ?>"><?php echo $i ?></a><?php
        }
    }
    ?>
</div>

<?php

function askData($request)
{
    $bdd = getBdd();
    if ($membres = $bdd->query($request))
    {
        if ($membres->fetch())
        {
            printResult($request);
        }
        else
        {
            ?><p>Aucun resultat trouver !</p><?php  
        }
    }
    else
    {
        ?><p>Une erreur est survenue !</p><?php  
    }
    return null;
}

/* function printFiche($request)
{
    $bdd = getBdd();
    $membres = $bdd->query($request);
    while ($data = $membres->fetch())
    {
        $fiche = new FichePersonne(
                $data['nom'], 
                $data['prenom'], 
                $data['email'], 
                $data['cpostal'], 
                $data['ville'],
                $data['date_naissance'],
                $data['id_abo'],
                $data['id_membre'],
                $data['id_dernier_film']
            );
        
        $fiche->printResult();
    }  
} */

function printResult($request)
{
    $bdd = getBdd();
    $membres = $bdd->query($request);
    $id = 0;
    while ($data = $membres->fetch()) 
    {
        ?>
        <div class="col-md-8 member-item">
            <div class='member-info'>
                <p><b>Nom:</b> <?php echo $data['nom'] ?>, <b>Prenom:</b> <?php echo $data['prenom'] ?></p>
                <button class="btn" onclick="showMore(event, 'show-<?php echo $id ?>')">Gerer</button>
            </div>
            
            <div id="show-<?php echo $id ?>" class="member-more">
                <p><b>Date de naissance : </b><?php echo $data['date_naissance'] ?></p>
                <p><b>Email : </b><?php echo $data['email']?></p>
                <p><b>Ville : </b><?php echo $data['cpostal']; echo(', '); echo $data['ville'] ?></p>
                <div>
                    <p><b>Abonnement : </b></p>
                    <form action="./change_abo.php" method=POST>
                        <select name="abo">
                            <?php getAbonnement($data['id_abo'], $data['id_membre']) ?>
                        </select>
                        <input class="save-btn btn" type="submit" value="Enregistrer">
                    </form>
                </div>
                <div>
                    <p><b>Film vue aujourd'hui : </b></p>
                    <?php vueAujourdhui($data['id_membre']) ?>
                </div>
                <div>
                    <p><b>Dernier film vue : </b></p>
                    <?php getMovieTitle($data['id_dernier_film']) ?>
                </div>
                <div class="historique">
                    <p><b>Historique de film : </b></p>
                    <div class="historique-list">
                        <?php echo getHistorique($data['id_membre']) ?>
                    </div>
                </div>
                <div>
                    <p><b>Ajouter un film a l'Historique</b></p>
                    <form action="./add_movie.php" method="POST">
                        <select name="titre">
                            <?php getTitre($data['id_membre']) ?>
                        </select>
                        <input type="submit" value="Ajouter">
                    </form>
                </div>
            </div>
        </div>
        <?php
        $id++;
    }
}

function getAbonnement($id_abo, $id_membre)
{
    $bdd = getBdd();
    $abonnement = $bdd->query('SELECT * FROM abonnement');
    while ($data = $abonnement->fetch()) 
    {
        if ($data['id_abo'] == $id_abo)
        {
            ?> <option selected="selected" value="<?php echo $data['id_abo'] ?>;<?php echo $id_membre?>"><?php echo $data['nom'] ?></option> <?php
        }
        else
        {
            ?> <option value="<?php echo $data['id_abo'] ?>;<?php echo $id_membre ?>"><?php echo $data['nom'] ?></option> <?php
        } 
    }
}

function getHistorique($id_membre)
{
    $bdd = getBdd();
    $historique = $bdd->query('SELECT * FROM historique_membre WHERE id_membre = \'' . $id_membre . '\' ORDER BY date DESC');
    if ($data = $historique->fetch())
    {
        $film = $bdd->query('SELECT titre FROM film WHERE id_film = \'' . $data['id_film'] . '\'');
        $title = $film->fetch();
        ?> <p> <?php echo $title['titre'] ?> vu le <?php echo $data['date'] ?></p> <?php

        while($data = $historique->fetch())
        {
            $film = $bdd->query('SELECT titre FROM film WHERE id_film = \'' . $data['id_film'] . '\'');
            $title = $film->fetch();
            ?> <p> <?php echo $title['titre'] ?> vu le <?php echo $data['date'] ?></p> <?php
        }
    }
    else
    {
        ?> <p>Aucun film dans l'historique</p> <?php
    }
    
}

function vueAujourdhui($id_membre)
{
    $bdd = getBdd();
    $historique = $bdd->query('SELECT id_film FROM historique_membre WHERE id_membre = \'' . $id_membre . '\' AND date = \'' . date('Y-m-d') . '\'ORDER BY date DESC');
    if ($data = $historique->fetch())
    {
        $film = $bdd->query('SELECT titre FROM film WHERE id_film = \'' . $data['id_film'] . '\'');
        $title = $film->fetch();
        ?> <p> <?php echo $title['titre'] ?></p> <?php

        while($data = $historique->fetch())
        {
            $film = $bdd->query('SELECT titre FROM film WHERE id_film = \'' . $data['id_film'] . '\'');
            $title = $film->fetch();
            ?> <p> <?php echo $title['titre'] ?></p> <?php
        }
    }
    else
    {
        ?> <p>Aucun film vue par le membre aujourd'hui</p> <?php
    }
    
}

function getTitre($id_membre)
{
    $bdd = getBdd();
    $movie = $bdd->query('SELECT id_film,titre FROM film ORDER BY titre ASC');
    while ($data = $movie->fetch()) 
    {
        ?> <option value=" <?php echo $data['id_film'] ?>;<?php echo $id_membre ?>"><?php echo $data['titre'] ?></option> <?php
    }
}

function getMovieTitle($id_film)
{
    $bdd = getBdd();
    $request = 'SELECT titre FROM film WHERE id_film = \'' . $id_film . '\' ORDER BY titre ASC';
    $movie = $bdd->query($request);
    while ($data = $movie->fetch()) 
    {
        ?> <p> <?php echo $data['titre'] ?></p> <?php
    }
}

function getTotal($request)
{
    $bdd = getBdd();
    $get_total = $bdd->query($request);
    $total = $get_total->fetch();
    return $total[0];
}

?>