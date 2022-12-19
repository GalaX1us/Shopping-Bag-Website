<?php 

// Récupération des données du formulaire de connexion
$username = $_POST['username'];
$password = $_POST['password'];

require_once '../Modeles/Logins.php';



echo $username; //debug
echo $password; //debug

echo "toto"; //debug

require_once '../Modeles/Logins.php';



// // Connexion à la base de données
// $db = new PDO('mysql:host=localhost;dbname=mydb', 'user', 'password');

// // Vérification des identifiants
// $req = $db->prepare('SELECT id FROM users WHERE username = :username AND password = :password');
// $req->execute(array(
//     'username' => $username,
//     'password' => $password));

// $result = $req->fetch();

// if (!$result) {
//     // Mauvais identifiants
//     echo 'Mauvais identifiants';
// } else {
//     // Identifiants corrects
//     echo 'Identifiants corrects';
