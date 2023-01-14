<?php $titre = 'ISIWEB4SHOP -' . $produitInfos['name'] .''; ?>

<?php ob_start(); ?>
        <div class="float-start">
        <a href="index.php?action=<?= $_GET['cat']?>" class="text-black" style="text-decoration:none">← Retour</a>
        </div>

        <div class="produitMulti m-5">
        <div class="image_produit">
            <img src="assets/<?= $produitInfos['image']?>" alt="<?= $produitInfos['name']?>" class="rounded my-auto">
        </div>
        <div class="description_produit m-3 my-auto">
            <h3><?= $produitInfos['name']?></h3>
            <p><?= $produitInfos['description']?></p>
            <strong>Prix : <?= $produitInfos['price']?>€</strong>
            <?php
            if ($produitInfos['quantity']<=0){
                $lien = '#';
            }else{
                $lien = 'index.php?action=PanierProd&prod_id=' . $produitInfos['id'] . '&cat='.$_GET['cat'].'';
            }
            echo '<form class="row m-3" method="post" action="'. $lien .'" >';
            ?>
            
            <input type="number" class="form-control col" name="qte" value="1" min="1" max="<?= $produitInfos['quantity'] ?>" placeholder="Quantité" required>
            <?php
            if ($produitInfos['quantity']<=0){
                echo'<button type="submit" class="btn btn-primary mt-3" disabled>Rupture de Stock</button>';
            }else{
                echo '<button type="submit" class="btn btn-primary mt-3">Ajouter au Panier</button>';
            }
            ?>    
            </form>

            
        </div>
    </div>

    <h2>Avis</h2>

    <hr class="bg-primary border-3 border-top border-primary">
    <?php foreach ($reviewsInfos as $review) { ?>
        <div class="card text-white bg-primary mb-3">
            
            <div class="card-header ">
                <div class="float-start">
                    <img class="rounded" style="height: 8vh" src="assets/<?= $review['photo_user']?>" alt="<?= $review['photo_user']?>">
                <span class="m-2"><?= $review['name_user']?></span> 
                <?php
                    for ($i = 0; $i < $review['stars']; $i++) {
                    echo '<img style="height: 3vh" src="assets/review_star.png" alt="star">';
                    }
                    for ($i = 0; $i < 5-$review['stars']; $i++) {
                        echo '<img style="height: 3vh" src="assets/review_grey.png" alt="star">';
                        }
                ?>
                </div>
        </div>
            <div class="card-body">
                <h4 class="card-title"><?= $review['title']?></h4>
                <p class="card-text"><?= $review['description']?></div>
        </div>
    <?php }?>
    
     
<?php $contenu = ob_get_clean(); ?> 