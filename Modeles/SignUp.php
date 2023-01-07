<?php 
require_once 'Modele.php';

class SignUp extends Modele
{
    //create a new account
    public function createLog($id, $identifiant, $password)
    {
        $sql = 'INSERT INTO logins (id, customer_id, username, password) VALUES (?, ?, ?, ?)';
        $this->executerRequete($sql, array($id, $id, $identifiant, $password));
    }
    public function createAccount($id, $name, $surname, $add1, $add2, $city, $code, $phone, $email)
    {
        $sql = 'INSERT INTO customers (id, forname, surname, add1, add2, add3, postcode, phone, email, registered) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 1)';
        $this->executerRequete($sql, array($id, $name, $surname, $add1, $add2, $city, $code, $phone, $email));
    }
    public function nbCompte()
    {
        $sql = 'SELECT COUNT(*) FROM customers';
        $result = $this->executerRequete($sql);
        $nbCompte = $result->fetchColumn();
        return $nbCompte;
    }

}