<?php 
require_once 'Modele.php';

class ProduitsMulti extends Modele
{
    // Renvoie tous les produits
    public function getProducts($cat)
    {
        $sql = 'select * from products where cat_id = ?';
        $products = $this->executerRequete($sql,array($cat));
        if ($products->rowCount() >= 1) return $products->fetchAll();
        else throw new Exception("Aucune catégorie ne correspond à l'id '$cat'");
    }

    // Renvoie le produit correspondant à un ID
    public function getProduct($id)
    {
        $sql = 'select * from products where id = ?';
        $products = $this->executerRequete($sql,array($id));
        if ($products->rowCount() == 1) return $products->fetch();
        else throw new Exception("Aucun produit ne correspond à l'id '$id'");
    }

    // Renvoie le prix d'un produit
    public function getProductPrice($id)
    {
        $sql = 'select price from products where id = ?';
        $products = $this->executerRequete($sql,array($id));
        if ($products->rowCount() == 1) return $products->fetch();
        else throw new Exception("Aucun produit ne correspond à l'id '$id'");
    }

    // Renvoie la quantité d'un produit
    public function getProductQte($id)
    {
        $sql = 'select quantity from products where id = ?';
        $products = $this->executerRequete($sql,array($id));
        if ($products->rowCount() == 1) return $products->fetch();
        else throw new Exception("Aucun produit ne correspond à l'id '$id'");
    }

    // Modifie la quantité d'un produit
    public function updateQte($id, $qte) {
        $sql = 'UPDATE products SET quantity = ? WHERE id=?';
        $this->executerRequete($sql, array($qte, $id));
    }
}