<?php 
require_once 'Modele.php';

class Logins extends Modele
{
    // Renvoie les informations sur un login
    public function getLogin($user)
    {
        $sql = 'select customer_id, username, password from logins'
            . ' where username=?';
        $login = $this->executerRequete($sql, array($user));
        if ($login->rowCount() == 1) return $login->fetch();
        // Accès à la première ligne de résultat
        //else throw new Exception("Aucun login ne correspond à l'identifiant '$user'");
    }

    // Renvoie les infos sur un admin en fonction d'un username
    public function getAdminByUser($user)
    {
        $sql = 'select * from admin'
            . ' where username=?';
        $login = $this->executerRequete($sql, array($user));
        if ($login->rowCount() == 1) return $login->fetch();
    }

    // Renvoie le nom d'un client en fonction de son ID
    public function getNomById($id)
    {
        $sql = 'select forname from customers'
            . ' where id=?';
        $login = $this->executerRequete($sql, array($id));
        if ($login->rowCount() == 1) return $login;
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun login ne correspond à l'identifiant '$id'");
    }

    // Renvoie le nom d'un admin en fonction de son ID
    public function getNomByIdAdmin($id)
    {
        $sql = 'select username from admin'
            . ' where id=?';
        $login = $this->executerRequete($sql, array($id));   
        if ($login->rowCount() == 1) return $login;
    }
}