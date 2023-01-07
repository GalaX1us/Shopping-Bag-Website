<?php

class Modele 
{
  // Définir les propriétés de la classe
  private $user = "root";
  private $pass = ""; // attention selon la config il faut mettre root ou rien
  private $dbname = "web4shop";
  private $bdd = null;

  // Méthode pour établir une connexion à la base de données
  public function connect() {
    try 
    {
        $this->bdd = new PDO("mysql:host=localhost;dbname=web4shop;charset=utf8", $this->user, $this->pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));    
        //echo "Connexion réussie"; //debbug 
      }
        
    catch (Exception $e) {
        echo "Connexion échouée ";
        die('Erreur fatale : ' . $e->getMessage());
    }
    
  }

  // Méthode pour exécuter une requête sur la base de données
  public function executerRequete($sql, $params = null) {
    if ($params == null) {
      $resultat = $this->bdd->query($sql);    // exécution directe
    }
    else {
      $resultat = $this->bdd->prepare($sql);  // requête préparée
      $resultat->execute($params);
    }
    if (empty($resultat)) {
    throw new Exception("La requête SQL n'a pas de résultat");
    }
    return $resultat;
    }
  
    
}
 