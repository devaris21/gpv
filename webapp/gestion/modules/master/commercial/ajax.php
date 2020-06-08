<?php 
namespace Home;
use Native\ROOTER;
require '../../../../../core/root/includes.php';

use Native\RESPONSE;

$data = new RESPONSE;
extract($_POST);



if ($action == "acompte") {
	$datas = EMPLOYE::findBy(["id = "=>getSession("employe_connecte_id")]);
	if (count($datas) > 0) {
		$employe = $datas[0];
		$employe->actualise();
		if ($employe->checkPassword($password)) {
			$datas = FOURNISSEUR::findBy(["id=" => $fournisseur_id]);
			if (count($datas) > 0) {
				$fournisseur = $datas[0];
				$data = $fournisseur->crediter(intval($montant), $_POST);
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'opération, veuillez recommencer !";
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



if ($action == "filtrer") {
	$datas = COMMERCIAL::findBy(["id ="=>getSession("commercial_id")]);
	if (count($datas) == 1) {
		$commercial = $datas[0];
		$date1 = $annee."-".($mois+1)."-"."01";
		$date2 = $annee."-".($mois+2)."-"."01";

		$datas = $commercial->rapports($date1, $date2);
		foreach ($commercial->rapports(date("Y-m")."-01", dateAjoute()) as $key => $item) { ?>
			<tr>
				<td><?= datecourt3($item->date) ?></td>
				<td><?= start0($item->count) ?> prospection(s)</td>
				<td class="gras text-muted"><?= money($item->montant) ?> <?= $params->devise ?></td>
				<td class="gras text-green"><?= money($item->vendu) ?> <?= $params->devise ?></td>
			</tr>
		<?php }
	}else{ ?>
		<h2 style="margin-top: 15% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune prospection dans cette période pour ce commercial !</h2>
	<?php }
}




