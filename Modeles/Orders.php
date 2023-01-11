<?php require_once 'Modeles/Modele.php';
class Order extends Modele
{
    // Renvoie la liste des orders du blog
    public function getOrders()
    {
        $sql = 'select id, username, password from orders'
            . ' order by BIL_ID desc';
        $orders = $this->executerRequete($sql);
        return $orders;
    }
    // Renvoie les informations sur une order
    public function getOrder($idOrder)
    {
        $sql = 'select id, username, password from orders'
            . ' where id=?';
        $order = $this->executerRequete($sql, array($idOrder));
        if ($order->rowCount() == 1) return $order->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucune commande ne correspond à l'identifiant '$idOrder'");
    }

    // Renvoie l'Id de la commande d'un client
    public function getIdOrder($idCustomer)
    {
        $sql = 'select id from orders'
            . ' where customer_id=? and status=0';
        $order = $this->executerRequete($sql, array($idCustomer));
        if ($order->rowCount() == 1) return $order->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucune commande ne correspond à l'identifiant '$idCustomer'");
    }
}