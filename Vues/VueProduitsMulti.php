<?php $titre = 'ISIWEB4SHOP - ' . $nomCategorie .''; ?>

<?php ob_start(); ?>

    <h2><?= $nomCategorie?></h2 >
    <?php
    foreach ($produitsInfos as $produit) {?>
    <hr class="bg-primary border-3 border-top border-primary">
    <div class="row m-4 g-1">
        <div class="col-12 col-md-3">
            <a href="index.php?action=Produit&cat=<?= $cat?>&prod_id=<?= $produit['id']?>">
            <img class="img-fluid rounded" src="assets/<?= $produit['image']?>" alt="<?= $produit['name']?>"></a>
        </div>
        <div class="col-12 col-md-8 p-3">
            <a href="index.php?action=Produit&cat=<?= $cat?>&prod_id=<?= $produit['id']?>"><h3><?= $produit['name']?></h3></a>
            <p><?= $produit['description']?></p>
            <strong>Prix : <?= $produit['price']?>€</strong>

            <form method="post" action="index.php?action=Produit&cat=<?= $cat?>&prod_id=<?= $produit['id']?>" >
                <button class="btn btn-primary mt-3">Voir le Produit</button>
            </form>
        </div>
    </div>
    
    <?php }?>
     
<?php $contenu = ob_get_clean(); ?> 