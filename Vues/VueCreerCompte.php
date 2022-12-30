<?php $titre = "Création d'un compte"; 
require_once 'Controleur/ControleurConnexion.php';
?>

<?php ob_start(); ?>

<p> Merci de remplir le formulaire ci-dessous pour créer votre compte client. </p>

<form method="post" action="index.php?action=CreerCompte"> 
      <div class="mb-3">
        <input type="text" name="name" placeholder="prénom" class="form-control"  aria-describedby="emailHelp">
        <input type="text" name="surname" placeholder="Nom" class="form-control" >
      </div>
      <br>
      <div class="mb-3">
        <input type="text" name="add1" placeholder="Adresse" class="form-control" > 
        <input type="text" name="add2" placeholder="Complément d'adresse" class="form-control" >
        <input type="text" name="city" placeholder="Ville" class="form-control" >
        <input type="text" name="code" placeholder="code postal" class="form-control" >
      </div>
      <br>
      <div class="mb-3">
        <input type="tel" name="phone" placeholder="Numéro de téléphone" class="form-control"  aria-describedby="emailHelp">
        <input type="email" name="email" placeholder="Email" class="form-control" >
      </div>
      <br>
      <div class="mb-3">
      <input type="identifiant" name="username" placeholder="Identifiant" class="form-control"  aria-describedby="emailHelp">
        <input type="password" name="password" placeholder="Mot de passe" class="form-control"  aria-describedby="emailHelp">
      </div>
      <br>
      <button type="submit" class="btn btn-primary btn-lg btn-block">Valider</button>
  </form>


<?php $contenu = ob_get_clean(); ?>
