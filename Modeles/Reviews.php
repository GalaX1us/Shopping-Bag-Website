<?php require_once 'Modele.php';

class Review extends Modele
{
    // Renvoie les review d'un produit
    public function getReview($idProduct)
    {
        $sql = 'select * from reviews'
            . ' where id_product=?';
        $review = $this->executerRequete($sql, array($idProduct));
        if ($review->rowCount() >= 1) return $review->fetchAll();
        else throw new Exception("Aucun avis ne correspond au produit d'ID : '$idProduct'");
    }
}