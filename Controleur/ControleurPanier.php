<?php require_once './Vues/Vue.php';
class ControleurPanier
{
    public function __construct()
    {

    }

    // Affiche la page du panier
    public function panier()
    {
        $vue = new Vue("Boissons"); //////////////////// remettre Panier quand la vue aura été créée
        $vue->generer(array());
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}