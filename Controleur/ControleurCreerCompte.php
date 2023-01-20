<?php 
require_once 'Vues/Vue.php';
require_once 'Modeles/SignUp.php';

class ControleurCreerCompte
{
    private $msg = "";
    private $forname = ""; 
    private $surname = ""; 
    private $add1 = ""; 
    private $add2 =""; 
    private $city = "";
    private $code = "";
    private $phone = "";
    private $email = "";
    private $username = "";
    private $password = "";
    private $compteCree = false; //variable pour savoir si le compte a été créé ou non

    
    public function __construct()
    {
        
    }

    // Affiche la page de connexion du blog
    public function creerCompte()
    {
        if (isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['add1']) && isset($_POST['city']) && isset($_POST['code']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
        {
            $this->forname = $_POST['name'];
            $this->surname = $_POST['surname'];
            $this->add1 = $_POST['add1'];
            $this->add2 = $_POST['add2'];
            $this->city = $_POST['city'];
            $this->code = $_POST['code'];
            $this->phone = $_POST['phone'];
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];
            $this->username = $_POST['username'];
        }
        
        $vue = new Vue("CreerCompte");
        

        if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['add1']) && isset($_POST['city']) && isset($_POST['code']) && isset($_POST['phone']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password']))
        {
            $this->creationDecompte($_POST['name'], $_POST['surname'], $_POST['add1'], $_POST['add2'], $_POST['city'], $_POST['code'], $_POST['phone'], $_POST['email'], $_POST['username'], $_POST['password']);
        }
        $donnees = array("compteCree" => $this->compteCree, 
                         "msg" => $this->msg,
                         "name" => $this->forname,
                         "surname" => $this->surname,
                            "add1" => $this->add1,
                            "add2" => $this->add2,
                            "city" => $this->city,
                            "code" => $this->code,
                            "phone" => $this->phone,
                            "email" => $this->email,
                            "username" => $this->username,
                            "password" => $this->password

                        );
        $vue->generer($donnees);
        
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $donnees = (array('msgErreur' => $msgErreur));
        $vue->generer($donnees);
    }

    private function creationDecompte($name, $surname, $add1, $add2, $city, $code, $phone, $email, $username, $password)
    {

        $signUp = new SignUp();
        $signUp->connect();
        if ($signUp->checkUsername($username)) {
            $this->msg = "Ce nom d'utilisateur est déjà utilisé";
            $this->compteCree = false;
            return;
        }

        $custId = $signUp->nextCustomerId();
        $logId = $signUp->nextLoginId();

        $signUp->createAccount($custId, $name, $surname, $add1, $add2, $city, $code, $phone, $email);
        $signUp->createLog($logId,$custId, $username, sha1(iconv("UTF-8", "ASCII", $password)));

        $this->compteCree = true;
        $_SESSION['estConnecte'] = true;
        $_SESSION['id'] = $custId;

        header('Location: index.php');
        

    }

  
}