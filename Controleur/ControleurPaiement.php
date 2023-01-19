<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once './Vues/Vue.php';
require_once 'Modeles/Delivery_addresses.php';
require_once 'Modeles/SignUp.php';
require_once 'Modeles/Facture.php';
require_once './Modeles/Orders.php';
require_once './Modeles/Products.php';

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

    // Affiche la page de paiement
    public function Paiement()
    {   
        if (isset($_SESSION['total_general']))
        {
            $this->prix = $_SESSION['total_general'];
        }

        if (((isset($_POST['paypal']) &&  $_POST['paypal']== true)||(isset($_POST['cheque']) &&  $_POST['cheque']== true))&&!$this->paye) 
        {
            $this->paye = true;
            if(isset($_POST['paypal']) && $_POST['paypal']) $typePaiement = "paypal";
            else $typePaiement = "cheque";


            // Finalisation de la commande dans la BD
            if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte']) {
                $order = new Order();
                $order->connect();
                $idCommande = $order->getIdOrder($_SESSION['id']);
                if ($idCommande !== False) {
                    $order->updateOrderPaiement($idCommande[0], $typePaiement, $this->prix, date('Y-m-d'), session_id());
                }
                // Création de la commande suivante
                $idCommande = $order->getNextId();
                $order->createOrder($idCommande, $_SESSION['id'], date('Y-m-d'), session_id());
            }
            else { // Si l'on est pas connecté, il faut tout ajouter à la BD
                if (isset($_SESSION["name"]) && isset($_SESSION["surname"]) && isset($_SESSION["add1"]) && isset($_SESSION["city"])
                && isset($_SESSION["code"]) && isset($_SESSION["phone"]) && isset($_SESSION["email"])) {

                    // Création du customer
                    $signup = new SignUp();
                    $signup->connect();
                    $idClient = $signup->nextCustomerId();
                    $signup->createAccount($idClient, $_SESSION["name"], $_SESSION["surname"], $_SESSION["add1"], 
                    $_SESSION["add2"], $_SESSION["city"], $_SESSION["code"], $_SESSION["phone"], $_SESSION["email"], 0);

                    // Création de la delivery_address
                    $delAdrr = new Delivery_adress();
                    $delAdrr->connect();
                    $addId = $delAdrr->creatDeliveryAddress($_SESSION['name'], $_SESSION['surname'], $_SESSION['add1'], 
                    $_SESSION['add2'], $_SESSION['city'], $_SESSION['code'], $_SESSION['phone'], $_SESSION['email']);

                    // Création de l'order
                    $order = new Order();
                    $order->connect();
                    $idCommande = $order->getNextId();
                    $order->createOrder($idCommande, $idClient, date('Y-m-d'), session_id(), 0);
                    $order->setDeliveryAddress($idCommande, $addId);
                    $order->updateOrderPaiement($idCommande, $typePaiement, $this->prix, date('Y-m-d'), session_id());

                    // Ajout de tous les produits de la commande dans OrderItems
                    $orderitem = new Orderitem();
                    $orderitem->connect();
                    foreach($_SESSION['produits'] as $produit) {
                        $idOrderItem = $orderitem->getNextId();
                        $orderitem->ajoutPanier($idOrderItem, $idCommande, $produit['idprod'], $produit['qte']);
                    }
                }
                else {
                    throw new Exception("Erreur lors du paiement.");
                }
            }

            // Changements stocks des produits dans la BD
            if(isset($_SESSION['produits'])) {
                $product = new ProduitsMulti();
                $product->connect();
                foreach($_SESSION['produits'] as $produit) {
                    $product->updateQte($produit['idprod'], $produit['qte']);
                }
            }

            if(isset($_SESSION['produits'])) unset($_SESSION['produits']);

            if ($typePaiement == 'cheque'){
                $fac = new Facture();
                $fac->generer_facture();
            }
        }

        $vue = new Vue("Paiement");
        $donnees = array("prix" => $this->prix, "paye" => $this->paye);
        $vue->generer($donnees);
    }

    // Ajoute l'adresse à la variable de session et à la BD
    public function ProcessAddress()
    {
        if (isset($_POST["name"]) && isset($_POST["surname"]) && isset($_POST["add1"]) && isset($_POST["city"])
            && isset($_POST["code"]) && isset($_POST["phone"]) && isset($_POST["email"]))
        {
            $_SESSION['name']    = $_POST['name'];
            $_SESSION['surname'] = $_POST['surname'];
            $_SESSION['add1']    = $_POST['add1'];
            $_SESSION['add2']    = $_POST['add2'];
            $_SESSION['city']    = $_POST['city'];
            $_SESSION['code']    = $_POST['code'];
            $_SESSION['phone']   = $_POST['phone'];
            $_SESSION['email']   = $_POST['email'];

            if ((isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'])) {
                $delAdrr = new Delivery_adress();
                $delAdrr->connect();
                $addId = $delAdrr->creatDeliveryAddress($_SESSION['name'], $_SESSION['surname'], $_SESSION['add1'], $_SESSION['add2'], $_SESSION['city'], $_SESSION['code'], $_SESSION['phone'], $_SESSION['email']);

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

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}