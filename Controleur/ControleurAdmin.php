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
            $vue = new Vue("Admin");
            $Admin = new Admin();
            $Admin->connect();
            try
            {
                $commandes = $Admin->getCommandes();
                
            }
            catch (Exception $e)
            {
                $this->erreur("Aucune commande n'a été trouvée");
            }
            $vue->generer(array("commandes" => $commandes));
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
                $this->erreur("Aucune commande n'a été trouvée");
            }
            $vue->generer(array("commande" => $commande, "produits" => $produits));
        }
        else 
        {
            $this->erreur("Vous n'êtes pas connecté en tant qu'administrateur");
        }
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
        
    }
}