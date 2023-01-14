<?php $titre = "ISIWEB4SHOP - Connexion"; ?>
<?php ob_start(); ?>

  <?php 
  if ($connecte)
    {
      echo '<br /><h2> Bonjour ' . $nom . ' :) </h2><br />'; 
      ?>
      <form method="post" action="index.php?action=Connexion"> <!-- bien creer le fichier au bon endroit -->
        <button name="bouton" value="deconnexion" class="btn btn-primary btn-lg btn-block">Se déconnecter</button>
      </form>
      
      <?php 
      if ($admin)
      {
        echo '<h2> Vous êtes administrateur 😎😎😎 </h2>';
        ?> 
    <form method="post" action="index.php?action=Admin"> <!-- bien creer le fichier au bon endroit -->
        <button name="bouton"  class="btn btn-primary btn-lg btn-block">Accéder à la page administrateur</button>
    </form>
      

<?php } ?>
      
      

  <?php
    }
    else
    {
  ?>

    <h1> Identification client </h1>
    <p> Merci d'entrer votre identifiant et votre mot de passe pour accéder à votre espace client.
        Si vous n'avez pas de compte client, vous pouvez en créer un ici gratuitement ! <a href = "index.php?action=CreerCompte"> Enregistrement </a> </p>

    
    <?php if ($msgErreur != "") { ?>
      <div class="alert alert-danger" role="alert">
      <?php echo $msgErreur; ?>
      </div>
    <?php } ?>

    <form method="post" action="index.php?action=Connexion"> 
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
