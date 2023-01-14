<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once './Vues/Vue.php';
require_once 'Modeles/Orderitems.php';
require_once 'Modeles/Orders.php';
require_once 'Modeles/Products.php';
class ControleurPanier
{
    public function __construct()
    {
        
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
            if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte']) {
                $idCommande = $this->getIdCommande($_SESSION['id']);
                $orderitem = new Orderitem();
                $orderitem->connect();

                // On vérifie que le produit n'est pas déjà dans le panier
                $produitsCommande = $orderitem->getProduitsCommande($idCommande);
                $productInCart = false;
                $newQte = $_POST['qte'];
                foreach ($produitsCommande as $produit) {
                    if ($produit['product_id'] == $_GET['prod_id']) {
                        $productInCart = true;
                        $newQte += $produit['quantity'];
                        break;
                    }
                }
                if ($productInCart) { // Si oui, on ne modifie que la quantité enregistrée
                    $orderitem->updateQuantite($idCommande, $_GET['prod_id'], $newQte);
                }
                else { // Sinon, on ajoute le produit à la commande dans la BD
                    $idOrderItem = $orderitem->getNextId();
                    $orderitem->ajoutPanier($idOrderItem, $idCommande, $_GET['prod_id'], $_POST['qte']);
                }
            }
            $this->ajoutProduit($_GET['prod_id'], $newQte); // Ajoute le produit à la variable de session
            $this->panier();
        }
        else throw new Exception("Le produit à ajouter n'est pas valide");
    }

    // Renvoie l'id de commande s'il existe, ou crée une nouvelle commande
    public function getIdCommande($idClient) {
        $order = new Order();
        $order->connect();
        $idCommande = $order->getIdOrder($idClient);
        if($idCommande === false) { // Si on n'a pas de commande en cours on en crée une nouvelle
            $idCommande = $order->getNextId();
            $order->createOrder($idCommande, $_SESSION['id'], date('Y-m-d'), session_id());               
        }
        else $idCommande = $idCommande[0];
        return $idCommande;
    }

    // Ajoute un produit au panier dans $_SESSION
    public function ajoutProduit($id_prod, $qte) {
        if(empty($_SESSION['produits'])) $_SESSION['produits'] = array();
        $product = new ProduitsMulti();
        $product->connect();
        $infos_prod = $product->getProduct($id_prod);
        $nom = $infos_prod['name'];
        $num_cat = $infos_prod['cat_id'];
        switch($num_cat) {
            case 1:
                $categorie = 'Boissons';
                break;
            case 2:
                $categorie = 'Biscuits';
                break;
            case 3:
                $categorie = 'FruitsSecs';
                break;
            default: 
                $categorie = 'Boissons';
        }
        $prix = $infos_prod['price'];
        $qteMax = $infos_prod['quantity'];
        $img = $infos_prod['image'];
        $prod_array = array('idprod' => $id_prod, 'nom' => $nom, 'cat' => $categorie,'prix' => $prix, 'qte' => $qte, 'qtemax' => $qteMax, 'img' => $img);
        
        $_SESSION['produits'][$id_prod] = $prod_array;
    }

    // Supprime un produit du panier en le supprimant aussi de la BD
    public function panierSuppr() {
        if(isset($_GET['suppr_id'])) {
            if(isset($_SESSION['estConnecte']) && $_SESSION['estConnecte']) {
                $order = new Order();
                $order->connect();
                $idCommande = $order->getIdOrder($_SESSION['id'])[0];
                $orderitem = new Orderitem();
                $orderitem->connect();
                $orderitem->supprOrderitem($idCommande, $_GET['suppr_id']);
            }
            $this->supprProduit($_GET['suppr_id']);
            $this->panier();
        }
        else throw new Exception("Le produit à supprimer n'est pas valide");
    }

    // Supprime un produit du panier dans $_SESSION
    public function supprProduit($id) {
        if(array_key_exists($id, $_SESSION['produits'])) {
            unset($_SESSION['produits'][$id]);
        }
        else throw new Exception("Le produit à supprimer n'est pas dans le panier.");
    }

    // Traite le contenu du panier en mettant les données nécessaires à la vue dans un tableau
    private function traiterPanier($tableau_produits) {
        $tab_resultat = array();
        $total_general = 0;
        $i = 0;
        foreach ($tableau_produits as $produit) {
            $i++;
            $idProd = $produit['idprod'];
            $nom = $produit['nom'];
            $categorie = $produit['cat'];
            $prix = $produit['prix'];
            $prix_affichage = $this->formatagePrix($prix);
            $qte = $produit['qte'];
            $qteMax = $produit['qtemax'];
            $total = $prix * $qte;
            $total_affichage = $this->formatagePrix($total);
            $image = $produit['img'];

            $produit_resultat = array(
                'indice'    => $i,
                'id'        => $idProd,
                'nom'       => $nom,
                'cat'       => $categorie,
                'prix'      => $prix,
                'prix_aff'  => $prix_affichage,
                'qte'       => $qte,
                'qtemax'    => $qteMax,
                'total'     => $total,
                'total_aff' => $total_affichage,
                'img'       => $image
            );
            
            array_push($tab_resultat, $produit_resultat);

            $total_general += $total;
        }
        return array('produits' => $tab_resultat, 'total_general' =>$this->formatagePrix($total_general));
    }

    // formate le prix : 2.5 -> '2,50€'
    private function formatagePrix($prix_nombre) {
        $prix_str = number_format($prix_nombre, 2, ',', ' ').'€';
        return $prix_str;
    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}