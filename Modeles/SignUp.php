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
    public function maxId()
    {
        $sql = 'SELECT MAX(id) FROM customers';
        $result = $this->executerRequete($sql);
        $maxId = $result->fetchColumn();
        return $maxId;
    }
    public function checkUsername ($username)
    {
        $sql = 'SELECT username FROM logins WHERE username = ?';
        $result = $this->executerRequete($sql, array($username));
        if ($result->rowCount() == 0)
        {
            $sameUsername = false;
        }
        else
        {
            $sameUsername = true;
        }
        return $sameUsername;
    }

}