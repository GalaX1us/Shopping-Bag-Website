<?php require_once './Vues/Vue.php';
class ControleurBiscuits
{
    public function __construct()
    {

    }

    // Affiche la page des biscuits
    public function biscuits()
    {
        $vue = new Vue("Boissons"); //////////////////// remettre Biscuits quand la vue aura été créée
        $vue->generer(array());
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}