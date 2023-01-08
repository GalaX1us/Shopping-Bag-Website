<?php require_once './Vues/Vue.php';
require_once 'Modeles/ProduitsMulti.php';
class ControleurProduitsMulti
{  
    public function __construct()
    {

    }

    // Affiche la page avec tous le sproduits d'un même type
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
        $vue->generer(array('produitsInfos'=>$results, 'nomCategorie'=>$name));
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}