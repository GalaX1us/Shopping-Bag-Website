<?php $title = "Page de test pour comprendre les templates"; ?>

<?php ob_start(); ?> <!-- cette ligne à enregistrer dans la mémoire 
tampon tout ce que le code html qui suit affiche-->
<h1>Lorem ipsumadipisicing elit.</h1>
<p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. At animi a distinctio! Obcaecati, sapiente ut fugiat nulla maiores provident. Maxime, error? Sunt temporibus reprehenderit ipsam quidem molestias recusandae officiis impedit.</p>

<?php $content = ob_get_clean(); ?> <!-- cette ligne récupère tout ce qui a été enregistré dans la mémoire tampon et le stocke dans la variable $content -->

<?php require('VueTemplate.php') ?> <!-- cette ligne affiche le template avec le contenu de la variable $content et $title et on pourrait éventuellement 
rajouter d'autres variables si on a besoin de plus de modularité -->