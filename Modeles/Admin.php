<?php require_once 'Modele/Modele.php';
class Admin extends Modele
{
    // Renvoie la liste des admins du blog
    public function getAdmins()
    {
        $sql = 'select id, username, password from admin'
            . ' order by BIL_ID desc';
        $admins = $this->executerRequete($sql);
        return $admins;
    }
    // Renvoie les informations sur un admin
    public function getAdmin($idAdmin)
    {
        $sql = 'select id, username, password from admin'
            . ' where id=?';
        $admin = $this->executerRequete($sql, array($idAdmin));
        if ($admin->rowCount() == 1) return $admin->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun admin ne correspond à l'identifiant '$idAdmin'");
    }
}