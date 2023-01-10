<?php $titre = 'Mon Blog - ' . $nomCategorie .''; ?>

<?php ob_start(); ?>
    <h2><?= $nomCategorie?></h3>
    <?php
    foreach ($produitsInfos as $produit) {?>
    <hr class="bg-primary border-3 border-top border-primary">
        <div class="produitMulti m-5 my-auto">
        <div class="image_produit">
            <img class="rounded" src="assets/<?= $produit['image']?>" alt="<?= $produit['name']?>">
        </div>
        <div class="description_produit m-3 my-auto">
            <h3><?= $produit['name']?></h3>
            <p><?= $produit['description']?></p>
            <strong>Prix : <?= $produit['price']?>€</strong>

            <form method="post" action="index.php?action=Produit&prod_id=<?= $produit['id']?>" >
                <button class="btn btn-primary mt-3">Acheter</button>
            </form>
        </div>
    </div>
    

    <?php }?>
     
<?php $contenu = ob_get_clean(); ?> 