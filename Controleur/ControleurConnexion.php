<?php 
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'Vues/Vue.php';
require_once 'Modeles/Logins.php';
class ControleurConnexion
{
    private $msg = "";
    public function __construct()
    {

    }

    // Affiche la page de connexion du blog
    public function connexion()
    {
      
        if (isset($_POST['username']) && isset($_POST['password'])) 
        {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $this->connecter($username,$password);
        }
        if (isset($_POST['bouton'])&& $_POST['bouton'] == "deconnexion") 
        {
            $this->deconnecter();
        }

        $vue = new Vue("Connexion");
        $connecte = $this->est_connecte();
        if (isset($_SESSION['admin']))
        {
            $admin = $_SESSION['admin'];
        }
        else
        {
            $admin = false;
        }
        $nom = $this->get_nom();
        $donnees = array ('connecte' => $connecte, 'nom' => $nom, 'msgErreur' => $this->msg, 'admin' => $admin); 
        $vue->generer($donnees); 
    }
    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
    
    private function deconnecter()
    {
        $_SESSION['connecte'] = FALSE;
        //detruire la session 
        session_destroy();
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
    public function get_nom() 
    {
        if($this->est_connecte() == false)
        {
            return "Vous n'êtes pas connecté";
        }
        else
        {
            $login = new Logins();
            $login->connect();
            try
            {
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true)
                {
                    if (isset($_SESSION['id']))
                    {
                        $result = $login->getNomByIdAdmin($_SESSION['id']);
                    }
                    else
                    {
                        $result = "Vous n'êtes pas connecté";
                    }
                }
                else
                {
                    if (isset($_SESSION['id']))
                    {
                        $result = $login->getNomById($_SESSION['id']);
                    }
                    else
                    {
                        $result = "Vous n'êtes pas connecté";
                    }
                }
                
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
            foreach ($result as $donnees) 
            {
                if (isset($_SESSION['admin']) && $_SESSION['admin'] == true)
                {
                    $_SESSION['name'] = $donnees['username'];
                    return $donnees['username'];
                }
                else
                {
                    $_SESSION['name'] = $donnees['forname'];
                    return $donnees['forname'];
                }
        
            }
        }
        

    }

    public function connecter($username, $password)
    {   
        $msg = "";
        $login = new Logins();
        $login->connect();
        $result = $login->getLogin($username);

        
        if (!empty($result))
        {
            foreach ($result as $donnees)   
            {
                if ($donnees['password'] == $password) {
                    $_SESSION['estConnecte'] = true;
                    $_SESSION['id'] = $donnees['id'];
                    $this->msg ="";
                } 
                else {
                    $this->msg = "identifiant ou mot de passe incorrect";
                }
             
            }
        }
        else
        {
            $result = $login->getAdminByUser($username);
            if (!empty($result))
            {
                foreach ($result as $donnees)   
                {
                    if ($donnees['password'] == $password) {

                        $_SESSION['estConnecte'] = true;
                        $_SESSION['id'] = $donnees['id'];
                        $_SESSION['admin'] = true;
                        $this->msg ="";
                    } 
                    else {
                        $this->msg = "identifiant ou mot de passe incorrect";
                    }
                }
            }

        }
       

        
    }
}