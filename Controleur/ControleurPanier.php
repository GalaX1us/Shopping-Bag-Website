<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './Vues/Vue.php';
class ControleurPanier
{
    public function __construct()
    {

    }

    // Affiche la page du panier
    public function panier()
    {
        if (isset($_SESSION['produits'])) {
            $vue = new Vue("Panier");
            $vue->generer(array('nonVide' => TRUE, 'produits' => $_SESSION['produits']));
        }
        else {
            $vue = new Vue("Panier");
            $vue->generer(array('nonVide' => FALSE));
        }
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}