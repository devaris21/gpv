<?php
namespace Home;
use Native\RESPONSE;
use Native\EMAIL;
use Carbon\Carbon;
/**
 * 
 */
class AMORTISSEMENT extends TABLE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $typeamortissement_id = TYPEAMORTISSEMENT::LINEAIRE;
	public $immobilisation_id;
	public $duree;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = TYPEAMORTISSEMENT::findBy(["id ="=>$this->typeamortissement_id]);
		if (count($datas) == 1) {
			$datas = IMMOBILISATION::findBy(["id ="=>$this->immobilisation_id]);
			if (count($datas) == 1) {
				$immobilisation = $datas[0];
				if ($this->duree > 0 ) {
					$data = $this->save();
					if ($data->status ) {
						$diff = date("Y", strtotime($this->started)) - date("Y");
						if ($diff > 0) {
							if ($amortissement->typeamortissement_id == TYPEAMORTISSEMENT::LINEAIRE) {
								$annuite = round(($immobilisation->montant * (1 / $this->duree)), 2);

							}else if($amortissement->typeamortissement_id == TYPEAMORTISSEMENT::DEGRESSIF) {
								if ($this->duree < 4) {
									$taux = 1.25;
								}elseif ($this->duree < 6) {
									$taux = 1.75;
								}else{
									$taux = 2.25;
								}

								$annuite = round(($immobilisation->montant * (1 / $this->duree) * $taux), 2);
							}
							$ligne = new LIGNEAMORTISSEMENT();
							$ligne->amortissement_id = $this->getId();
							$ligne->montant = $annuite * (dateDiffe($this->started, date("Y")."-01-01") / 360);
							$data = $ligne->enregistre();
							if ($data->status) {
								$ligne->restait = $immobilisation->resteAmortissement();
								$ligne->save();
							}
						}
					}
				}else{
					$data->status = false;
					$data->message = "Le nombre d'année pour l'amortissement n'est pas correcte !";
				}
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors de l'ajout du produit !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'ajout du produit !";
		}
		return $data;
	}


	public static function encours(){
		return static::findBy(["etat_id ="=>ETAT::ENCOURS, "visibility = "=>1]);
	}
	

	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::ANNULEE;
			$this->datelivraison = date("Y-m-d H:i:s");
			$this->historique("L'approvisionnement en reference $this->reference vient d'être annulée !");
			$data = $this->save();
			if ($data->status) {
				$this->actualise();
				if ($this->operation_id > 0) {
					$this->operation->supprime();
					$this->fournisseur->dette -= $this->montant - $this->avance;
					$this->fournisseur->save();
				}else{
						//paymenet par prelevement banquaire
					$this->fournisseur->acompte += $this->avance;
					$this->fournisseur->dette -= $this->montant - $this->avance;
					$this->fournisseur->save();
				}
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cet approvisionnement !";
		}
		return $data;
	}



	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::VALIDEE;
			$this->employe_id_reception = getSession("employe_connecte_id");
			$this->datelivraison = date("Y-m-d H:i:s");
			$this->historique("L'approvisionnement en reference $this->reference vient d'être terminé !");
			$data = $this->save();
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cet approvisionnement !";
		}
		return $data;
	}


	
	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}

}



?>