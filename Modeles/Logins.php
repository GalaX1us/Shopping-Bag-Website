<?php 
require_once '../Modeles/Modele.php';
class Login extends Modele
{
    //renvoie les infos sur un login
    public function getLogin($username)
    {
        $sql = 'SELECT * FROM admin WHERE username = ?';
        $login = $this->executerRequete($sql, array($username));
        echo 'ici'; //debug
        return $login->fetch();  // Accès à la première ligne de résultat
    }

}