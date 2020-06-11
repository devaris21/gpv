<?php 
namespace Home;
if ($this->getId() > 0) {
	$id = $this->getId();
}else{
	$id = 7;
}
$produits = PRODUIT::getAll();

$tableau = [];
foreach (PRODUIT::getAll() as $key => $produit) {
	$tab = [];
	foreach ($produit->fourni('prixdevente', ["isActive ="=>TABLE::OUI]) as $key => $pdv) {
		$pdv->actualise();
		$data = new \stdclass();
		$data->id = $pdv->getId();
		$data->pdv = $pdv;
		$pdv->tab = [];

		$data->name = $pdv->produit->name()." // ".$pdv->prix->price()/*." ".$params->devise*/;
		$data->prix = $pdv->prix->price();
		$data->boutique = $pdv->enBoutique(dateAjoute());
		$data->stock = $pdv->enEntrepot(dateAjoute());
		$data->commande = $pdv->commandee();
		if (!($data->boutique==0 && $data->stock==0 && $data->commande==0)) {
			$tab[] = $data;
		}	
	}
	$tableau[$produit->getId()] = $tab;
}

$productionjours = PRODUCTIONJOUR::findBy([],[],["ladate"=>"DESC"], $id);
usort($productionjours, 'comparerLadate');

$title = "GPV | Stock de la production ";

$lots = [];
?>