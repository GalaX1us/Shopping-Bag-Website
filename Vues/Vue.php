<?php class Vue
{
    // Nom du fichier associé à la vue
    private $fichier;

    public function __construct($action)
    {
        $this->fichier = "Vues/Vue" . $action . ".php";
    }

    // Génère et affiche la vue
    public function generer($donnees)
    {
        $array_vue = $this->genererFichier($this->fichier, $donnees);
        $vue = $this->genererFichier('Vues/VueTemplate.php', $array_vue)['contenu'];
        echo $vue;
    }

    // Génère un fichier vue et renvoie le résultat produit
    private function genererFichier($fichier, $donnees)
    {
        if (file_exists($fichier)) {
            extract($donnees);
            include $fichier;
            return array('titre' => $titre, 'contenu' => $contenu);
        } else {
            throw new Exception("Fichier '$fichier' introuvable.");
        }
    }   
}
