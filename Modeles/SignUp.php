<?php 
require_once 'Modele.php';

class SignUp extends Modele
{
    //create a new user
    public function createNewUser($name, $surname, $add1, $add2, $city, $code, $phone, $email, $username, $password)
    {
        $sql = 'INSERT INTO customers (forname, surname, add1, add2, city, code, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?)';
        $this->executerRequete($sql, array($name, $surname, $add1, $add2, $city, $code, $phone, $email, $password));

        $idCustomer = $this->getCustomerId($name, $surname, $add1, $add2, $city, $code, $phone, $email, $username, $password);

        $sql = 'INSERT INTO logins (username, password, idCustomer) VALUES (?, ?, ?)';
        $this->executerRequete($sql, array($username, $password, $idCustomer)); 

    }
    public function getCustomerId($name, $surname, $add1, $add2, $city, $code, $phone, $email, $username, $password)
    {
        $sql = 'select id from customers'
            . ' where forname=? and surname=? and add1=? and add2=? and city=? and code=? and phone=? and email=?';
        $customer = $this->executerRequete($sql, array($name, $surname, $add1, $add2, $city, $code, $phone, $email));
        if ($customer->rowCount() == 1) return $customer->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun login ne correspond à l'identifiant '$user'");
    }

}