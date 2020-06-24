<?php 
namespace Home;

//mise en place de compte courant
$datas = ["Caisse courante"];
foreach ($datas as $key => $value) {
	$item = new COMPTEBANQUE();
	$item->name = $value;
	$item->initial = 700000;
	$item->setProtected(1);
	$item->save();
}

$datas = ["Fonds de commerce"];
foreach ($datas as $key => $value) {
	$item = new COMPTEBANQUE();
	$item->name = $value;
	$item->initial = 5000000;
	$item->setProtected(1);
	$item->save();
}

$datas = ["Caisse d'approvisionnement"];
foreach ($datas as $key => $value) {
	$item = new COMPTEBANQUE();
	$item->name = $value;
	$item->initial = 300000;
	$item->setProtected(1);
	$item->save();
}



$datas = ["Dépôt", "Retrait"];
foreach ($datas as $key => $value) {
	$item = new TYPEMOUVEMENT();
	$item->name = $value;
	$item->setProtected(1);
	$item->save();
}

$datas = ["Amortissement linéaire", "Amortissement dégressif"];
foreach ($datas as $key => $value) {
	$item = new TYPEAMORTISSEMENT();
	$item->name = $value;
	$item->setProtected(1);
	$item->save();
}


$item = new TYPEBIEN();
$item->name = "Magasin / Entrepot / Usine";
$item->min = 15;
$item->max = 50;
$item->setProtected(1);
$item->save();


$item = new TYPEBIEN();
$item->name = "Meubles / Mobiliers";
$item->min = 5;
$item->max = 10;
$item->setProtected(1);
$item->save();


$item = new TYPEBIEN();
$item->name = "Véhicules";
$item->min = 3;
$item->max = 5;
$item->setProtected(1);
$item->save();


$item = new TYPEBIEN();
$item->name = "Materiels industriels / Outillages";
$item->min = 5;
$item->max = 10;
$item->setProtected(1);
$item->save();


$item = new TYPEBIEN();
$item->name = "Materiels informatiques";
$item->min = 2;
$item->max = 5;
$item->setProtected(1);
$item->save();


$item = new TYPEBIEN();
$item->name = "Brevets";
$item->min = 3;
$item->max = 5;
$item->setProtected(1);
$item->save();


$item = new TYPEBIEN();
$item->name ="Logiciels / Sites internet";
$item->min = 2;
$item->max = 3;
$item->setProtected(1);
$item->save();



$datas = ["Immobilisation corporelle", "Immobilisation incorporelle", "Immobilisation financière"];
foreach ($datas as $key => $value) {
	$item = new TYPEIMMOBILISATION();
	$item->name = $value;
	$item->setProtected(1);
	$item->save();
}



//ajustement 
foreach (OPERATION::findBy(["categorieoperation_id ="=>CATEGORIEOPERATION::VENTE]) as $key => $ope) {
	$reglementclient = new REGLEMENTCLIENT();
	$reglementclient->cloner($ope);
	$reglementclient->setId(null);
	$data = $reglementclient->enregistre();
	if ($data->status) {
		foreach ($ope->fourni("vente") as $key => $vente) {
			$vente->reglementclient_id = $reglementclient->getId();
			$vente->save();
			$ope->delete();
		}
		foreach ($ope->fourni("commande") as $key => $commande) {
			$commande->reglementclient_id = $reglementclient->getId();
			$commande->save();
			$ope->delete();
		}
	}
}


foreach (OPERATION::findBy(["categorieoperation_id ="=>CATEGORIEOPERATION::APPROVISIONNEMENT]) as $key => $ope) {
	$reglementfour = new REGLEMENTFOURNISSEUR();
	$reglementfour->cloner($ope);
	$reglementfour->setId(null);
	$data = $reglementfour->enregistre();
	if ($data->status) {
		foreach ($ope->fourni("approvisionnement") as $key => $vente) {
			$vente->reglementfournisseur_id = $reglementfour->getId();
			$vente->save();
			$ope->delete();
		}
	}
}


foreach (OPERATION::findBy(["categorieoperation_id ="=>CATEGORIEOPERATION::PAYE]) as $key => $ope) {
	$pay = new PAYE();
	$pay->cloner($ope);
	$pay->setId(null);
	$data = $pay->enregistre();
	if ($data->status) {
		$ope->delete();
	}
}


foreach (OPERATION::findBy(["categorieoperation_id >="=>15, "categorieoperation_id <="=>17]) as $key => $ope) {
	$pay = new MOUVEMENT();
	$pay->cloner($ope);
	$pay->comptebanque_id = COMPTEBANQUE::FONDCOMMERCE;
	$pay->typemouvement_id = TYPEMOUVEMENT::RETRAIT;
	$pay->setId(null);
	$data = $pay->enregistre();
	var_dump($data);
	if ($data->status) {
		$ope->delete();
	}
}

QUANTITE::query("UPDATE prixdevente SET quantite_id = 1 WHERE prix_id <= 3");
QUANTITE::query("UPDATE prixdevente SET quantite_id = 3 WHERE prix_id = 4 ");
QUANTITE::query("UPDATE prixdevente SET quantite_id = 4 WHERE prix_id > 4 ");

PRODUIT::query("UPDATE produit SET isActive = 1");
QUANTITE::query("UPDATE quantite SET isActive = 1");
//QUANTITE::query("DELETE FROM prixdevente WHERE isActive = 0 ");


?>