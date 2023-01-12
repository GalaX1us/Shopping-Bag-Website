<?php require_once './Vues/Vue.php';
require_once './Modeles/Delivery_addresses.php';
class ControleurAdresse
{
    public function __construct()
    {

    }
    // Affiche la page d'accueil du blog
    public function adresse()
    {
        $vue = new Vue("Adresse");
        $co = isset($_SESSION['estConnecte']) && $_SESSION['estConnecte'];
        $donnees = array('estConnecte' => $co);

        if ($co) {
            $customer = new Delivery_adress();
            $customer->connect();

            $infos = $customer->getDelivery_adress($_SESSION['id']);
            $donnees = array('infosClient' => $infos, 'estConnecte' => $co);
        }

        $vue->generer($donnees);
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}