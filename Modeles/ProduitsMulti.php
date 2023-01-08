<?php 
require_once 'Modele.php';

class ProduitsMulti extends Modele
{
    // Renvoie la liste des logins du blog
    public function getProducts($cat)
    {
        $sql = 'select * from products where cat_id = ?';
        $products = $this->executerRequete($sql,array($cat))->fetchAll();
        return $products;
    }
}