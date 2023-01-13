<?php 
require_once './Vues/Vue.php';
require_once './Modeles/Delivery_addresses.php';
require_once './Modeles/Orders.php';
require_once './Modeles/Orderitems.php';
class ControleurAdresse
{
    public function __construct()
    {

    }
    // Affiche la page d'accueil du blog
    public function adresse()
    {
        $vue = new Vue("Adresse");
        try {$this->updateQte();}
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }
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

    // Met à jour les quantités dans $_SESSION et dans la BD si elles ont été modifiées dans le panier
    private function updateQte() {
        $total = 0;
        if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte']) {
            foreach($_SESSION['produits'] as $produit) {
                if(isset($_POST['qte-'.$produit['idprod']])) {
                    $qte = $_POST['qte-'.$produit['idprod']];
                    if($qte != $produit['qte']) {
                        $_SESSION['produits'][$produit['idprod']]['qte'] = $qte;
                        $order = new Order();
                        $order->connect();
                        $idCommande = $order->getIdOrder($_SESSION['id'])[0];
                        $orderItem = new Orderitem();
                        $orderItem->connect();
                        $orderItem->updateQuantite($idCommande, $produit['idprod'], $qte);
                    }
                    $total += $produit['prix'] * $qte;
                }
                else throw new Exception("Erreur lors de la validation du panier.");
            }
        }
        else {
            foreach($_SESSION['produits'] as $produit) {
                if(isset($_POST['qte-'.$produit['idprod']])) {
                    $qte = $_POST['qte-'.$produit['idprod']];
                    if($qte != $produit['qte']) {
                        $_SESSION['produits'][$produit['idprod']]['qte'] = $qte;
                    }

                    $total += $produit['prix'] * $qte;
                }
                else throw new Exception("Erreur lors de la validation du panier.");
            }
        }
    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}