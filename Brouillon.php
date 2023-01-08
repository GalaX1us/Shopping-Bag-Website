<?php

// je mets ici toutes les fonctions qu'on a supprimées/modifiées etc que l'on aimerait pouvoir retrouver

// fonction initiale que j'ai par la suite modifié dans Logins
require_once 'Modele/Modele.php';
class Login extends Modele
{
    // Renvoie la liste des logins du blog
    public function getLogins()
    {
        $sql = 'select id, username, password from logins'
            . ' order by BIL_ID desc';
        $logins = $this->executerRequete($sql);
        return $logins;
    }
    // Renvoie les informations sur un login
    public function getLogin($idLogin)
    {
        $sql = 'select id, username, password from logins'
            . ' where id=?';
        $login = $this->executerRequete($sql, array($idLogin));
        if ($login->rowCount() == 1) return $login->fetch();
        // Accès à la première ligne de résultat
        else throw new Exception("Aucun login ne correspond à l'identifiant '$idLogin'");
    }
}

<?php if (erreur != "") { ?>
    <div class="alert alert-danger" role="alert">
      <?php echo $erreur; ?>
    </div>
<?php } ?>

// vue connexion qui marche pas bien mais avec bouton déconnexion
<?php $titre = "Page de connexion"; ?>

<?php ob_start(); ?>

  <?php 
    //echo '<p> $connecte = ' . $connecte . '</p>'; //debbug
    if (false)
    {
      echo '<p> Vous êtes connecté ! </p>'; //debbug
  ?>


    <form method="post" action="index.php?action=Connexion"> <!-- bien creer le fichier au bon endroit -->
      <button name="bouton" value="1" class="btn btn-primary btn-lg btn-block">Se déconnecter</button>
  </form>

  <?php


    }
    else
    {
  ?>

    <h1> Identification client </h1>
    <p> Merci d'entrer votre identifiant et votre mot de passe pour accéder à votre espace client.
        Si vous n'avez pas de compte client, vous pouvez en créer un ici gratuitement ici ! Enregistrement </p>

    <?php if (erreur != "") { ?>
      <div class="alert alert-danger" role="alert">
        <?php echo $erreur; ?>
      </div>

    <form method="post" action="index.php?action=Connexion"> <!-- bien creer le fichier au bon endroit -->
      <div class="mb-3">
        <input type="identifiant" name="username" placeholder="Entrez votre identifiant" class="form-control"  aria-describedby="emailHelp">
      </div>
      <div class="mb-3">
        <input type="password" name="password" placeholder="Entrez votre mot de passe" class="form-control" >
      </div>
      <button type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
  </form>

  <?php
    }
  }
  ?> 

<?php $contenu = ob_get_clean(); ?>


// pour accèder à une variable de session 
if (session_status() == PHP_SESSION_NONE) { //verifie si la session est active
  session_start();
}
// traitement sur les variables de session
//par exemple : 
echo '<p> vous êtes l identifiant'. $_SESSION['username']. '</p>';



<?php 
require_once 'Vues/Vue.php';
require_once 'Modeles/SignUp.php';

class ControleurCreerCompte
{

    
    public function __construct()
    {
        
    }

    // Affiche la page de connexion du blog
    public function creerCompte()
    {
        if(isset($_POST['identifiant']) && isset($_POST['password']))
        {
            $this->creationDecompte($_POST['identifiant'], $_POST['password']);
        }
        $vue = new Vue("CreerCompte");
        $donnees = array(); 
        $vue->generer($donnees); 
        

        
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    private function creationDecompte($identifiant, $password)
    {
        $this->erreur("test");
        $signUp = new SignUp();
        $signUp->connect();
        $signUp->createAccount($identifiant, $password);
    }
  
}


