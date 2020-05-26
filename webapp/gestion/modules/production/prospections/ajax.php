<?php 
namespace Home;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



if ($action == "annulerProspection") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = PROSPECTION::findBy(["id ="=>$id]);
			if (count($datas) == 1) {
				$prospection = $datas[0];
				$data = $prospection->annuler();
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
			}
		}else{
			$data->status = false;
			$data->message = "Votre mot de passe ne correspond pas !";
		}
	}else{
		$data->status = false;
		$data->message = "Vous ne pouvez pas effectué cette opération !";
	}
	echo json_encode($data);
}



if ($action == "validerProspection") {
	$id = getSession("prospection_id");
	$datas = PROSPECTION::findBy(["id ="=>$id]);
	if (count($datas) > 0) {
		$prospection = $datas[0];
		$prospection->actualise();
		$prospection->fourni("ligneprospection");

		$produits = explode(",", $tableau);
		foreach ($produits as $key => $value) {
			$lot = explode("-", $value);
			$array[$lot[0]] = end($lot);
		}
		$tests = $array;


		$produits1 = explode(",", $tableau1);
		foreach ($produits1 as $key => $value) {
			$lot = explode("-", $value);
			$array1[$lot[0]] = end($lot);
		}

		if (count($produits) > 0) {
			$tests = $array;
			foreach ($tests as $key => $value) {
				foreach ($prospection->ligneprospections as $cle => $lgn) {
					if (($lgn->getId() == $key) && ($lgn->quantite >= ($value + $array1[$key]))) {
						unset($tests[$key]);
					}
				}
			}
			if (count($tests) == 0) {
				foreach ($array as $key => $value) {
					foreach ($prospection->ligneprospections as $cle => $lgn) {
						if ($lgn->prixdevente_id == $key) {
							$lgn->quantite_vendu = $value;
							$lgn->perte = $array1[$key];
							$lgn->reste = $lgn->quantite - $value - $array1[$key];
							$lgn->save();

							if ($lgn->reste > 0) {
								$prospection->groupecommande->etat_id = ETAT::ENCOURS;
								$prospection->groupecommande->save();
							}
							break;
						}
					}
				}
				$prospection->hydrater($_POST);
				$data = $prospection->terminer();
				
			}else{
				$data->status = false;
				$data->message = "Veuillez à bien vérifier les quantités des différents produits, certaines sont incorrectes !";
			}			
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
		}
	}else{
		$data->status = false;
		$data->message = "Une erreur s'est produite lors de l'opération! Veuillez recommencer";
	}
	echo json_encode($data);
}