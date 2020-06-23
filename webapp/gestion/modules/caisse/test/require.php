<?php 
namespace Home;

foreach (OPERATION::findBy(["categorieoperation_id >="=>15, "categorieoperation_id <="=>17]) as $key => $ope) {
	$pay = new MOUVEMENT();
	$pay->cloner($ope);
	$pay->comptebanque_id = COMPTEBANQUE::FONDCOMMERCE;
	$pay->typemouvement_id = TYPEMOUVEMENT::RETRAIT;
	$pay->setId(null);
	$data = $pay->enregistre();
	if ($data->status) {
		$ope->delete();
	}
}


if ($this->getId() != null) {
	$datas = EXERCICECOMPTABLE::findBy(["id ="=> $this->getId()]);
	if (count($datas) > 0) {
		$exercice = $datas[0];
		$exercice->actualise();

		$datas = COMPTEBANQUE::findBy(["id ="=> COMPTEBANQUE::COURANT]);
		$caisse = $datas[0];

		$operations = OPERATION::findBy(["DATE(created) >= "=> dateAjoute(-7)]);
		$entrees = $depenses = [];
		foreach ($operations as $key => $value) {
			$value->actualise();
			if ($value->categorieoperation->typeoperationcaisse_id == TYPEOPERATIONCAISSE::ENTREE) {
				$entrees[] = $value;
			}else{
				$depenses[] = $value;
			}
		}
		$statistiques = OPERATION::statistiques();

		$stats = OPERATION::stats($exercice->created, $exercice->datefin());


		$title = "GPV | Compte de caisse";

	}else{
		header("Location: ../master/clients");
	}
}else{
	header("Location: ../master/clients");
}
?>