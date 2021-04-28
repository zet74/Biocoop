<?php


namespace Model\Business;


class Produit
{
    private $reference;	// la référence du produit
    private $designation;	// la désignation du produit
    private $tarif;	// le tarif du produit
    private $laFamille;	// la famille du produit (objet FamilleProduit)
    // le constructeur
    public function __construct($uneReference, $uneDesignation, $unTarif, $uneFamille) {

    }
    // les accesseurs
    public function getReference()	{return $this->reference;}
    public function getTarif()	{return $this->tarif;}

}