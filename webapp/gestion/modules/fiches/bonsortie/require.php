<?php 

namespace Home;

if ($this->getId() != null) {
	$datas = VENTE::findBy(["id ="=> $this->getId(), 'etat_id !='=>ETAT::ANNULEE]);
	if (count($datas) > 0) {
		$prospection = $datas[0];
		$prospection->actualise();

		$prospection->fourni("lignedevente");

		$title = "GPV | Bon de vente ";
		
	}else{
		header("Location: ../master/clients");
	}
}else{
	header("Location: ../master/clients");
}

?>