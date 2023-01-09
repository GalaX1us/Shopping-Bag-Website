<?php $titre = 'Mon Blog -' . $produitInfos['name'] .''; ?>

<?php ob_start(); ?>
        <div class="produitMulti m-5">
        <div class="image_produit">
            <img src="assets/<?= $produitInfos['image']?>" alt="<?= $produitInfos['name']?>">
        </div>
        <div class="description_produit">
            <h3><?= $produitInfos['name']?></h3>
            <p><?= $produitInfos['description']?></p>
            <strong>Prix : <?= $produitInfos['price']?>€</strong>

            <input type="number" name="quantite" value="1" min="1" placeholder="Quantité" required>
                
            <form method="post" action="index.php?action=produit&prod_id=<?= $produitInfos['id']?>" >
                <button class="btn btn-primary">Acheter</button>
            </form>
        </div>
    </div>
     
<?php $contenu = ob_get_clean(); ?> 