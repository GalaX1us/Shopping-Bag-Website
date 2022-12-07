<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8" />
      <title><?= $title ?></title>
      <link href="../bootstrap5/css/bootstrap.css" rel="stylesheet" /> 
   </head>

   <body>
      <?php require('VueBarreNavigation.php');?>
      <?= $content ?>
   </body>
</html>