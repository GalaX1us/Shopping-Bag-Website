<?php $titre = "Mon Blog - Panier"; ?>

<?php ob_start(); ?>

<?php
if (empty($donnees)) {
    echo '<br/><h2> Votre panier est vide :( </h2>';
} else { ?>
<br><h2> Votre panier :</h2>
<table class="table table-borderless table-responsive card-1 p-4 mt-3">
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
        <?php


        $total_general = 0;
        $i = 0;
        foreach ($donnees as $produit) {

            ///////////////////////////////// A déplacer dans le controleur je pense
            $i++;
            $nom = $produit['nom'];
            $nom_affichage = ucwords(implode(' ',preg_split('/(?=[A-Z])/', $nom))); // abricotsSecs -> Abricots Secs
            $prix = $produit['prix'];
            $prix_str = str_replace(".", ",", $prix); //on remplace le . par , (plus joli)
            $qte = $produit['qte'];
            $total = $prix * $qte;
            $total_general += $total;
            $total_str = str_replace(".", ",", $total);
            /////////////////////////////////

            ?>
            <tr class="border-bottom">

                <td class="align-middle">
                    <?= $i  ?>
                </td>

                <td class="align-middle">
                    <div class="img-fluid">
                        <a href="index.php?action=produit&nom=<?= $nom ?>">
                            <img src="assets/<?= $nom ?>.jpg" width="100" height="100" alt="<?= $nom ?>">
                        </a>
                    </div>
                    <a href="index.php?action=produit&nom=<?= $nom ?>"><?= $nom_affichage?></a>
                </td>

                <td class="align-middle">
                    <?= $prix_str ?>&euro;
                </td>

                <!-- Reste à gérer les modifications des totaux quand on modifie les quantités -->
                <td class="align-middle"> 
                    <input type="number" name="quantite-<?= $nom ?>" value="<?= $qte ?>" min="1" placeholder="Quantité" required>
                </td>

                <td class="align-middle">
                    <?= $total_str ?>&euro;
                </td>

                <td class="align-middle">
                    
                        <button onclick="window.location.href = 'index.php?action=Panier&suppr_id=<?= $nom ?>'" name="boutonSuppr" value="supprimer" class="btn fs-4">X</button>
                </td>
            </tr>
    <?php }
    }
    ?>
    </tbody>
</table>

<h3>Total de la commande : <?= str_replace(".", ",", $total_general) ?>&euro;</h3>

<form method="post" action="index.php?action=Caisse">
    <button name="bouton" value="caisse" class="btn btn-primary btn-lg btn-block">Aller à la caisse</button>
</form>

<?php $contenu = ob_get_clean(); ?>