<?php $titre = "Mon Blog - Panier"; ?>

<?php ob_start(); ?>

<?php

if ($_GET['action']=='PanierProd'){
    echo '<div class="float-start">
        <a href="index.php?action=' . $_GET['cat'] . '" class="text-black" style="text-decoration:none">← Continuer mes achats</a>
        </div>';
}

if (empty($donnees)) {
    echo '<br/><h2> Votre panier est vide :( </h2>';
} else { 
    //print_r($_SESSION);
    //echo session_id();
    ?>

<br><h2> Votre panier :</h2>
<table class="table table-borderless table-responsive card-1  p-4 mt-4">
    <thead>
        <tr class="border-bottom">
            <th colspan="2"><span class="ml-2">Produit</span></th>
            <th><span class="ml-2">Prix</span></th>
            <th><span class="ml-2">Quantité</span></th>
            <th><span class="ml-2">Total</span></th>
            <th><span class="ml-4">Supprimer</span></th>
        </tr>
    </thead>

    <tbody>
        <?php foreach($donnees['produits'] as $produit) { ?>
            <tr class="border-bottom" name="produit">

                <td class="align-middle">
                    <?= $produit['indice']  ?>
                </td>

                <td class="align-middle">
                    <div class="img-fluid">
                        <a href="index.php?action=Produit&cat=<?= $produit['cat'] ?>&prod_id=<?= $produit['id'] ?>">
                            <img src="assets/<?= $produit['img'] ?>" width="100" height="100" alt="<?= $produit['nom'] ?>">
                        </a>
                    </div>
                    <a href="index.php?action=produit&prod_id=<?= $produit['id'] ?>" class="text-black"><?= $produit['nom']?></a>
                </td>

                <td class="align-middle">
                    <div class="prix" value="<?= $produit['prix'] ?>"><?= $produit['prix_aff'] ?></div>
                </td>


                <td class="align-middle"> 
                    <input type="number" id="qte" name="quantite" value="<?= $produit['qte'] ?>" min="1" max="<?= $produit['qtemax'] ?>" placeholder="Qte" onchange="recalculerPanier()" required>
                </td>

                <td class="align-middle">
                    <div class="total_prod"><?= $produit['total_aff'] ?></div>
                </td>

                <td class="align-middle">
                    
                        <button onclick="window.location.href = 'index.php?action=PanierSuppr&suppr_id=<?= $produit['id'] ?>'" name="boutonSuppr" value="supprimer" class="btn fs-4">X</button>
                </td>
            </tr>
    <?php } ?>
    </tbody>
</table>

<h3 id="total">Total de la commande : <?= $donnees['total_general'] ?></h3>

<form method="post" action="index.php?action=Adresse">
    <button name="bouton" value="caisse" class="btn btn-primary btn-lg btn-block m-4">Aller à la caisse</button>
</form>

<?php } ?>

<!-- Script pour actualiser le total lorsque l'on change la quantité d'un produit -->
<script type="text/javascript" src="Scripts/script_calcul_panier.js"></script>

<?php $contenu = ob_get_clean(); ?>

