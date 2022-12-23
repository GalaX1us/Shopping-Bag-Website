<?php
// session_start();


// // Récupération des données du formulaire de connexion
// $username = $_POST['username'];
// $password = $_POST['password'];

// require_once 'Modeles/Logins.php';

// $login = new Logins();
// $login->connect();
// try {
//     $result = $login->getLogin($username);
// } catch (Exception $e) {
//     echo $e->getMessage();
// }


// if (!empty($result)) {
//     foreach ($result as $donnees) {
//         // echo "<br>";
//         echo $donnees['password']; // affiche le mot de passe de la base de donnée
//         // echo "<br>";
//         // echo $password; // affiche le mot de passe du formulaire
//         // echo "<br>";
//         // echo $donnees['id']; // affiche l'id de la base de donnée
//         // echo "<br>";
//     }
    
    
//     if ($donnees['password'] == $password) {
//         //echo "Vous êtes connecté";
//         $_SESSION['estConnecte'] = true;
//         $_SESSION['username'] = $donnees['id'];
//         header('Location:../index.php?action=accueil');
//     } else {
//         //echo "identifiant ou mot de passe incorrect";
//     }

// }


