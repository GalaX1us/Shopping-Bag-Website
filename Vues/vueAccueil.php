<?php $titre = 'ISIWEB4SHOP -Accueil'; ?>

<?php ob_start(); ?>
    <span class="d-flex justify-content-center"><h2>Bienvenue sur ISIWEB4SHOP</h2>
</span>
<span class="d-flex justify-content-center"><h5>Vous trouverez ici une sélection gourmande de produits pour se régaler pendant les fêtes</h5>
</span>
    <br>
    <div class="row">
        <div class="col-12 col-md-4 my-2">
        <a href="index.php?action=Boissons" style="text-decoration:none">
        <img class="w-75 rounded img-fluid d-block m-auto" src="assets/jusCitron.jpg" alt="jus citron">
        <span class="d-flex justify-content-center my-4"><h2>Boissons</h2></span>
        </a>
        </div>
        <div class="col-12 col-md-4 my-2">
        <a href="index.php?action=Biscuits" style="text-decoration:none">
            <img class="w-75 rounded img-fluid d-block m-auto" src="assets/biscuitsCannelle.jpg" alt="biscuits secs">
            <span class="d-flex justify-content-center my-4"><h2>Biscuits</h2></span>
        </a>
        </div>
        <div class="col-12 col-md-4 my-2">
        <a href="index.php?action=FruitsSecs" style="text-decoration:none">
            <img class="w-75 rounded img-fluid d-block m-auto" src="assets/amandes.jpg" alt="amandes">
            <span class="d-flex justify-content-center my-4"><h2>Fruits Secs</h2></span>        
        </a>
    </div>
    </div>
     
<?php $contenu = ob_get_clean(); ?> 