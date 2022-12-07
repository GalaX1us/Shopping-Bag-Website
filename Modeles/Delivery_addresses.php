<?php require_once 'Modele/Modele.php';
class Delivery_adress extends Modele
{
    // Renvoie la liste des adresses du blog
    public function getDelivery_adresses()
    {
        $sql = 'select id, username, password from delivery_adresses'
            . ' order by BIL_ID desc';
        $delivery_adresses = $this->executerRequete($sql);
        return $delivery_adresses;
    }
    // Renvoie les informations sur une adresse
    public function getDelivery_adress($idDelivery_adress)
    {
        $sql = 'select id, username, password from delivery_adresses'
            . ' where id=?';
        $delivery_adress = $this->executerRequete($sql, array($idDelivery_adress));
        if ($delivery_adress->rowCount() == 1) return $delivery_adress->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucune adresse ne correspond à l'identifiant '$idDelivery_adress'");
    }
}