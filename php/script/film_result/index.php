<?php 

//si seulement le titre est renseigner
if (!empty($_POST['title']) && $_POST['categorie'] == '-1' && $_POST['distributeur'] == '-1')
{
    $queryRequest = 'SELECT * FROM film WHERE titre LIKE \'' . '%' . $_POST['title'] . '%' . '\'ORDER BY titre ASC';
    askData($queryRequest);
}

//si seul la categorie est choisi
if (empty($_POST['title']) && $_POST['categorie'] != '-1' && $_POST['distributeur'] == '-1')
{
    $queryRequest = 'SELECT * FROM film WHERE id_genre=\'' . $_POST['categorie'] . '\'ORDER BY titre ASC';
    askData($queryRequest);
}

//si seul le distributeur est choisi
if (empty($_POST['title']) && $_POST['categorie'] == '-1' && $_POST['distributeur'] != '-1')
{
    $queryRequest = 'SELECT * FROM film WHERE id_distrib=\'' . $_POST['distributeur'] . '\'ORDER BY titre ASC';
    askData($queryRequest);
}

//si le titre est choisi + la categorie
if (!empty($_POST['title']) && $_POST['categorie'] != '-1' && $_POST['distributeur'] == '-1')
{
    $queryRequest = 'SELECT * FROM film WHERE titre LIKE \'' . '%' . $_POST['title'] . '%' . '\'AND id_genre=\'' . $_POST['categorie'] . '\'ORDER BY titre ASC';
    askData($queryRequest);
}

//si le titre est choisi + distributeur
if (!empty($_POST['title']) && $_POST['categorie'] == '-1' && $_POST['distributeur'] != '-1')
{
    $queryRequest = 'SELECT * FROM film WHERE titre LIKE \'' . '%' . $_POST['title'] . '%' . '\'AND id_distrib=\'' . $_POST['distributeur'] . '\'ORDER BY titre ASC';
    askData($queryRequest);
}

//si le titre est choisi + categorie + distributeur
if (!empty($_POST['title']) && $_POST['categorie'] != '-1' && $_POST['distributeur'] != '-1')
{
    $queryRequest = 'SELECT * FROM film WHERE titre LIKE \'' . '%' . $_POST['title'] . '%' . '\'AND id_genre=\'' . $_POST['categorie'] . '\'AND id_distrib=\'' . $_POST['distributeur'] . '\'ORDER BY titre ASC';
    askData($queryRequest);
}

//si la categorie + le distributeur sont choisi
if (empty($_POST['title']) && $_POST['categorie'] != '-1' && $_POST['distributeur'] != '-1')
{
    $queryRequest = 'SELECT * FROM film WHERE titre LIKE id_genre=\'' . $_POST['categorie'] . '\'AND id_distrib=\'' . $_POST['distributeur'] . '\'ORDER BY titre ASC';
    askData($queryRequest);
}

function askData($requestMovie)
{
    $bdd = getBdd();
    if ($film = $bdd->query($requestMovie))
    {
        if ($film->fetch())
        {
            printResult($requestMovie);  
        }
        else
        {
            ?>
            <div class="movie-item col-md-8">
                <p>Aucun film ne correspond a ces criteres</p>
            </div> 
            <?php  
        }
    }
    else
    {
        ?>
        <div class="movie-item col-md-8">
            <p>Une erreur est survenue !</p>
        </div>
        <?php  
    }
}

