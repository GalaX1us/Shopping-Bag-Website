<?php $titre = 'ISIWEB4SHOP - Erreur'; ?>

<?php ob_start();?>

<br />
<p>Une erreur est survenue : <?= $msgErreur ?></p>
<br />
<button onclick="window.location.href = 'index.php'" name="boutonSuppr" class="btn btn-primary btn-lg btn-block">Retour à l'accueil</button>
<?php $contenu = ob_get_clean(); ?> 