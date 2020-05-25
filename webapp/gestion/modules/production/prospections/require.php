<?php 
namespace Home;

$title = "GPV | Toutes les ventes en cours";

$prospections = VENTE::findBy(["etat_id !="=>ETAT::ANNULEE, "typevente_id ="=>TYPEVENTE::PROSPECTION]);


?>