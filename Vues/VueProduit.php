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

    <?php foreach ($reviewsInfos as $review) { ?>
        <div class="card text-white bg-primary mb-3">
            
            <div class="card-header">
                <div class="float-start">
                    <img class="rounded" style="height: 8vh" src="assets/<?= $review['photo_user']?>" alt="<?= $review['photo_user']?>">
                <?= $review['name_user']?>
                <?php
                    $etoile = '';
                    for ($i = 0; $i < $review['stars']; $i++) {
                        $etoile = $etoile . '⭐';
                    }
                    echo $etoile
                ?>
                </div>
        </div>
            <div class="card-body">
                <h4 class="card-title"><?= $review['title']?></h4>
                <p class="card-text"><?= $review['description']?></div>
        </div>
    <?php }?>
    
     
<?php $contenu = ob_get_clean(); ?> 