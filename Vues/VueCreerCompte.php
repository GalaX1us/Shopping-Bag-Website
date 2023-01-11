<?php $titre = "Création d'un compte"; 
require_once 'Controleur/ControleurConnexion.php';
?>

<?php ob_start(); ?>

<?php
if ($compteCree)
{
    echo "<p> Votre compte a bien été créé. </p>";
}
else
{ ?>

  <p> Merci de remplir le formulaire ci-dessous pour créer votre compte client. </p>

  <form method="post" action="index.php?action=CreerCompte"> 
        <div class="mb-3">
           <input type="text" name="name" value="<?= $name?>" placeholder="Prénom" class="form-control"  aria-required="true" aria-describedby="emailHelp" required>
          <input type="text" name="surname" value="<?= $surname?>" placeholder="Nom" class="form-control" aria-required="true" required>
        </div>
        <br>
        <div class="mb-3">
          <input type="text" name="add1" value="<?= $add1?>" placeholder="Adresse" class="form-control" aria-required="true" required> 
          <input type="text" name="add2" value="<?= $add2?>" placeholder="Complément d'adresse" class="form-control" >
          <input type="text" name="city" value="<?= $city?>" placeholder="Ville" class="form-control" aria-required="true" required>
          <input type="text" name="code" value="<?= $code?>" placeholder="Code Postal" class="form-control" pattern="\d{5,5}"aria-required="true" required>
        </div>
        <br>
        <div class="mb-3">
          <input type="tel" name="phone" value="<?= $phone?>" placeholder="Numéro de téléphone" class="form-control"  aria-describedby="emailHelp" pattern="\d{10,10}" aria-required="true" required>
          <input type="email" name="email" value="<?= $email?>"  placeholder="Email" class="form-control" aria-required="true" required>
        </div>
        <br>
        <div class="mb-3">
       <?php if ($msg!="") { ?>
          <div class="alert alert-danger" role="alert">
          <?php echo $msg; ?>
          </div>  
      <?php } ?>
        <input type="identifiant" name="username" value="<?= $username?>" placeholder="Identifiant" class="form-control"  aria-describedby="emailHelp" aria-required="true" required>
          <input type="password" name="password" value="<?= $password?>" placeholder="Mot de passe" class="form-control"  aria-describedby="emailHelp" aria-required="true" required>
        </div>
        <br>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Créer Compte</button>
    </form>

<?php } ?>




<?php $contenu = ob_get_clean(); ?>
