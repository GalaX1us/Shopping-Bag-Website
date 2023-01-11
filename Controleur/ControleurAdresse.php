<?php require_once './Vues/Vue.php';
class ControleurAdresse
{
    public function __construct()
    {

    }

    // Affiche la page d'accueil du blog
    public function adresse()
    {
        $vue = new Vue("Adresse"); 
        $vue->generer(array());
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}