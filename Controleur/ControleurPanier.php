<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './Vues/Vue.php';
class ControleurPanier
{
    public function __construct()
    {
        $_SESSION['produits'] = array('abricotsSecs' => array('nom' => "abricotsSecs", 'prix' => 1.5, 'qte' => 4), 
        'amandes' => array('nom' => "amandes", 'prix' => 2.25, 'qte' => 3),
        'biscuitsCannelle' => array('nom' => "biscuitsCannelle", 'prix' => 2.25, 'qte' => 3));//// a suppr
    }

    // Affiche la page du panier
    public function panier()
    {
        if (isset($_SESSION['produits'])) {
            $vue = new Vue("Panier");
            $vue->generer($_SESSION['produits']);
        }
        else {
            $vue = new Vue("Panier");
            $vue->generer(array());
        }
    }

    // Supprime un produit du panier
    public function suppr_produit($id) {
        if( array_key_exists($id, $_SESSION['produits'])) {
            unset($_SESSION['produits'][$id]);
        }
        else throw new Exception("Le produit à supprimer ( ".$id." ) n'est pas dans le panier.");
    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}