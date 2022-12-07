


<?php require_once 'Modele/Modele.php';

///////////////////////////////////////////////////////////// A MODIFIER
class Review extends Modele
{
    // Renvoie la liste des avis du blog
    public function getReviews()
    {
        $sql = 'select id, username, password from reviews'
            . ' order by BIL_ID desc';
        $reviews = $this->executerRequete($sql);
        return $reviews;
    }
    // Renvoie les informations sur un avis
    public function getReview($idReview)
    {
        $sql = 'select id, username, password from reviews'
            . ' where id=?';
        $review = $this->executerRequete($sql, array($idReview));
        if ($review->rowCount() == 1) return $review->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun avis ne correspond à l'identifiant '$idReview'");
    }
}