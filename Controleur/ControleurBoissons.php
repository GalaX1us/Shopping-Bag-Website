<?php require_once './Vues/Vue.php';
class ControleurBoissons
{
    public function __construct()
    {

    }

    // Affiche la page des boissons
    public function boissons()
    {
        $vue = new Vue("Boissons");
        $vue->generer(array());
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}