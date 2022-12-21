<?php 

// Récupération des données du formulaire de connexion
$username = $_POST['username'];
$password = $_POST['password'];

require_once '../Modeles/Logins.php';

$login = new logins();
$login->connect();
$result = $login->getLogin($username);

foreach ($result as $donnees) {
    echo "<br>";
    echo $donnees['password']; // affiche le mot de passe de la base de donnée
}

echo "<br>";
echo $password; // affiche le mot de passe entré dans le formulaire
echo "<br>";

if ($donnees['password'] == $password) {
    echo "Vous êtes connecté";
} else {
    echo "Vous n'êtes pas connecté";
}




