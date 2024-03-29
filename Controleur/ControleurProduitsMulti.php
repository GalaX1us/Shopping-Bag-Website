<?php 
require_once './Vues/Vue.php';
require_once 'Modeles/Products.php';
require_once 'Modeles/Reviews.php';

class ControleurProduitsMulti
{  
    public function __construct()
    {

    }

    // Affiche la page avec tous les produits d'un même type
    public function ProduitsMulti($cat)
    {
        $type = '0';
        $name = '';

        switch ($cat) {
            case 'Boissons':
                $type = '1';
                $name = 'Boissons';
                break;
            case 'Biscuits':
                $type = '2';
                $name = 'Biscuits';
                break;
            case 'FruitsSecs':
                $type = '3';
                $name = 'Fruits secs';
                break;  
        }
           
        $vue = new Vue('ProduitsMulti');
        $products = new ProduitsMulti();
        $products->connect();
        $results = $products->getProducts($type);
        $vue->generer(array('produitsInfos'=>$results, 'cat'=>$cat, 'nomCategorie'=>$name));
    }

    // Affiche la page d'un produit
    public function Produit()
    {
        if(isset($_GET['prod_id'])) {
            $id = $_GET['prod_id'];
            $vue = new Vue('Produit');
            $product = new ProduitsMulti();
            $reviews = new Review();
            $reviews->connect();
            $product->connect();
            $results = $product->getProduct($id);
            $results_rev = $reviews->getReview($id);
            $vue->generer(array('produitInfos'=>$results, 'reviewsInfos'=>$results_rev));
        }
        else throw new Exception("Produit non valide.");
    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}