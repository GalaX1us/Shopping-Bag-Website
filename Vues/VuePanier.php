<?php //if (session_status() == PHP_SESSION_NONE) session_start(); ?>

<?php $titre = "Mon Blog - Panier"; ?>

<?php ob_start(); ?>

  <?php 
  if (!$donnees['nonVide'])
    {
      echo '<br/><h2>Votre panier est vide.</h2>'; 
    }
    else
    {
  ?>

    <h1>Je suis dans le else (et c'est pas normal)</h1>


  <?php
    }
  ?> 


<?php $contenu = ob_get_clean(); ?>
