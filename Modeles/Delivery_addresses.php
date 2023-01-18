<?php require_once 'Modele.php';
class Delivery_adress extends Modele
{
    // Renvoie les informations sur une adresse
    public function deliveryAdressExist($name, $surname, $add1, $add2, $city, $postcode, $phone, $email)
    {
        $sql = 'select id from delivery_addresses where firstname=? and lastname=? and add1=? and add2=? and city=? and postcode=? and phone=?
        and email=?';
        $delivery_adress = $this->executerRequete($sql, array($name, $surname, $add1, $add2, $city, $postcode, $phone, $email));
        if ($delivery_adress->rowCount() == 1) {
            return $delivery_adress->fetch()[0];
        }
        // Accès à la première ligne de résultat
        else{
            return -1;
        }
    }   

    public function creatDeliveryAddress($name, $surname, $add1, $add2, $city, $postcode, $phone, $email)
    {
        $id = $this->deliveryAdressExist($name, $surname, $add1, $add2, $city, $postcode, $phone, $email);

        if ($id==-1){
            $id = $this->getNextId();
            $sql = 'INSERT INTO delivery_addresses (id, firstname, lastname, add1, add2, city, postcode, phone, email)'
            .'VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)';
            $this->executerRequete($sql, array($id, $name, $surname, $add1, $add2, $city, $postcode, $phone, $email));
        }
        return $id;
    }

    public function getNextId() {
        $sql = 'select max(id) from delivery_addresses';
        $deli = $this->executerRequete($sql);
        if ($deli->rowCount() == 1) return $deli->fetch()[0]+1;
        // Accès à la première ligne de résultat
        else throw new Exception("Erreur lors de l'ajout au panier.");
    }

    public function getDeliveryAddress($id)
    {
        $sql = 'select * from delivery_addresses where id=?';
        $res = $this->executerRequete($sql,array($id));
        if ($res->rowCount() >= 1)
            return $res->fetch();
        else throw new Exception("Erreur, pas d'adresse correspondant à l'id : ".$id);
    }

    public function getDeliveryAddressFromOrder($id)
    {
        $sql = 'select delivery_add_id from orders where id=?';
        $res = $this->executerRequete($sql,array($id));
        if ($res->rowCount() >= 1){
            $res = $res->fetch()[0];
            return $this->getDeliveryAddress($res);
        }
        else throw new Exception("Erreur, pas de commande correspondant à l'id : ".$id);
    }



}