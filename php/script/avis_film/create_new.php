<?php

class NewAvis
{
    private $id_film;
    private $commentaire;
    private $note;
    private $id_fiche_personne;
    private $date;

    public function __construct($id_film, $commentaire, $note, $id_fiche_personne)
    {
        $this->id_film = $id_film;
        $this->commentaire = $commentaire;
        $this->note = $note;
        $this->id_fiche_personne = $id_fiche_personne;
        $this->date = date('Y-m-d');
    }

    public function getIdFilm()
    {
        return $this->id_film;
    }

    public function getCommentaire()
    {
        return $this->commentaire;
    }

    public function getNote()
    {
        return $this->note;
    }

    public function getIdFichePersonne()
    {
        return $this->id_fiche_personne;
    }

    public function getDate()
    {
        return $this->date;
    }

    public function addAvis()
    {
        $bdd = getBdd();
        $request = "INSERT INTO avis_film (id_film, commentaire, note, id_fiche_personne, date) 
            VALUE (" . '\'' . $this->id_film . '\'' .  ',' . '\'' . $this->commentaire . '\'' . ',' . '\'' . $this->note . '\'' . ',' . '\'' . $this->id_fiche_personne . '\'' . ',' . '\'' . "$this->date" . '\'' . ")";
        if ($bdd->query($request))
        {
            ?><p>Votre avis a bien ete pris en compte</p><?php
        }
        else
        {
            ?><p>Une erreur est survenue l'avis n'a pus etre pris en compte</p><?php
        }
    }
}

$newAvis = new NewAvis($_GET['film'], $_POST['commentaire'], $_POST['note'], 32);
$newAvis->addAvis();

?>