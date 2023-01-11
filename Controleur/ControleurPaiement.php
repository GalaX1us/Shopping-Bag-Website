<?php require_once './Vues/Vue.php';
class ControleurPaiement
{
    public function __construct()
    {

    }

    // Affiche la page d'accueil du blog
    public function Paiement()
    {
        $prix = 10; // $_SESSION["total_general"] //verifier que c'est bien le bon nom 

        $vue = new Vue("Paiement");
        $donnees = array("prix" => $prix);
        $vue->generer($donnees);

    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}