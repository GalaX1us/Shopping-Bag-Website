<?php $titre = 'ISIWEB4SHOP - Traiter commande'; ?>

<?php ob_start(); ?>
<br />
<h1>Commande n°<?= $id?></h1>
<hr class="bg-primary border-3 border-top border-primary">
<div class="row">
<?php 
foreach ($produits as $produits) { ?>
    <div class="col-1">
        <img src="assets/<?= $produits['image']?>" alt="<?= $produits['name']?>" class="img-fluid rounded my-auto">
    </div>

     <div class="col-3">
        <h4><?= $produits['name']?></h4>
        <p>Quantité : <?= $produits['quantity']?></p>
        
    </div>
    
<?php } ?>
</div>
<hr class="bg-primary border-3 border-top border-primary">


<div class="row">
    <div>
        <form method="post" action="index.php?action=ActionCommande&id=<?=$id?>">
            <button class="btn btn-primary mt-3" name="valider" value="valider" >Valider la commande</button>
            <button class="btn btn-primary mt-3" name="refuser" value="refuser">Refuser la commande</button>
        </form>
    </div>
</div>
<?php $contenu = ob_get_clean(); ?> 