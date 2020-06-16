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


?>