<?php 
require_once 'Vues/Vue.php';
require_once 'Modeles/SignUp.php';
class ControleurCreerCompte
{

    
    public function __construct()
    {
        if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['add1']) && isset($_POST['add2']) && isset($_POST['city']) && isset($_POST['code']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['identifiant']) && isset($_POST['password']))
        {
            $this->creationDecompte($_POST['name'], $_POST['surname'], $_POST['add1'], $_POST['add2'], $_POST['city'], $_POST['code'],$_POST['phone'], $_POST['email'], $_POST['identifiant'], $_POST['password']);
        }    
    }

    // Affiche la page de connexion du blog
    public function connexion()
    {

        $vue = new Vue("CreerCompte");
        $donnees = array(); 
        $vue->generer($donnees); 
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
    public function creationDecompte($prenom, $nom, $adresse, $adresse2, $ville, $codePostal, $phone, $email, $identifiant, $password)
    {   
        //rajouter traiement pour vérifier la validité des données

        $signUp = new SignUp();
        $signUp->creerCompte($prenom, $nom, $adresse, $adresse2, $ville, $codePostal, $phonee, $email, $identifiant, $password);
    }
}