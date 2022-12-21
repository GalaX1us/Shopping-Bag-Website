<?php ob_start(); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title><?= $titre ?></title>
      <link rel="stylesheet" href="Style/bootstrap-5.2.3-dist/css/bootstrap.css" />
      <link rel="stylesheet" href="Style/Style.css" />
   </head>

   <body>
      <?php require('VueBarreNavigation.php');?>
      
      <?= $contenu ?>

      <footer>
            Blog réalisé avec PHP, HTML5 et CSS.
      </footer>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   </body>
   
</html>
<?php $contenu = ob_get_clean(); ?> 

