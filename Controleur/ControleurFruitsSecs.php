<?php require_once './Vues/Vue.php';
class ControleurFruitsSecs
{
    public function __construct()
    {

    }

    // Affiche la page des fruits secs
    public function fruitsSecs()
    {
        $vue = new Vue("Boissons"); //////////////////// remettre FruitsSecs quand la vue aura été créée
        $vue->generer(array());
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}