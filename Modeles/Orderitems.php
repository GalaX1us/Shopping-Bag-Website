<?php require_once 'Modeles/Modele.php';
class Orderitem extends Modele
{
    // Renvoie l'Id du prochain orderItem
    public function getNextId() {
        $sql = 'select max(id) from orderitems';
        $order = $this->executerRequete($sql);
        if ($order->rowCount() == 1) return $order->fetch()[0]+1;
        else throw new Exception("Erreur lors de l'ajout au panier.");
    }

    // Supprime un produit de la commande
    public function supprOrderitem($idOrder, $idProduit)
    {
        $sql = 'delete from orderitems'
            . ' where order_id=? and product_id=?';
        $this->executerRequete($sql, array($idOrder, $idProduit));
    }

    // Ajoute un produit à la commande
    public function ajoutPanier($id, $idOrder, $idProduit, $qte) {
        $sql = 'INSERT INTO orderitems (id, order_id, product_id, quantity)'
              .'VALUES (?, ?, ?, ?)';
        $this->executerRequete($sql, array($id, $idOrder, $idProduit, $qte));
    }

    // Met à jour la quantité d'un produit de la commande
    public function updateQuantite($idOrder, $idProduit, $qte) {
        $sql = 'UPDATE orderitems SET quantity=?'
              .'WHERE order_id=? and product_id=?';
        $this->executerRequete($sql, array($qte, $idOrder, $idProduit));
    }

    // Renvoie tous les produits d'une commande
    public function getProduitsCommande($idOrder) {
        $sql = 'SELECT product_id, quantity FROM orderitems WHERE order_id=?';
        $orderitems = $this->executerRequete($sql, array($idOrder));
        return $orderitems->fetchAll();
    }
}