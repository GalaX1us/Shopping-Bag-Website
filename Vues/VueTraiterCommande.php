<?php $titre = 'ISIWEB4SHOP - Traiter commande'; ?>

<?php ob_start(); ?>
<br />
<h1>Commande n°<?= $id?></h1>
<div class="row">
<?php 
foreach ($produits as $produits) { ?>
    <hr class="bg-primary border-3 border-top border-primary">

    <div class="row my-2" >

    <div class="col-6 col-md-3">
        <img src="assets/<?= $produits['image']?>" alt="<?= $produits['name']?>" class="img-fluid rounded my-auto">
    </div>

     <div class="col-6 my-auto mx-auto">
        <h4><?= $produits['name']?></h4>
        <p>Quantité : <?= $produits['quantity']?></p>
    </div>
    </div>
 
<?php } ?>
</div>
<hr class="bg-primary border-3 border-top border-primary">

<div class="row">
    <div>
        <form method="post" action="index.php?action=ActionCommande&id=<?=$id?>">
            <button class="btn btn-primary mt-3" name="valider" value="valider">Valider la commande</button>
        </form>
    </div>
</div>
<?php $contenu = ob_get_clean(); ?> 