<?php require_once 'Modeles/Modele.php';
class Order extends Modele
{
    // Renvoie la liste des orders du blog
    public function getOrders()
    {
        $sql = 'select id, username, password from orders'
            . ' order by BIL_ID desc';
        $orders = $this->executerRequete($sql)->fetch();
        return $orders;
    }
    // Renvoie les informations sur une order
    public function getOrder($idOrder)
    {
        $sql = 'select * from orders'
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
            . ' where customer_id=? and (status=0 or status=1)';
        $order = $this->executerRequete($sql, array($idCustomer));
        if ($order->rowCount() == 1) return $order->fetch();
        // Accès à la première ligne de résultat
        else return false;
    }

    public function getIdOrderByStatus($idCustomer, $status)
    {
        $sql = 'select id from orders'
            . ' where customer_id=? and status=?';
        $order = $this->executerRequete($sql, array($idCustomer, $status));
        if ($order->rowCount() >= 1) return $order->fetchAll();
        // Accès à la première ligne de résultat
        else return -1;
    }



    public function getNextId() {
        $sql = 'select max(id) from orders';
        $order = $this->executerRequete($sql);
        if ($order->rowCount() == 1) return $order->fetch()[0]+1;
        // Accès à la première ligne de résultat
        else throw new Exception("Erreur lors de l'ajout au panier.");
    }

    public function createOrder($idOrder, $idCustomer, $date, $idSession, $registered = 1) {
        $sql = 'INSERT INTO orders (id, customer_id, registered, delivery_add_id, payment_type, date, status, session, total)'
              .'VALUES (?, ?, ?, null, null, ?, 0, ?, null)';
        $this->executerRequete($sql, array($idOrder, $idCustomer, $registered, $date, $idSession));
    }

    public function setDeliveryAddress($idOrder, $idAddress) {
        $sql = 'UPDATE orders SET delivery_add_id = ? WHERE id=?';
        $this->executerRequete($sql, array($idAddress, $idOrder));
    }

    public function changeStatus($idOrder, $status) {
        $sql = 'UPDATE orders SET status = ? WHERE id=?';
        $this->executerRequete($sql, array($status, $idOrder));
    }

    public function updateOrderPaiement($idOrder, $typePaiement, $total, $date, $idSession) {
        $sql = 'UPDATE orders SET status = 2, payment_type=?, total=?, date=?, session=?  WHERE id=?';
        $this->executerRequete($sql, array($typePaiement, $total, $date, $idSession, $idOrder));
    }
    public function getPanier($id)
    {
        $sql = 'select P.cat_id, P.id, P.name, P.description, P.image, P.price, OI.quantity from orders O '
                .'join orderitems OI on OI.order_id=O.id '
                .'join products P on P.id=OI.product_id where OI.order_id=?';

        $res = $this->executerRequete($sql,array($id));

        if ($res->rowCount() >= 1)
            return $res->fetchAll();
        else throw new Exception("Panier Vide.");
    }
}