<?php 
namespace Home;

$title = "GPV | Toutes les livraisons en cours";

$livraisons = VENTE::findBy(["etat_id !="=>ETAT::PARTIEL]);
$total = 0;
foreach ($livraisons as $key => $liv) {
	if ($liv->etat_id == ETAT::ENCOURS) {
		$total++;
	}
}

?>