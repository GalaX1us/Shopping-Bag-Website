<?php 
require_once 'Modele.php';

class Logins extends Modele
{
    // Renvoie la liste des logins du blog
    public function getLogins()
    {
        $sql = 'select id, username, password from logins';
        $logins = $this->executerRequete($sql);
        return $logins;
    }
    // Renvoie les informations sur un login
    public function getLogin($user)
    {
        $sql = 'select id, username, password from logins'
            . ' where username=?';
        $login = $this->executerRequete($sql, array($user));
        if ($login->rowCount() == 1) return $login;
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun login ne correspond à l'identifiant '$user'");
    }
}