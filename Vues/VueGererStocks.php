<?php $titre = 'ISIWEB4SHOP - Gerer Stocks'; ?>

<?php ob_start(); ?>

<div class="row">
    <h1>Gestion des stocks </h1>
    <?php
    if (is_array($produits)) {
        foreach ($produits as $produits) { ?>
            <hr class="bg-primary border-3 border-top border-primary">

            <div class="row my-2">

                <div class="col-6 col-md-3">
                    <img src="assets/<?= $produits['image'] ?>" alt="<?= $produits['name'] ?>" class="img-fluid rounded my-auto">
                </div>

                <div class="col-6 my-auto mx-auto">
                    <h4><?= $produits['name'] ?></h4>

                    <form class="row m-3" method="post" action="index.php?action=GererStocks&id=<?= $produits['id'] ?>">

                        <input type="number" class="form-control col" name="qte" value="<?= $produits['quantity'] ?>" min="0" max=100 placeholder="Quantité" required>

                        <button type="submit" class="btn btn-primary mt-3">Changer le stock </button>

                    </form>
                </div>
            </div>
    <?php }
    } ?>
</div>





</div><?php $contenu = ob_get_clean(); ?>