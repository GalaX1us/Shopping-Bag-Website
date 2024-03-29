<?php 
require_once 'Modele.php';

class SignUp extends Modele
{
    // Crée un nouveau compte
    public function createLog($logId, $custId, $identifiant, $password)
    {
        $sql = 'INSERT INTO logins (id, customer_id, username, password) VALUES (?, ?, ?, ?)';
        $this->executerRequete($sql, array($logId, $custId, $identifiant, $password));
    }

    // Crée un nouveau client
    public function createAccount($id, $name, $surname, $add1, $add2, $city, $code, $phone, $email, $reg=1)
    {
        $sql = 'INSERT INTO customers (id, forname, surname, add1, add2, add3, postcode, phone, email, registered) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)';
        $this->executerRequete($sql, array($id, $name, $surname, $add1, $add2, $city, $code, $phone, $email, $reg));
    }

    // Renvoie l'ID du prochain client
    public function nextCustomerId()
    {
        $sql = 'SELECT MAX(id) FROM customers';
        $result = $this->executerRequete($sql);
        $maxId = $result->fetchColumn();
        return $maxId+1;
    }

    // Rnevoie l'ID du prochain compte
    public function nextLoginId()
    {
        $sql = 'SELECT MAX(id) FROM logins';
        $result = $this->executerRequete($sql);
        $maxId = $result->fetchColumn();
        return $maxId+1;
    }

    // Vérifie si un nom d'utilisateur est déjà utilisé ou non
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