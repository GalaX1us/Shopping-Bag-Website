
<?php 
$titre = 'ISIWEB4SHOP - Admin'; ?>

<?php ob_start(); 


?><h1>Liste des commandes à traiter</h1>
<?php 
foreach ($commandes as $c) {
?>
    <div class="Commande">
    <hr class="bg-primary border-3 border-top border-primary">
        <div>
            Date : <?= $c['date'] ?>  <br>
            Paiement : <?= $c['payment_type'] ?>  <br>
            Total : <?=  $c['total'] ?> € <br>
            Adresse : <?= $c['add1'] ?>  <?= $c['add2']?>  <?= $c['city'] ?> <?= $c['postcode']?> <br>
            Client :  <?= $c['firstname'] ?>  <?= $c['lastname']?> 
        </div>

        <div>
            <form method="post" action="index.php?action=TraiterCommande&id=<?=$c['id']?> ">
                <button class="btn btn-primary mt-3">Voir la commande</button>
            </form>
        </div>
    </div>
<?php } ?>





   
     
<?php $contenu = ob_get_clean(); ?> 