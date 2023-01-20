<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


require_once 'Modele.php';
require_once 'Delivery_addresses.php';
require_once 'Orders.php';
require_once 'Misc/fpdf/fpdf.php';

class Facture extends fpdf
{
    private $nom_facture;
    private $idPanier;
    private $commande;
    private $panier;

    private $addressInfos;

    function __construct()
    {
        parent::__construct();

    }


    public function generer_facture(){

        $date = date('Y-m-d');
        $nom_facture = "$date-WEB4SHOP$this->idPanier-Facture.pdf"; //nom de la facture
        
        //Pour le tableau
        $header = array("Nom du produit", "Quantité", "Prix unitaire", "Sous total");
        $taille = array(90, 30, 35, 35);
        $tab_commande = array();
        
        $cmd = new Order();
        $cmd->connect();
        $idPanier = $cmd->getIdOrderByStatus($_SESSION['id'], 2);
        $idPanier = end($idPanier)[0];
        $panier = $cmd->getPanier($idPanier);
        $commande = $cmd->getOrder($idPanier);

        foreach ($panier as $ligne){
            $tab = array($ligne['name'], $ligne['quantity'], $ligne['price'], $ligne['quantity']*$ligne['price']);
            array_push($tab_commande, $tab);
        }

        //Récupération de l'adresse        
        $info_commande = array("Numéro de facture : ".$idPanier, "Date de la commande : ".$commande['date']);

        $addresse = new Delivery_adress();
        $addresse->connect();
        $addressInfos = $addresse->getDeliveryAddressFromOrder($idPanier);

        //Execution du script de création du PDF
        ob_start(); 
        $this->SetTitle("Facture");
        $this->AddPage();
        $this->SetFont('Helvetica','',1);
        $this->Ln();
        $ref = $this->ecritEnteteFacture($addressInfos, $info_commande);
        $this->SetLeftMargin(10);
        $this->ImprovedTable($header, $taille, $tab_commande, $ref);
        $this->Output('D', $nom_facture, true);
        ob_end_flush();
    }


    //Fonctions pour convertir en "windows-1252" pour la gestion des accents
    private function c_str($string){
        return iconv('UTF-8', 'windows-1252', $string);
    }

    private function c_tab($tab){
        $n_tab = array();
        foreach($tab as $cle => $val){
            $n_tab[$cle] = $this->c_str($val);
        }
        return $n_tab;
    }


    //Fonction pour écrire l'adresse sur le PDF 
    function ecritEnteteFacture($adresse, $info_commande, $hauteur = 40, $s_ligne = 6){
        //formatage des paramètres :
        $adresse = $this->c_tab($adresse);
        $info_commande = $this->c_tab($info_commande);
        
        //Paramètres d'écritures 
        $hauteur_ref = $hauteur;
        $this->SetFont('Helvetica','',13);
        $this->setTextColor(0,0,0);
        $this->SetLeftMargin(25);

        //Ecriture de l'adresse
        $this->SetY($hauteur);
        $hauteur += $s_ligne;
        $this->Cell(80, 0, $adresse['firstname']." ".$adresse['lastname'], 0, 1);
        $this->SetY($hauteur);
        $hauteur +=  $s_ligne;
        $this->Cell(80, 0, $adresse['add1'], 0,1);
        if($adresse['add2']!=""){
            $this->SetY($hauteur);
            $hauteur +=  $s_ligne;
            $this->Cell(80, 0, $adresse['add2'], 0,1);
        }
        $this->SetY($hauteur);
        $hauteur +=  $s_ligne;
        $this->Cell(80, 0, $adresse['postcode']." ".$adresse['city'], 0, 1);
        $this->SetY($hauteur);
        $hauteur +=  $s_ligne;
        $this->Cell(80, 0, $this->c_str("Téléphone : ").$adresse['phone'], 0, 1); 
        
        //Ecriture des infos de la commande
        $this->SetLeftMargin(110);
        $this->SetY($hauteur_ref);
        $this->Cell(80, 0, $info_commande[0], 0, 1);
        $this->SetY($hauteur_ref +  $s_ligne);
        $this->Cell(80, 0, $info_commande[1], 0, 1);
        return $hauteur;
    }

    //Header (surcharge)
    function Header(){
        // Logo
        $this->Image('assets/cup-cake.png',10,6,25);
        // Police Arial gras 15
        $this->SetFont('Helvetica','',24);
        $this->SetTextColor(0, 0, 0);
        // Décalage à droite
        $this->Cell(80);
        // Titre
        $this->Cell(30,10,$this->nom_facture, 0);
        // Saut de ligne
        $this->Ln(10);
        $this->SetDrawColor(0, 0, 0);
        //$this->Line(30, 26, 180, 26);
        $this->Ln(20);
    }


    // Pied de page
    function Footer()
    {
        $this->Line(30, 283, 180, 283);
        // Positionnement à 1,5 cm du bas
        $this->SetY(-15);
        // Police Arial italique 8
        $this->SetFont('Arial','I',8);
        // Numéro de page
        $this->Cell(0,10,$this->PageNo(),0,0,'C');
    }

    // Tableau amélioré
    //Contrainte, size doit faire la même taille qu'header
    function ImprovedTable($header, $size, $data, $ref){
        //Parametre
        $hauteur_deb = $ref + 10;
        $this->SetY($hauteur_deb);
        $this->SetTextColor(15,15,15);
        $this->SetX(10);

        // En-tête
        $this->SetFillColor(169, 169, 169);
        $header = $this->c_tab($header);
        $this->SetFont('Helvetica','B',14);
        for($i=0;$i<count($header);$i++){
            $this->Cell($size[$i],7,$header[$i],0,0,'',1);
        }
        $this->Ln();

        // Données
        
        $this->SetFont('Helvetica','',14);
        $total = 0;
        foreach($data as $row)
        {
            $row = $this->c_tab($row);
            $total = $total + $row[3];
            $this->SetFillColor(211, 211, 211); //Jaune
            
            
            //$this->Cell("size", "hauteur", "contenu", "border", "ln", "align", "fill")
            $this->Cell($size[0],6,$row[0], 0, 0, '', 1);
            $this->Cell($size[1],6,$row[1], 0, 0, '', 1);
            $this->Cell($size[2],6,$row[2], 0, 0, '', 1);
            $this->Cell($size[3],6,$row[3], 0, 0, '', 1);
            $this->Ln();
        }
        $pos = $this->getY();
        $this->Line(20, $pos + 5, 190, $pos + 5);
        $this->SetY($pos + 10);
        $this->Cell(50, 0, "Total   :");
        $this->SetXY(-20, $pos + 10);
        $this->Cell(20, 0, $total);
    }
}