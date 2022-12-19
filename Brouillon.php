<?php

// je mets ici toutes les fonctions qu'on a supprimées/modifiées etc que l'on aimerait pouvoir retrouver

// fonction initiale que j'ai par la suite modifié dans Logins
require_once 'Modele/Modele.php';
class Login extends Modele
{
    // Renvoie la liste des logins du blog
    public function getLogins()
    {
        $sql = 'select id, username, password from logins'
            . ' order by BIL_ID desc';
        $logins = $this->executerRequete($sql);
        return $logins;
    }
    // Renvoie les informations sur un login
    public function getLogin($idLogin)
    {
        $sql = 'select id, username, password from logins'
            . ' where id=?';
        $login = $this->executerRequete($sql, array($idLogin));
        if ($login->rowCount() == 1) return $login->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun login ne correspond à l'identifiant '$idLogin'");
    }
}


