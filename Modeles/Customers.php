<?php require_once 'Modele/Modele.php';
class Customer extends Modele
{
    // Renvoie la liste des customers du blog
    public function getCustomers()
    {
        $sql = 'select id, username, password from customers'
            . ' order by BIL_ID desc';
        $customers = $this->executerRequete($sql);
        return $customers;
    }
    // Renvoie les informations sur un client
    public function getCustomer($idCustomer)
    {
        $sql = 'select id, username, password from customers'
            . ' where id=?';
        $customer = $this->executerRequete($sql, array($idCustomer));
        if ($customer->rowCount() == 1) return $customer->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun client ne correspond à l'identifiant '$idCustomer'");
    }
}