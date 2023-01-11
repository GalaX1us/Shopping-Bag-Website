<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './Vues/Vue.php';
require_once 'Modeles/Orderitems.php';
require_once 'Modeles/Orders.php';
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
        if (empty($_SESSION['produits'])) {
            $vue = new Vue("Panier");
            $vue->generer(array());
        }
        else {
            $donnees = $this->traiterPanier($_SESSION['produits']);
            $vue = new Vue("Panier");
            $vue->generer($donnees);
        }
    }

    // Ajoute un produit au panier
    public function ajoutPanier() {
        if(isset($_GET['prod_id'])) {
            if(isset($_SESSION['connecte']) && $_SESSION['connecte']) {
                
                /// TODO

            }
            $this->ajoutProduit($_GET['prod_id']);
            $this->panier();
        }
        else throw new Exception("Le produit à ajouter n'est pas valide");
    }

    // ajoute un produit au panier dans $_SESSION
    public function ajoutProduit($id_prod) {

        /// TODO

    }

    // Supprime un produit du panier en le supprimant aussi de la BD
    public function panierSuppr() {
        if(isset($_GET['suppr_id'])) {
            if(isset($_SESSION['connecte']) && $_SESSION['connecte']) {
                $order = new Order();
                $order->connect();
                $id_commande = $order->getIdOrder($_SESSION['id'])[0];
                $orderitem = new Orderitem();
                $orderitem->connect();
                $orderitem->supprOrderitem($id_commande, $_GET['suppr_id']);
            }
            $this->supprProduit($_GET['suppr_id']);
            $this->panier();
        }
        else throw new Exception("Le produit à supprimer n'est pas valide");
    }

    // Supprime un produit du panier dans $_SESSION
    public function supprProduit($id) {
        if( array_key_exists($id, $_SESSION['produits'])) {
            unset($_SESSION['produits'][$id]);
        }
        else throw new Exception("Le produit à supprimer ( ".$id." ) n'est pas dans le panier.");
    }

    // Traite le contenu du panier en mettant les données nécessaires à la vue dans un tableau
    private function traiterPanier($tableau_produits) {
        $tab_resultat = array();
        $total_general = 0;
        $i = 0;
        foreach ($tableau_produits as $produit) {
            $i++;
            $nom = $produit['nom'];
            $nom_affichage = ucwords(implode(' ',preg_split('/(?=[A-Z])/', $nom))); // abricotsSecs -> Abricots Secs
            $prix = $produit['prix'];
            $prix_affichage = $this->formatagePrix($prix);
            $qte = $produit['qte'];
            $total = $prix * $qte;
            $total_affichage = $this->formatagePrix($total);

            $produit_resultat = array(
                'indice' => $i,
                'nom' => $nom,
                'nom_affichage' => $nom_affichage,
                'prix' => $prix,
                'prix_affichage' => $prix_affichage,
                'qte' => $qte,
                'total' => $total,
                'total_affichage' => $total_affichage
            );

            array_push($tab_resultat, $produit_resultat);

            $total_general += $total;
        }
        return array('produits' => $tab_resultat, 'total_general' =>$this->formatagePrix($total_general));
    }

    // formate le prix : 2.5 -> '2,5€'
    private function formatagePrix($prix_nombre) {
        $prix_str = str_replace(".", ",", $prix_nombre) . '€';
        return $prix_str;
    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}