<?php 
require_once 'Vues/Vue.php';
require_once 'Modeles/SignUp.php';

class ControleurCreerCompte
{
    private $msg = "";
    private $compteCree = false; //variable pour savoir si le compte a été créé ou non

    
    public function __construct()
    {
        
    }

    // Affiche la page de connexion du blog
    public function creerCompte()
    {
        $vue = new Vue("CreerCompte");
        

        if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['add1']) && isset($_POST['city']) && isset($_POST['code']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
        {
            $this->creationDecompte($_POST['name'], $_POST['surname'], $_POST['add1'], $_POST['add2'], $_POST['city'], $_POST['code'], $_POST['phone'], $_POST['email'], $_POST['username'], $_POST['password']);
        }
        $donnees = array("compteCree" => $this->compteCree, 
                         "msg" => $this->msg
                        );
        $vue->generer($donnees);
        
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    private function creationDecompte($name, $surname, $add1, $add2, $city, $code, $phone, $email, $username, $password)
    {

        //traitement pour vérifier les données 
        //si tout est ok, on crée le compte
        $signUp = new SignUp();
        $signUp->connect();
        if ($signUp->checkUsername($username)) {
            $this->msg = "Ce nom d'utilisateur est déjà utilisé";
            $this->compteCree = false;
            return;
        }
        $id = $signUp->maxId()+1;
        $signUp->createAccount($id, $name, $surname, $add1, $add2, $city, $code, $phone, $email);
        $signUp->createLog($id, $username, $password);

        $this->compteCree = true;
        $_SESSION['estConnecte'] = true;
        $_SESSION['id'] = $id;

        header('Location: index.php');
        

    }

  
}