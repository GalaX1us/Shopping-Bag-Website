<?php $titre = 'Mon Blog - Boissons'; ?>

<?php ob_start(); ?>
    <main>
        <div class="image_produit">
            <img src="assets/theImperial.jpg" alt="Image du thé impérial.">
        </div>
        <div class="description_produit">
            <h3>Thé Impérial</h3>
            <p>Sachet de thé de qualité supérieure. 200 sachets par boîte</p>
            <strong>Notre prix : 4.99€</strong>
            <a href="#">[Acheter]</a>
        </div>
    </main>
<?php $contenu = ob_get_clean(); ?> 