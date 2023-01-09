<?php 
require_once 'ControleurAccueil.php';
require_once 'ControleurProduitsMulti.php';
require_once 'ControleurConnexion.php';
require_once 'ControleurPanier.php';
require_once 'ControleurCreerCompte.php';
require_once 'Vues/Vue.php';

class Routeur
{
    private $ctrlAccueil;
    private $ctrlProduitsMulti;
    private $ctrlConnexion;
    private $ctrlPanier;
    private $ctrlCreerCompte;

    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlProduitsMulti = new ControleurProduitsMulti();
        $this->ctrlConnexion = new ControleurConnexion();
        $this->ctrlPanier = new ControleurPanier();
        $this->ctrlCreerCompte = new ControleurCreerCompte();
    }
    // Traite une requête entrante
    public function routerRequete()
    {
        //$this->ctrlAccueil->accueil();

        try {
            if (isset($_GET['action'])) {
                switch($_GET['action']) {
                    case 'Boissons': case 'Biscuits': case 'FruitsSecs':
                        $this->ctrlProduitsMulti->ProduitsMulti($_GET['action']);
                        break;
                    case 'CreerCompte':
                        $this->ctrlCreerCompte->creerCompte();
                        break;
                    case 'Connexion':
                        $this->ctrlConnexion->connexion();
                        break;
                    case 'Panier':
                        if(isset($_GET['suppr_id'])) $this->ctrlPanier->suppr_produit($_GET['suppr_id']);
                        $this->ctrlPanier->panier();
                        break;
                    default:
                        throw new Exception("Action non valide.");
                }
            }
            else {
                $this->ctrlAccueil->accueil();
            }
        }
        catch (Exception $e) {
            $this->erreur($e->getMessage());
        }

        //$this->erreur("Test erreur");

        /*try {
            if (isset($_GET['action'])) {
                /*if ($_GET['action'] == 'billet') {
                    if (isset($_GET['id'])) {
                        $idBillet = intval($_GET['id']);
                        if ($idBillet != 0) {
                            $this->ctrlBillet->billet($idBillet);
                        } else throw new Exception("Identifiant de billet non valide");
                    } else throw new Exception("Identifiant de billet non défini");
                } else throw new Exception("Action non valide");
            } else {
                // aucune action définie : affichage de l'accueil
                $this->ctrlAccueil->accueil();
            }
        } catch (Exception $e) {
            $this->erreur($e->getMessage());
        }*/
    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}
