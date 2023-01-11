<?php 
require_once 'Modele.php';

class ProduitsMulti extends Modele
{
    // Renvoie la liste des logins du blog
    public function getProducts($cat)
    {
        $sql = 'select * from products where cat_id = ?';
        $products = $this->executerRequete($sql,array($cat));
        if ($products->rowCount() >= 1) return $products->fetchAll();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucune catégorie ne correspond à l'id '$cat'");
    }

    public function getProduct($id)
    {
        $sql = 'select * from products where id = ?';
        $products = $this->executerRequete($sql,array($id));
        if ($products->rowCount() == 1) return $products->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun produit ne correspond à l'id '$id'");
    }

    public function getProductPrice($id)
    {
        $sql = 'select price from products where id = ?';
        $products = $this->executerRequete($sql,array($id));
        if ($products->rowCount() == 1) return $products->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun produit ne correspond à l'id '$id'");
    }
}