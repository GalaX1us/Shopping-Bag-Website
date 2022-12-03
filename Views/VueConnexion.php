<?php $title = "Page de connexion"; ?>

<?php ob_start(); ?>
    <h1> Identification client </h1>
    <p> Merci d'entrer votre identifiant et votre mot de passe pour accéder à votre espace client.
        Si vous n'avez pas de compte client, vous pouvez en créer un ici gratuitement ici ! Enregistrement </p>

        <p><input type="text" name="identifiant" placeholder ="ìdentifiant"/></p>
        <p><input type="text" name="MotDePasse" placeholder ="Mot de passe"/></p> </p>

        <p><input type="button" value="Continuer"></p>

<?php $content = ob_get_clean(); ?>
<?php require('VueTemplate.php') ?>