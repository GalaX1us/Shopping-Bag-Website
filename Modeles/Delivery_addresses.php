<?php require_once 'Modele.php';
class Delivery_adress extends Modele
{
    // Renvoie les informations sur une adresse
    public function deliveryAdressExist($name, $surname, $add1, $add2, $city, $postcode, $phone, $email)
    {
        $sql = 'select id from delivery_adresses where firstname=? and surname=? and add1=? add2=? city=? postcode=? phone=?
        email=?';
        $delivery_adress = $this->executerRequete($sql, array($name, $surname, $add1, $add2, $city, $postcode, $phone, $email));
        if ($delivery_adress->rowCount() >= 1) return $delivery_adress->fetch();
        // Accès à la première ligne de résultat
        else -1;
    }
}