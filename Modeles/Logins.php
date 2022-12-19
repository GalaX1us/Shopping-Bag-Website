<?php 
require_once '../Modeles/Modele.php';
class Login extends Modele
{
    //renvoie les infos sur un login
    public function getLogin($username, $password)
    {
        $sql = 'SELECT * FROM login WHERE username = ? AND password = ?';
        $login = $this->executerRequete($sql, array($username, $password));
        return $login->fetch();  // Accès à la première ligne de résultat
    }

}