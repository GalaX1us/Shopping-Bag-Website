<?php require_once './Vues/Vue.php';
class ControleurConnexion
{
    public function __construct()
    {

    }

    // Affiche la page d'accueil du blog
    public function connexion()
    {
        $vue = new Vue("Connexion");
        $vue->generer(array());
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}