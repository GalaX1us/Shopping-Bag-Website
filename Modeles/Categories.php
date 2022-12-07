<?php require_once 'Modele/Modele.php';
class Categorie extends Modele
{
    // Renvoie la liste des categories du blog
    public function getCategories()
    {
        $sql = 'select id, username, password from categories'
            . ' order by BIL_ID desc';
        $categories = $this->executerRequete($sql);
        return $categories;
    }
    // Renvoie les informations sur une categorie
    public function getCategorie($idCategorie)
    {
        $sql = 'select id, username, password from categories'
            . ' where id=?';
        $categorie = $this->executerRequete($sql, array($idCategorie));
        if ($categorie->rowCount() == 1) return $categorie->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucune categorie ne correspond à l'identifiant '$idCategorie'");
    }
}