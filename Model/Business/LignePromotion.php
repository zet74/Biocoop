<?php


namespace Model\Business;


class LignePromotion
{
    private $dateDebut;	// la date de début de la promotion pour le produit
    private $dateFin;	// la date de fin de la promotion pour le produit
    private $tarif;	// le tarif du produit pendant la promotion
    private $leProduit;	// le produit concerné par la ligne (objet Produit)
    // le constructeur
    public function __construct($unProduit, $uneDateDebut, $uneDateFin, $unTarif) {

    }
    // les accesseurs
    public function getDateDebut()	{return $this->dateDebut;}
    public function getDateFin()	{return $this->dateFin;}
    public function getTarif()	{return $this->tarif;}
    public function getLeProduit()	{return $this->leProduit;}
    /* méthode qui retourne le pourcentage de réduction appliqué au prix lors de la promotion.
     Ce  pourcentage est calculé ainsi : 100 * (tarif de base – tarif de promotion)/ tarif de base    */
    public function getPourcentageReduction()
    {  // à reporter et à compléter sur votre copie
    }

}