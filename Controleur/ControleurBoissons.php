<?php require_once './Vues/Vue.php';
require_once 'Modeles/Boissons.php';
class ControleurBoissons
{  
    public function __construct()
    {

    }

    // Affiche la page des boissons
    public function boissons()
    {
        $vue = new Vue("Boissons");
        $boissons = new Boissons();
        $boissons->connect();
        $nbBoissons = $boissons->getBoissonsNb();
        $vue->generer(array('nb'=>$nbBoissons));
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}