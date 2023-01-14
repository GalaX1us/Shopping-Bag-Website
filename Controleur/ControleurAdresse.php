<?php require_once './Vues/Vue.php';
require_once './Modeles/Customers.php';
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
            $customer = new Customer();
            $customer->connect();

            $infos = $customer->getCustomer($_SESSION['id']);
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