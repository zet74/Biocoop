<?php


namespace Controller;

use Model\Data\GestionnaireBDD;

class PromotionController extends Controleur
{
    private  $leGestionnaire; // instance de la classe GestionnaireBDD
    public function __construct() {
    $leGestionnaire = new GestionnaireBDD(); 	// connexion du serveur web à la base de données
    }

/* retourne toutes les promotions d’un mois et d’une année donnés. Si les paramètres ne sont pas
donnés dans l’URI alors $mois et $annee contiendront respectivement  le mois et l’année courants */
    public function lister($mois, $annee) {
        $lesPromotions = $this->leGestionnaire->getLesPromotions($mois, $annee);
        $reponse = count($lesPromotions) . " promotions pour le mois choisi.";
        // -------- création du flux JSON en sortie ------------
        // 1-construction d'un tableau contenant les promotions
        // une promotion est représentée par un tableau associatif
        $lesLignesDuTableau = array();
        foreach ($lesPromotions as $unePromotion) {
        // ajoute une ligne promotion dans le tableau $lesLignesDuTableau
            $uneLigne = array();
            $uneLigne["id"] = $unePromotion->getId();
            $uneLigne["libelle"] = $unePromotion->getLibelle();
            $uneLigne["mois"] = $unePromotion->getMois();
            $uneLigne["annee"] = $unePromotion->getAnnee();
            $uneLigne["idFamille"] = $unePromotion->getLaFamille()->getId();
            $lesLignesDuTableau[] = $uneLigne;
        }
        // 2-construction de l'élément "promotions" avec un tableau associatif, ensemble de paires
        // clé => valeur
        $eltPromotions = ["promotions" => $lesLignesDuTableau];
        // 3-construction de l'élément "data"
        $eltData = [ "reponse" => $reponse, "donnees" => $eltPromotions];
        // 4-construction de la racine
        $eltRacine = ["data" => $eltData];
        // 5-retourne le code statut 200 et un contenu JSON construit à partir du tableau associatif $eltRacine
        $this->output()->setStatus(200) ;
        $this->output()->setContentType("application/json") ;
        $this->output()->setContent(json_encode($eltRacine));
    }
}