<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

 require_once './Vues/Vue.php';
class ControleurPaiement
{
    public function __construct()
    {

    }

    // Affiche la page d'accueil du blog
    public function Paiement()
    {
        $paye = false;
        $prix = 0; 
        if (isset($_SESSION["total_general"]))
        {
            $prix = $_SESSION["total_general"]; //verifier que c'est bien le bon nom 
        }
        
        if (isset($_POST['paypal']) &&  $_POST['paypal']== true) 
        {
            $paye = true;
        }
        if (isset($_POST['cb']) &&  $_POST['paypal']== true) 
        {
            $paye = true;
        }

        $vue = new Vue("Paiement");
        $donnees = array("prix" => $prix, "paye" => $paye);
        $vue->generer($donnees);

    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}