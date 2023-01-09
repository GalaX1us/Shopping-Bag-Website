<?php $titre = 'Mon Blog -' . $nomCategorie .''; ?>

<?php ob_start(); ?>
    <?php
    foreach ($produitsInfos as $produit) {?>
        <div class="produitMulti m-5">
        <div class="image_produit">
            <img src="assets/<?= $produit['image']?>" alt="<?= $produit['name']?>">
        </div>
        <div class="description_produit">
            <h3><?= $produit['name']?></h3>
            <p><?= $produit['description']?></p>
            <strong>Prix : <?= $produit['price']?>€</strong>

            <form method="post" action="index.php?action=Produit&prod_id=<?= $produit['id']?>" >
                <button class="btn btn-primary">Acheter</button>
            </form>
        </div>
    </div>

    <?php }
    ?>
     
<?php $contenu = ob_get_clean(); ?> 