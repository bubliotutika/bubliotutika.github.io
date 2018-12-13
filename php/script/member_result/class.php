<?php

include_once('/var/www/html/samsung/php/PHP_my_cinema/php/script/bdd.php');

class FichePersonne
{
    private $bdd;
    private $nom;
    private $prenom;
    private $email;
    private $cpostal;
    private $ville;
    private $date_naissance;
    private $id_abo;
    private $id_membre;
    private $id_dernier_film;
    protected $abonnement = [];
    protected $vue_aujourdhui = [];
    protected $historique = [];

    public function __construct($nom, $prenom, $email, $cpostal, $ville, $date_naissance, $id_abo, $id_membre, $id_dernier_film)
    {
        $this->bdd = getBdd();
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->cpostal = $cpostal;
        $this->ville = $ville;
        $this->date_naissance = $date_naissance;
        $this->id_abo = $id_abo;
        $this->id_membre = $id_membre;
        $this->id_dernier_film = $id_dernier_film;
        $this->abonnement = $this->abonnement();
        $this->vue_aujourdhui = $this->vueAujourdhui();
        $this->historique = $this->historique();

    }

    public function printResult()
    {
        $id = 0;
        ?>
        <div class="col-md-8 member-item">
            <div class='member-info'>
                <p><b>Nom:</b> <?php echo $this->nom ?>, <b>Prenom:</b> <?php echo $this->prenom ?></p>
                <button class="btn" onclick="showMore(event, 'show-<?php echo $id ?>')">Gerer</button>
            </div>
            
            <div id="show-<?php echo $id ?>" class="member-more">
                <p><b>Date de naissance : </b><?php echo $this->date_naissance ?></p>
                <p><b>Email : </b><?php echo $this->email?></p>
                <p><b>Ville : </b><?php echo $this->cpostal; echo(', '); echo $this->ville ?></p>
                <div>
                    <p><b>Abonnement : </b></p>
                    <form action="./change_abo.php" method=POST>
                        <select name="abo">
                            <?php foreach ($this->abonnement() as $option) 
                            {
                                echo $option;
                            } ?>
                        </select>
                        <input class="save-btn btn" type="submit" value="Enregistrer">
                    </form>
                </div>
                <div>
                    <p><b>Film vue aujourd'hui : </b></p>
                    <?php var_dump($this->vue_aujourdhui) ?>
                    <?php foreach ($this->vue_aujourdhui as $value) 
                    {
                        echo $value;
                    } ?>
                </div>
                <div>
                    <p><b>Dernier film vue : </b></p>
                    <?php echo getMovieTitle() ?>
                </div>
                <div class="historique">
                    <p><b>Historique de film : </b></p>
                    <div class="historique-list">
                        <?php foreach ($this->vue_historique as $film) 
                        {
                            echo $film;
                        } ?>
                    </div>
                </div>
                <div>
                    <p><b>Ajouter un film a l'Historique</b></p>
                    <form action="./add_movie.php" method="POST">
                        <select name="titre">
                            <?php $this->getTitre() ?>
                        </select>
                        <input type="submit" value="Ajouter">
                    </form>
                </div>
            </div>
        </div>
        <?php
        $id++;
    }

    public function abonnement()
    {
        $abonnement = $this->bdd->query('SELECT * FROM abonnement');
        while ($data = $abonnement->fetch()) 
        {
            if ($data['id_abo'] == $this->id_abo)
            {
                $str = '<option selected="selected" value="' . $this->id_abo . ';' . $this->id_membre . '">' .  $data['nom'] . '</option>';
                var_dump($str);
                array_push($this->abonnement, $str);
            }
            else
            {
                array_push($this->abonnement, '<option value="' . $this->id_abo . ';' . $this->id_membre . '">' .  $data['nom'] . '</option>');
            } 
        }
    }

    public function historique()
    {
        $historique = $this->bdd->query('SELECT * FROM historique_membre WHERE id_membre = \'' . $this->id_membre . '\' ORDER BY date DESC');
        if ($data = $historique->fetch())
        {
            $film = $this->bdd->query('SELECT titre FROM film WHERE id_film = \'' . $data['id_film'] . '\'');
            $title = $film->fetch();
            array_push($this->historique, '<p>' . $title['titre'] . ' vu le ' .  $data['date'] . '</p>');

            while($data = $historique->fetch())
            {
                $film = $bdd->query('SELECT titre FROM film WHERE id_film = \'' . $data['id_film'] . '\'');
                $title = $film->fetch();
                array_push($this->historique, '<p>' . $title['titre'] . ' vu le ' . $data['date'] . '</p>');
            }
        }
        else
        {
             array_push($this->historique, "<p>Aucun film dans l'historique</p>");
        }
        
    }
    
    public function vueAujourdhui()
    {
        $historique = $this->bdd->query('SELECT id_film FROM historique_membre WHERE id_membre = \'' . $this->id_membre . '\' AND date = \'' . date('Y-m-d') . '\'ORDER BY date DESC');
        if ($data = $historique->fetch())
        {
            $film = $this->bdd->query('SELECT titre FROM film WHERE id_film = \'' . $data['id_film'] . '\'');
            $title = $film->fetch();
            array_push($this->vue_aujourdhui, '<p>' . $title['titre'] . '</p>');

            while($data = $historique->fetch())
            {
                $film = $this->bdd->query('SELECT titre FROM film WHERE id_film = \'' . $data['id_film'] . '\'');
                $title = $film->fetch();
                array_push($this->vue_aujourdhui, '<p>' . $title['titre'] . '</p>');
            }
        }
        else
        {
            ?> <p>Aucun film vue par le membre aujourd'hui</p> <?php
        }
        
    }

    public function getTitre()
    {
        $movie = $this->bdd->query('SELECT id_film,titre FROM film ORDER BY titre ASC');
        while ($data = $movie->fetch()) 
        {
            ?> <option value=" <?php echo $data['id_film'] ?>;<?php echo $this->id_membre ?>"><?php echo $data['titre'] ?></option> <?php
        }
    }

    public function getMovieTitle()
    {
        $request = 'SELECT titre FROM film WHERE id_film = \'' . $this->id_dernier_film . '\' ORDER BY titre ASC';
        $movie = $this->bdd->query($request);
        while ($data = $movie->fetch()) 
        {
            return '<p>' . $data['titre'] . '</p>'; 
        }
    }

    public function getNom()
    {
        return $this->nom;
    }
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom()
    {
        return $this->prenom;
    }
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }


    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getCpostal()
    {
        return $this->cpostal;
    }
    public function setCpostal($cpostal)
    {
        $this->cpostal = $cpostal;

        return $this;
    }

    public function getVille()
    {
        return $this->ville;
    }
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    public function getId_abo()
    {
        return $this->id_abo;
    }
    public function setId_abo($id_abo)
    {
        $this->id_abo = $id_abo;

        return $this;
    }

    public function getId_membre()
    {
        return $this->id_membre;
    }
    public function setId_membre($id_membre)
    {
        $this->id_membre = $id_membre;

        return $this;
    }

    public function getId_dernier_film()
    {
        return $this->id_dernier_film;
    }
    public function setId_dernier_film($id_dernier_film)
    {
        $this->id_dernier_film = $id_dernier_film;

        return $this;
    }

    public function getAbonnement()
    {
        return $this->abonnement;
    }
    public function setAbonnement($abonnement)
    {
        $this->abonnement = $abonnement;

        return $this;
    }

    public function getDate_naissance()
    {
        return $this->date_naissance;
    }
    public function setDate_naissance($date_naissance)
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }
}

?>