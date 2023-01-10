<?php $titre = "Mon Blog - Panier"; ?>

<?php ob_start(); ?>

<?php
if (empty($donnees)) {
    echo '<br/><h2> Votre panier est vide :( </h2>';
    //print_r($donnees);
} else { 
    //print_r($donnees);
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
                        <a href="index.php?action=produit&prod_id=<?= $produit['nom'] ?>">
                            <img src="assets/<?= $produit['nom'] ?>.jpg" width="100" height="100" alt="<?= $produit['nom'] ?>">
                        </a>
                    </div>
                    <a href="index.php?action=produit&prod_id=<?= $produit['nom'] ?>" class="text-white"><?= $produit['nom_affichage']?></a>
                </td>

                <td class="align-middle">
                    <div class="prix" value="<?= $produit['prix'] ?>"><?= $produit['prix_affichage'] ?></div>
                </td>


                <td class="align-middle"> 
                    <input type="number" id="qte" name="quantite" value="<?= $produit['qte'] ?>" min="1" placeholder="Qte" onchange="recalculerPanier()" required>
                </td>

                <td class="align-middle">
                    <div class="total_prod"><?= $produit['total_affichage'] ?></div>
                </td>

                <td class="align-middle">
                    
                        <button onclick="window.location.href = 'index.php?action=Panier&suppr_id=<?= $produit['nom'] ?>'" name="boutonSuppr" value="supprimer" class="btn fs-4">X</button>
                </td>
            </tr>
    <?php }
    }
    ?>
    </tbody>
</table>

<h3 id="total">Total de la commande : <?= $donnees['total_general'] ?></h3>

<form method="post" action="index.php?action=Caisse">
    <button name="bouton" value="caisse" class="btn btn-primary btn-lg btn-block m-4">Aller à la caisse</button>
</form>


<script type="text/javascript" src="Scripts/script_calcul_panier.js"></script>

<?php $contenu = ob_get_clean(); ?>

