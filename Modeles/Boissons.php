<?php 
require_once 'Modele.php';

class Boissons extends Modele
{
    // Renvoie la liste des logins du blog
    public function getBoissonsNb()
    {
        $sql = 'select count(*) as nbB from products where cat_id = 1';
        $nb = $this->executerRequete($sql)->fetch();
        return $nb['nbB'];
    }
}