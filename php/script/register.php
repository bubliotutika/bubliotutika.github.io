<?php
include_once('./bdd.php');
class NewRegister
{
    protected $pwd;
    protected $email;
    protected $nom;
    protected $prenom;
    protected $date_naissance;
    protected $cpostal;
    protected $ville;
    protected $creation;
    protected $bdd;

    public function __construct($password, $email, $nom, $prenom, $date_naissance, $cpostal, $ville)
    {
        $this->pwd = $this->hashPwd($password);
        $this->email = $email;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->date_naissance = $date_naissance;
        $this->cpostal = $cpostal;
        $this->ville = $ville;
        $this->creation = date('Y-m-d');
        $this->bdd = getBdd();
    }

    public function hashPwd($password)
    {
        return hash('sha512', $password);
    }

    public function insertNewAcc()
    {
        $this->checkEmail();
        $request = "INSERT INTO connexion (email, id_fiche_perso, id_membre, inscription_date, password) 
                    VALUE (" . ' \'' . $this->email . '\'' . ',' . '\'' . -1 . '\'' . ',' . '\'' . -1 . '\'' . ',' . '\'' . $this->creation . '\'' . ',' . '\'' . $this->pwd . '\'' . ")";
        if ($this->bdd->query($request))
        {
            echo "<script type='text/javascript'>
                    alert('Votre compte a bien ete creer');
                    document.location.assign('../page/acceuil.php');
                </script>";
            exit();
        }
        else
        {
            echo "<script type='text/javascript'>
                    alert('Votre compte n'a pas pus etre creer');
                    document.location.assign('../page/acceuil.php');
                </script>";
            exit();
        }
        
    }

    public function checkEmail()
    {
        $request = 'SELECT email FROM connexion WHERE email = \'' . $this->email .'\'';
        $email = $this->bdd->query($request);
        if ($email->fetch()) 
        {
            echo "<script type='text/javascript'>
                    alert('Un compte existe deja avec cette email');
                    document.location.assign('../page/inscription.php');
                </script>";
            exit();
        }
    }
};

$account = new NewRegister($_POST['pwd'], $_POST['email1'], $_POST['nom'], $_POST['prenom'], $_POST['date_naissance'], $_POST['cpostal'], $_POST['ville']);
$account->insertNewAcc();

?>