<?php require_once './Vues/Vue.php';

class ControleurAdmin
{
    public function __construct()
    {

    }

    // Affiche la page d'accueil du blog
    public function admin()
    {
        
        $vue = new Vue("Admin"); 
        $vue->generer(array());
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}