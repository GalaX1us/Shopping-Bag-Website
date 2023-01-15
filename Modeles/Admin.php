<?php require_once 'Modele.php';
class Admin extends Modele
{
    // Renvoie la liste des commandes 
    public function getCommandes()
    {
        $sql = 'select O.id, D.firstname, D.lastname, D.add1, D.add2, D.city, D.postcode, O.date, O.payment_type, O.total from orders O
                    join delivery_addresses D on D.id = O.delivery_add_id
                    where status = 2';
            $commandes = $this->executerRequete($sql, array());

            if($commandes->rowCount() > 0)
            {
                return $commandes->fetchAll(); 
            }
            else
            {
                throw new Exception("Aucune commande n'a été trouvée");
            }
    }
    // Renvoie les informations sur une commande
    public function getProduits()
    {
        $sql = 'SELECT p.name, p.image, o.quantity FROM products p
                JOIN orderitems o ON o.product_id = p.id
                WHERE o.order_id = ?';
                ;
        $infos = $this->executerRequete($sql, array());
        if($infos->rowCount() > 0)
        {
            return $infos->fetchAll(); 
        }
        else
        {
            throw new Exception("Aucune commande n'a été trouvée");
        }
    }



}