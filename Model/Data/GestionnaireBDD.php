<?php


namespace Model\Data;


use Model\Business\Promotion;
use PDO;

class GestionnaireBDD
{
    private $cnx;   // la connexion à la base de données (une instance de la classe PDO)

    // constructeur ; il crée la connexion $cnx avec le SGBD
    public function __construct() {
        //...
    }

    // méthode retournant un objet FamilleProduit à partir de son identifiant (ou null si l'identifiant n'existe pas)
    public function getUneFamille($unIdFamille)
    {	// à reporter et à compléter sur votre copie
    }

    // méthode retournant un objet Promotion à partir de son identifiant (ou null si l'identifiant n'existe pas)
    public function getUnePromotion($unIdPromotion) {
        //...
    }

    // méthode retournant les lignes d'une promotion (collection d'objets LignePromotion)
    public function getLesLignesPromotion($unIdPromotion) {
       //...
    }


    // méthode retournant les promotions (collection d'objets Promotion) d'un mois et d'une année donnés
    public function getLesPromotions($unMois, $uneAnnee)
    {
        // préparation de la requête avec 2 paramètres mm et aa (précédés du caractère : )
        $txtReq = "Select id, libelle, idFamille from Promotion where mois = :mm and annee = :aa";
        $req = $this->cnx->prepare($txtReq);
        // valorisation des 2 paramètres mm et aa de type integer puis exécution de la requête SQL
        $req->bindValue("mm", $unMois, PDO::PARAM_INT);
        $req->bindValue("aa", $uneAnnee, PDO::PARAM_INT);
        $req->execute();
        // construction d'une collection d'objets Promotion (un tableau array en PHP)
        $lesPromotions = array();
        // lit la première ligne du résultat de la requête. $uneLigne est une référence à un objet dont les
        // propriétés correspondent aux noms des colonnes de la requête
        // ou bien la valeur booléenne false s’il n’y a plus de ligne à lire dans le jeu de résultats
        $uneLigne = $req->fetch(PDO::FETCH_OBJ);
        while ($uneLigne != false) {
            // création d'un objet Promotion
            $unePromotion = new Promotion($uneLigne->id, $uneLigne->libelle, $unMois, $uneAnnee, $this->getUneFamille($uneLigne->idFamille),
                $this->getLesLignesPromotion($uneLigne->id));
            // ajout de l'objet à la collection
            $lesPromotions[ ] = $unePromotion;
            // lit la ligne suivante sous forme d'objet
            $uneLigne = $req->fetch(PDO::FETCH_OBJ);
        }
        $req->closeCursor();	// libère les ressources du jeu de données
        return $lesPromotions;	// fournit la collection
    }
}