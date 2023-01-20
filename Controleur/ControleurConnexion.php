<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'Vues/Vue.php';
require_once 'Modeles/Logins.php';
require_once './Modeles/Orders.php';
require_once './Controleur/ControleurPanier.php';

class ControleurConnexion
{
    private $msg = "";

    public function __construct()
    {

    }

    // Affiche la page de connexion
    public function connexion()
    {
        if (isset($_POST['username']) && isset($_POST['password'])) 
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->connecter($username,$password);
        }
        if (isset($_POST['bouton'])&& $_POST['bouton'] == "deconnexion") 
        {
            $this->deconnecter();
        }

        $vue = new Vue("Connexion");
        $connecte = $this->est_connecte();
        if (isset($_SESSION['admin']))
        {
            $admin = $_SESSION['admin'];
        }
        else
        {
            $admin = false;
        }
        $nom = $this->get_nom();
        $donnees = array ('connecte' => $connecte, 'nom' => $nom, 'msgErreur' => $this->msg, 'admin' => $admin); 
        $vue->generer($donnees); 
    }

    // Déconnecte l'utilisateur
    private function deconnecter()
    {
        $_SESSION['connecte'] = FALSE;
        //detruire la session 
        session_destroy();
    }

    // Vérifie si l'utilisateur est connecté
    public function est_connecte(): bool
    {
        if (isset($_SESSION['estConnecte'])) {
            return $_SESSION['estConnecte'];
        } else {
            return false;
        }
    }

    // Renvoie le nom du client s'il est connecté
    public function get_nom() 
    {
        if($this->est_connecte() == false)
        {
            return "Vous n'êtes pas connecté";
        }
        else
        {
            $login = new Logins();
            $login->connect();
            try
            {
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true)
                {
                    if (isset($_SESSION['id']))
                    {
                        $result = $login->getNomByIdAdmin($_SESSION['id']);
                    }
                    else
                    {
                        $result = "Vous n'êtes pas connecté";
                    }
                }
                else
                {
                    if (isset($_SESSION['id']))
                    {
                        $result = $login->getNomById($_SESSION['id']);
                    }
                    else
                    {
                        $result = "Vous n'êtes pas connecté";
                    }
                }
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
            foreach ($result as $donnees) 
            {
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true)
                {
                    $_SESSION['name'] = $donnees['username'];
                    return $donnees['username'];
                }
                else
                {
                    $_SESSION['name'] = $donnees['forname'];
                    return $donnees['forname'];
                }
            }
        }
    }

    // Gère la connexion de l'utilisateur
    public function connecter($username, $password)
    {   
        $login = new Logins();
        $login->connect();
        $result = $login->getLogin($username);

        
        if (!empty($result))
        {
            foreach ($result as $donnees)   
            {
                if ($donnees['password'] == $password) {
                    $_SESSION['estConnecte'] = true;
                    $_SESSION['id'] = $donnees['customer_id'];
                    $this->msg ="";

                    // On va voir s'il a une commande en cours pour récupérer son panier
                    if(isset($_SESSION['produits'])) unset($_SESSION['produits']);
                    $order = new Order();
                    $order->connect();
                    $idCommande = $order->getIdOrder($_SESSION['id']);
                    if($idCommande === false) { // Si on n'a pas de commande en cours on en crée une nouvelle
                        $idCommande = $order->getNextId();
                        $order->createOrder($idCommande, $_SESSION['id'], date('Y-m-d'), session_id());               
                    }
                    else $idCommande = $idCommande[0];
                    $orderitem = new Orderitem();
                    $orderitem->connect();
                    $produitsCommande = $orderitem->getProduitsCommande($idCommande);
                    $ctrlPanier = new ControleurPanier();
                    foreach ($produitsCommande as $produit) {
                        $ctrlPanier->ajoutProduit($produit['product_id'], $produit['quantity']);
                    }
                } 
                else {
                    $this->msg = "identifiant ou mot de passe incorrect";
                }
            }
        }
        else
        {
            $result = $login->getAdminByUser($username);
            if (!empty($result))
            {
                foreach ($result as $donnees)   
                {
                    if ($donnees['password'] == $password) {

                        $_SESSION['estConnecte'] = true;
                        $_SESSION['id'] = $donnees['id'];
                        $_SESSION['admin'] = true;
                        $this->msg ="";
                    } 
                    else {
                        $this->msg = "identifiant ou mot de passe incorrect";
                    }
                }
            }
        }
    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}