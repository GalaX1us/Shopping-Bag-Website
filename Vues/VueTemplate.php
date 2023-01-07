<?php ob_start(); ?>
<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title><?= $titre ?></title>
      <link rel="stylesheet" href="Style/bootstrap-5.2.3-dist/css/bootstrap.css" />
      <link rel="stylesheet" href="Style/Style.css" />
   </head>

   <body class="d-flex min-vh-100">

      <?php require('VueBarreNavigation.php');?>

      <main>
         <?= $contenu ?>
      </main>

      <footer class="position-absolute bottom-0 start-50 translate-middle">
            Blog réalisé avec PHP, HTML5 et CSS.
      </footer>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

   </body>
   
</html>
<?php $contenu = ob_get_clean(); ?> 

