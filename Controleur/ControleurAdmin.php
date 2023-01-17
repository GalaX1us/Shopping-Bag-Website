<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './Vues/Vue.php';
require_once './Modeles/Admin.php';

class ControleurAdmin
{
    public function __construct()
    {

    }

    // Affiche la page d'accueil du blog
    public function admin()
    {
        
        if (isset($_SESSION['admin']) && ($_SESSION['admin']==true))
        {
            if (isset($_POST['bouton'])&& $_POST['bouton'] == "commandes") 
            {
                $vue = new Vue("Admin");
                $Admin = new Admin();
                $Admin->connect();
                $exist = 1;
                $commandes = array();
                
                try
                {
                    $commandes = $Admin->getCommandes();
                }
                catch (Exception $e)
                {

                    $exist = 0;
                    //$this->erreur("Aucune commande n'a été trouvée");
                } 
                
                
                $vue->generer(array("commandes" => $commandes , "exist" => $exist));
            }
        }
        else 
        {
            $this->erreur("Vous n'êtes pas connecté en tant qu'administrateur");
        }
        
        
       
    }
    
    public function TraiterCommande()
    {
        if (isset($_SESSION['admin']) && ($_SESSION['admin']==true))
        {
            $vue = new Vue("TraiterCommande");
            $Admin = new Admin();
            $Admin->connect();
            try
            {
                $produits = $Admin->getProduits($_GET['id']);
            }
            catch (Exception $e)
            {
                $this->erreur("Aucune commande n'a été trouvée 1");
            }
            $vue->generer(array("produits" => $produits, "id" => $_GET['id']));
        }
        else 
        {
            $this->erreur("Vous n'êtes pas connecté en tant qu'administrateur");
        }
    }
    public function actionCommande()
    {
        if (isset($_SESSION['admin']) && ($_SESSION['admin']==true))
        {
            $vue = new Vue("Admin");
            $Admin = new Admin();
            $Admin->connect();
            if (isset($_POST['valider']) && $_POST['valider'] == "valider")
            {
                
                $Admin->validerCommande($_GET['id']);
                header('Location: index.php?action=Admin');
            }
            else
            {
                $this->erreur("Aucune action n'a été choisie");
            }

                
        }
        else 
        {
            $this->erreur("Vous n'êtes pas connecté en tant qu'administrateur");
        }
    }
    public function gererStocks()
    {

        $vue = new Vue("GererStocks");
        $Admin = new Admin();
        $Admin->connect();
        $produits = array();
        try
        {
            $produits = $Admin->getAllProduits();
        }
        catch (Exception $e)
        {
            $this->erreur("Aucun produit n'a été trouvé");
        }
        $vue->generer(array("produits" => $produits));
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
        
    }
}