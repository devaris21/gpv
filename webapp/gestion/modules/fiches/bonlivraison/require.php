<?php 

namespace Home;

if ($this->getId() != null) {
	$datas = VENTE::findBy(["id ="=> $this->getId(), 'etat_id !='=>ETAT::ANNULEE]);
	if (count($datas) > 0) {
		$livraison = $datas[0];
		$livraison->actualise();

		$livraison->fourni("lignelivraison");

		$title = "GPV | Bon de livraison ";
		
	}else{
		header("Location: ../master/clients");
	}
}else{
	header("Location: ../master/clients");
}

?>