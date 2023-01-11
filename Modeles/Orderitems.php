<?php require_once 'Modeles/Modele.php';
class Orderitem extends Modele
{
    // Renvoie la liste des orderitems du blog
    public function getOrderitems()
    {
        $sql = 'select id, username, password from orderitems'
            . ' order by BIL_ID desc';
        $orderitems = $this->executerRequete($sql);
        return $orderitems;
    }
    // Renvoie les informations sur une orderitem
    public function getOrderitem($idOrderitem)
    {
        $sql = 'select id, username, password from orderitems'
            . ' where id=?';
        $orderitem = $this->executerRequete($sql, array($idOrderitem));
        if ($orderitem->rowCount() == 1) return $orderitem->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucune produit commandé ne correspond à l'identifiant '$idOrderitem'");
    }

    // Supprime un produit de la commande
    public function supprOrderitem($idOrder, $idProduit)
    {
        $sql = 'delete from orderitems'
            . ' where order_id=? and product_id=?';
        $this->executerRequete($sql, array($idOrder, $idProduit));
    }
}