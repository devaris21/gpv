<?php 
namespace Home;
unset_session("produits");
unset_session("commande-encours");

$params = PARAMS::findLastId();

GROUPECOMMANDE::etat();
VENTE::ResetProgramme();

$title = "GPV | Tableau de bord";

$tableau = [];
foreach (PRIXDEVENTE::getAll() as $key => $pdv) {
	$pdv->actualise();
	$data = new \stdclass();
	$data->name = $pdv->produit->name()." -- ".$pdv->prix->price()/*." ".$params->devise*/;
	$data->livrable = $pdv->livrable();
	$data->attente = $pdv->enAttente();
	$data->commande = $pdv->commandee();
	if (!($data->livrable==0 && $data->attente==0 && $data->commande==0)) {
		$tableau[] = $data;
	}	
}

foreach (OPERATION::enAttente() as $key => $item) {
	$item->actualise();
	if ($item->categorieoperation->typeoperationcaisse->getId() == TYPEOPERATIONCAISSE::SORTIE) {
		$item->etat_id == ETAT::VALIDEE;
		$item->save();
	}
}

foreach (APPROVISIONNEMENT::findBy(["etat_id ="=>ETAT::VALIDEE]) as $key => $item) {
	if ($item->getId() != 1) {
		$item->datelivraison == dateAjoute(-1);
		$item->save();
	}
}

?>