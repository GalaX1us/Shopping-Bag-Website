<?php 
require_once 'Vues/Vue.php';
require_once 'Modeles/Logins.php';
class ControleurConnexion
{
    public function __construct()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $_SESSION['connecte'] = FALSE; // à remplacer par le tableau qui passe par le routeur avec la focntion est_connecte

        if (isset($_POST['username']) && isset($_POST['password'])) 
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->connecter($username,$password);
        }
        //$this->connexion();
        

    }

    // Affiche la page de connexion du blog
    public function connexion()
    {
        $vue = new Vue("Connexion");
        $connecte = $this->est_connecte();
        $donnees = array ('connecte' => $connecte); 
        $vue->generer($donnees); 
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }

    public function est_connecte(): bool // fonction qui vérifie si l'utilisateur est connecté
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_SESSION['estConnecte'])) {
            return $_SESSION['estConnecte'];
        } else {
            return false;
        }
      }
    public function connecter($username, $password)
    {
        $login = new Logins();
        $login->connect();
        try {
            $result = $login->getLogin($username);
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if (!empty($result))
        {
            foreach ($result as $donnees) // c'est bizarre d'utiliser un foreach pour un seul résultat mais ça enlève un bug, à revenir dessus
            {
                if ($donnees['password'] == $password) {
                    echo "Vous êtes connecté";
                    $_SESSION['estConnecte'] = true;
                    $_SESSION['username'] = $donnees['id'];
                } 
                else {
                    echo "identifiant ou mot de passe incorrect";
                    echo $donnees['password'];
                }
             
            }
            

        }
        
    }
}