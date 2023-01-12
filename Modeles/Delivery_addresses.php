<?php require_once 'Modele.php';
class Delivery_adress extends Modele
{
    // Renvoie les informations sur une adresse
    public function getDelivery_adress($id)
    {
        $sql = 'select * from customers where id=?';
        $delivery_adress = $this->executerRequete($sql, array($id));
        if ($delivery_adress->rowCount() == 1) return $delivery_adress->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucune adresse ne correspond à l'identifiant '$id'");
    }
}