
<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$titre = 'ISIWEB4SHOP - Admin'; ?>

<?php ob_start(); 

if (isset($_SESSION['admin']) && ($_SESSION['admin']==true))
{ 
?><h1> vous êtes sur la page administrateur 😎</h1>
<?php 
foreach ($commandes as $d) {
?>
    <div class="Commande">
    <hr class="bg-primary border-3 border-top border-primary">
        <div>
            Date : <?= $d['date'] ?>  <br>
            Paiement : <?= $d['payment_type'] ?>  <br>
            Total : <?=  $d['total'] ?> € <br>
            Adresse : <?= $d['add1'] ?>  <?= $d['add2']?>  <?= $d['city'] ?> <?= $d['postcode']?> <br>
            Client :  <?= $d['firstname'] ?>  <?= $d['lastname']?> 
        </div>

        <div>
            <form method="post" action="index.php?action=admin">
                <button class="btn btn-primary mt-3">Voir la commande</button>
            </form>
        </div>
    </div>
<?php   
}


}
else
{ ?>
    <h1> Tu arrêtes de modifier l'url oh ! :( </h1>
<?php } ?>




   
     
<?php $contenu = ob_get_clean(); ?> 