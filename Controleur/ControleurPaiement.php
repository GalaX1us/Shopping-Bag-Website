<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once './Vues/Vue.php';
require_once 'Modeles/Delivery_addresses.php';
require_once 'Modeles/SignUp.php';
class ControleurPaiement
{
    private $name; 
    private $surname; 
    private $add1; 
    private $add2; 
    private $city;
    private $code;
    private $phone;
    private $email;
    public function __construct()
    {

    }

    // Affiche la page d'accueil du blog
    public function Paiement()
    {
        $paye = false;
        $prix = 0; 
        if (isset($_SESSION["total_general"]))
        {
            $prix = $_SESSION["total_general"]; //verifier que c'est bien le bon nom 
        }
        
        if (isset($_POST['paypal']) &&  $_POST['paypal']== true) 
        {
            $paye = true;
        }
        if (isset($_POST['cb']) &&  $_POST['paypal']== true) 
        {
            $paye = true;
        }

        $vue = new Vue("Paiement");
        $donnees = array("prix" => $prix, "paye" => $paye);
        $vue->generer($donnees);

    }
    // Affiche une erreur
    public function ProcessAdress(){
        if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["add1"]) && isset($_POST["city"])
        && isset($_POST["code"]) && isset($_POST["phone"]) && isset($_POST["email"])){
            $this->name = $_POST['name'];
            $this->surname = $_POST['surname'];
            $this->add1 = $_POST['add1'];
            $this->add2 = null;
            $this->city = $_POST['city'];
            $this->code = $_POST['code'];
            $this->phone = $_POST['phone'];
            $this->email = $_POST['email'];
            if (isset($_POST["add2"])){
                $this->email = $_POST['add2'];
            }

            if (!(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'])){
                $newAccount = new SignUp();
                $newAccount->connect();
                $newAccount->createAccount($newAccount->maxId() + 1, $this->name, $this->surname, $this->add1, $this->add2, $this->city, $this->code, $this->phone, $this->email);
            }

            $delAdrr = new Delivery_adress();
            $delAdrr->connect();
            $addId = $delAdrr->deliveryAdressExist($this->name, $this->surname,$this->add1,$this->add2,$this->city,$this->code,$this->phone,$this->email);
            
            if ($addId == -1){

            }

        }else{
            $this->erreur("Certains champs d'adresse requis n'ont pas été remplis");
        }
    }


    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}