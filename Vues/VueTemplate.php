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
      <div class="container-fluid d-flex flex-column min-vh-100">

         <?php require('VueBarreNavigation.php');?>

         <main class="p-3 flex-grow-1" style="min-height:50vh">             
            <?= $contenu ?>
         </main>

         <footer class="page-footer font-small mt-auto  bg-primary">
         <div class="text-align-left text-white py-3 px-3  d-flex justify-content-between">
            Site web réalisé avec PHP, HTML5 et CSS.
            <a href="#" class="ms-md-auto text-white">Retour en haut ↑</a>
         </div>
         
         </footer>

         <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

      </div>
   </body>

</html>
<?php $contenu = ob_get_clean(); ?> 

