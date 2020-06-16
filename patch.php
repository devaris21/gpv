<?php 
namespace Home;

//mise en place de compte courant
$datas = ["Caisse courante"];
foreach ($datas as $key => $value) {
	$item = new COMPTEBANQUE();
	$item->name = $value;
	$item->setProtected(1);
	$item->save();
}

//ajustement 
OPERATION::execute("UPDATE operation set comptebanque_id = 1", []);


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


?>