<?php 
require_once 'ControleurAccueil.php';
require_once 'ControleurProduitsMulti.php';
require_once 'ControleurConnexion.php';
require_once 'ControleurPanier.php';
require_once 'ControleurCreerCompte.php';
require_once 'ControleurAdresse.php';
require_once 'Vues/Vue.php';
require_once 'ControleurPaiement.php';
class Routeur
{
    private $ctrlAccueil;
    private $ctrlProduitsMulti;
    private $ctrlConnexion;
    private $ctrlPanier;
    private $ctrlCreerCompte;
    private $ctrlAdresse;
    private $ctrlPaiement;

    public function __construct()
    {
        $this->ctrlAccueil = new ControleurAccueil();
        $this->ctrlProduitsMulti = new ControleurProduitsMulti();
        $this->ctrlConnexion = new ControleurConnexion();
        $this->ctrlPanier = new ControleurPanier();
        $this->ctrlCreerCompte = new ControleurCreerCompte();
        $this->ctrlAdresse = new ControleurAdresse();
        $this->ctrlPaiement = new ControleurPaiement();
    }
    // Traite une requête entrante
    public function routerRequete()
    {
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
                        if(isset($_GET['suppr_id'])) $this->ctrlPanier->supprProduit($_GET['suppr_id']);
                        $this->ctrlPanier->panier();
                        break;
                    case 'Produit':
                        if(isset($_GET['prod_id'])) $this->ctrlProduitsMulti->Produit($_GET['prod_id']); //a modif
                        else throw new Exception("Produit non valide.");
                        break;
                    case 'Adresse':
                        $this->ctrlAdresse->adresse();
                        break;
                    case 'Paiement':
                        $this->ctrlPaiement->paiement();
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
    }

    // Affiche une erreur
    private function erreur($msgErreur)
    {
        $vue = new Vue("Erreur");
        $vue->generer(array('msgErreur' => $msgErreur));
    }
}
