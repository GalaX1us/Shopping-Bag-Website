<?php $titre = 'Mon Blog -' . $nomCategorie .''; ?>

<?php ob_start(); ?>
    <?php
    foreach ($produitsInfos as $produit) {
        echo '<main>
        <div class="image_produit">
            <img src="assets/' . $produit['image'] .'" alt="'. $produit['name'] .'">
        </div>
        <div class="description_produit">
            <h3>'. $produit['name'] .'</h3>
            <p>'. $produit['description'] .'</p>
            <strong>Notre prix : '. $produit['price'] .'</strong>
            <a href="#">[Acheter]</a>
        </div>
    </main>';
    }
    
    ?>
     
<?php $contenu = ob_get_clean(); ?> 