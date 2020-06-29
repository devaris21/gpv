<?php 
namespace Home;

unset_session("ressources");

unset_session("produits");
unset_session("commande-encours");


if ($this->getId() != null) {
	$datas = COMMERCIAL::findBy(["id ="=> $this->getId()]);
	if (count($datas) > 0) {
		$commercial = $datas[0];
		$commercial->actualise();

		$prospections = $commercial->fourni("prospection", ["etat_id ="=>ETAT::ENCOURS]);

		$commercial->fourni("prospection");



		$fluxcaisse = $commercial->fourni("operation");
		usort($fluxcaisse, "comparerDateCreated2");

		$title = "GPV | ".$commercial->name();

		session("commercial_id", $commercial->getId());
		
	}else{
		header("Location: ../master/commercials");
	}
}else{
	header("Location: ../master/commercials");
}
?>