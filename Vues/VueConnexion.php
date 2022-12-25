<?php $titre = "Page de connexion"; 
require_once 'Controleur/ControleurConnexion.php';
?>

<?php ob_start(); ?>

  <?php 
    echo '<p> $connecte = ' . $connecte . '</p>'; //debbug
    if ($connecte)
    {
      echo '<p> Vous êtes déjà connecté ! </p>'; //debbug
    }
    else
    {
  ?>

    <h1> Identification client </h1>
    <p> Merci d'entrer votre identifiant et votre mot de passe pour accéder à votre espace client.
        Si vous n'avez pas de compte client, vous pouvez en créer un ici gratuitement ici ! Enregistrement </p>

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
  ?> 


<?php $contenu = ob_get_clean(); ?>