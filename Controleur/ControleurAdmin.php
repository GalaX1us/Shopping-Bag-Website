<?php require_once './Vues/Vue.php';
require_once './Modeles/Admin.php';

class ControleurAdmin
{
    public function __construct()
    {

    }

    // Affiche la page d'accueil du blog
    public function admin()
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
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
        
    }
}