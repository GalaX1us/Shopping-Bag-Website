<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title><?= $title ?></title>
      <link rel="stylesheet" href="../Style/bootstrap-5.2.3-dist/css/bootstrap.css" />
      <link rel="stylesheet" href="../Style/Style.css" />
   </head>

   <body>
      <?php require('VueBarreNavigation.php');?>
      <?= $content ?>

      <footer>
            Blog réalisé avec PHP, HTML5 et CSS.
      </footer>

   </body>
   
</html>

