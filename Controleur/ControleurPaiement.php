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
    private $paye;
    private $prix;
    
    public function __construct()
    {
        $this->paye = false;
        $this->prix = 0; 
    }

    // Affiche la page d'accueil du blog
    public function Paiement()
    {   
        if (isset($_SESSION["total_general"]))
        {
            $this->prix = $_SESSION["total_general"]; //verifier que c'est bien le bon nom 
        }
        if (((isset($_POST['paypal']) &&  $_POST['paypal']== true)||(isset($_POST['cb']) &&  $_POST['paypal']== true))&&!$this->paye) 
        {
            $this->paye = true;
            $order = new Order();
            $order->connect();
            $idCommande = $order->getIdOrder($_SESSION['id']);
            if ($idCommande !== False) {
                $order->changeStatus($idCommande[0], 2);
            }

            //rajout a la base de données
        }

        $vue = new Vue("Paiement");
        $donnees = array("prix" => $this->prix, "paye" => $this->paye);
        $vue->generer($donnees);
    }
    // Affiche une erreur
    public function ProcessAddress()
    {

        if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["add1"]) && isset($_POST["city"])
            && isset($_POST["code"]) && isset($_POST["phone"]) && isset($_POST["email"])
        ){

            $_SESSION['name'] = $_POST['name'];
            $_SESSION['surename'] = $_POST['surname'];
            $_SESSION['add1'] = $_POST['add1'];
            $_SESSION['add2'] = $_POST['add2'];
            $_SESSION['city'] = $_POST['city'];
            $_SESSION['code'] = $_POST['code'];
            $_SESSION['phone'] = $_POST['phone'];
            $_SESSION['email'] = $_POST['email'];

            if ((isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'])) {
                $delAdrr = new Delivery_adress();
                $delAdrr->connect();
                $addId = $delAdrr->creatDeliveryAddress($_SESSION['name'], $_SESSION['surename'], $_SESSION['add1'], $_SESSION['add2'], $_SESSION['city'], $_SESSION['code'], $_SESSION['phone'], $_SESSION['email']);

                $order = new Order();
                $order->connect();
                $idCommande = $order->getIdOrder($_SESSION['id']);
                if ($idCommande !== False) {
                    $order->setDeliveryAddress($idCommande[0], $addId);
                    $order->changeStatus($idCommande[0], 1);
                }
            }
                $this->Paiement();

            } else {
                $this->erreur("Certains champs d'adresse requis n'ont pas été remplis");
            }

        }

    public function CheckPaiement()
    {

    }

    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}