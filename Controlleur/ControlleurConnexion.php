<?php 

// Récupération des données du formulaire de connexion
$username = $_POST['username'];
$password = $_POST['password'];

require_once '../Modeles/Logins.php';


$login = new Login();
$user = $login->getLogin($username);


echo $user[2]; //debug

