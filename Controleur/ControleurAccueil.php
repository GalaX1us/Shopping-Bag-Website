<?php require_once './Vues/Vue.php';
class ControleurAccueil
{
    public function __construct()
    {

    }

    // Affiche la page d'accueil
    public function accueil()
    {
        $vue = new Vue("Accueil"); 
        $vue->generer(array());
    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}