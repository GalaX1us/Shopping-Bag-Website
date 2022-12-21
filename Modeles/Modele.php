<?php

class Modele 
{
  // Définir les propriétés de la classe
  private $user = "root";
  private $pass = "root";
  private $dbname = "web4shop";
  private $bdd = null;

  // Méthode pour établir une connexion à la base de données
  public function connect() {
    try 
    {
        $this->bdd = new PDO("mysql:host=localhost;dbname=web4shop;charset=utf8", $this->user, $this->pass, array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)); 
        echo "Connexion réussie ";
    }
    catch (Exception $e) {
        echo "Connexion échouée ";
        die('Erreur fatale : ' . $e->getMessage());
    }
    
  }

  // Méthode pour exécuter une requête sur la base de données
  public function executeQuerie($sql, $params = null) {
    if ($params == null) {
      $resultat = $this->bdd->query($sql);    // exécution directe
    }
    else {
      $resultat = $this->bdd->prepare($sql);  // requête préparée
      $resultat->execute($params);
    }
    return $resultat;
    }

    public function close() {
        $this->bdd = null;
    }


  // Méthode pour fermer la connexion à la base de données
  
}


