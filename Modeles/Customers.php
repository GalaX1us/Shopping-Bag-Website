<?php require_once 'Modeles/Modele.php';
class Customer extends Modele
{
    // Renvoie les informations sur un client
    public function getCustomer($idCustomer)
    {
        $sql = 'select * from customers where id=?';
        $customer = $this->executerRequete($sql, array($idCustomer));
        if ($customer->rowCount() == 1) return $customer->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun client ne correspond à l'identifiant '$idCustomer'");
    }
}