function printResult($requestMovie)
{
    $bdd = getBdd();
    $film = $bdd->query($requestMovie); 
    $id = 0;
    while ($data = $film->fetch()) 
    {
        $requestGenre = 'SELECT nom FROM genre WHERE id_genre=\'' . $data['id_genre'] . '\'';
        $categorieRequest = $bdd->query($requestGenre);
        $genre = $categorieRequest->fetch();
        ?>
        <div class="movie-item col-md-8">
            <p><b>Titre:</b> <?php echo $data['titre'] ?></p>
            <p><b>Categorie:</b> <?php echo $genre['nom'] ?></p>
            <button class="btn" onclick="showMore(event, 'show-<?php echo $id ?>')">Voir plus</button>
            <div id="show-<?php echo $id?>" class="more-info">
                <?php echo getYear($data['annee_prod']) ?>
                <?php echo getDistrib($data['id_distrib']) ?>
                <?php echo getDuree($data['duree_min']) ?>
                <?php echo getResum($data['resum']) ?>
                <a href="./avis.php?avis=<?php echo $data['id_film'] ?>"><?php echo getNumberCom($data['id_film']) ?> avis pour ce film</a>
                <p>Note : <?php echo getAverageMark($data['id_film']) ?></p>
                <button class="btn add-avis" onclick="showMore(event, 'avis-<?php echo $id ?>')">Donner votre avis</button>
                <div id="avis-<?php echo $id ?>" class="more-info">
                    <form action="./add_avis.php?film=<?php echo $data['id_film'] ?>" method="post">
                        <div class='text-area'>
                            <label for="com">Votre commentaire</label>
                            <textarea name="commentaire" id="com" cols="30" rows="3"></textarea>
                        </div>
                        <label for="note">Note : </label>
                        <select name="note" id="note">
                            <?php
                            for ($i=0; $i < 21; $i++) 
                            { 
                                ?> <option value="<?php echo $i ?>"><?php echo $i ?></option> <?php
                            }
                            ?>
                        </select>
                        <input class="btn add-avis" type="submit" value="envoyer">
                    </form>
                </div>
            </div>
        </div>
        <?php
        $id++;
    }
    return null;
}

function getCategorie($request)
{
    $bdd = getBdd();
    $genre = $bdd->query($request);
    $id = $genre->fetch();
    if ($genre = $bdd->query($request))
    {
        return $id['id_genre'];
    }
    else
    {
        ?><p>Categorie inconnu !</p><?php  
    }
}

function getYear($movie)
{
    if ($movie != '0' && $movie != 'null') 
    {
        return "<p><b>Annee de production : </b>$movie</p>";
    }
    return "<p><b>Annee de production : </b>non connu</p>";;
}

function getDistrib($distrib)
{
    $bdd = getBdd();
    if ($distrib === '0' || $distrib > 0) 
    {
        $request = 'SELECT nom FROM distrib WHERE id_distrib=\'' . $distrib . '\'';
        $distribRequest = $bdd->query($request);
        $id = $distribRequest->fetch();
        if ($distribRequest = $bdd->query($request))
        {
            return "<p><b>Distributeur : </b>" . $id['nom'] . "</p>";
        }
    }
    return '<p><b>Distributeur : </b>non connu</p>';
}

function getDuree($duree)
{
    if ($duree != '0' || $duree != 'null')
    {
        return "<p><b>Duree : </b>" . $duree . " min</p>";
    }
    return '<p><b>Duree : </b>non connu</p>';
}

function getResum($resum) 
{
    if (strlen($resum) != 0 && $resum != 'null')
    {
        return "<p><b>Resume : </b>" . $resum . " min</p>";
    }
    return '<p><b>Resume : </b>pas de resume</p>';
}

function getNumberCom($id_film)
{
    $bdd = getBdd();
    $request = 'SELECT COUNT(commentaire) FROM avis_film WHERE id_film = \'' . $id_film . '\'';
    $nbr = $bdd->query($request);
    $nbrAvis = $nbr->fetch();
    return $nbrAvis[0];
}

function getAverageMark($id_film)
{
    $bdd = getBdd();
    $request = 'SELECT AVG(note) FROM avis_film WHERE id_film = \'' . $id_film . '\'';
    $nbr = $bdd->query($request);
    $average = $nbr->fetch();
    if ($average[0] == null)
    {
        return 'Pas de note';
    }
    return round($average[0], 1) . '/20';
}

?>