<?php
namespace Home;
use Native\RESPONSE;/**
 * 
 */
class VENTE extends TABLE
{

	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	public $reference;
	public $typevente_id;
	public $groupecommande_id = null;
	public $zonedevente_id;
	public $commercial_id     = COMMERCIAL::MAGASIN;
	public $etat_id           = ETAT::ENCOURS;
	public $employe_id        = null;
	public $operation_id      = null;
	
	public $montant           = 0;
	public $vendu             = 0;

	public $dateretour;
	public $comment;

	

	public function enregistre(){
		$data = new RESPONSE;
		$datas = ZONEDEVENTE::findBy(["id ="=>$this->zonedevente_id]);
		if (count($datas) == 1) {
			$datas = COMMERCIAL::findBy(["id ="=>$this->commercial_id, "disponibilite_id ="=>DISPONIBILITE::LIBRE]);
			if (count($datas) == 1) {
				$commercial = $datas[0];
				$this->employe_id = getSession("employe_connecte_id");
				$this->reference = "BVE/".date('dmY')."-".strtoupper(substr(uniqid(), 5, 6));
				$data = $this->save();
				if ($this->commercial_id != COMMERCIAL::MAGASIN) {
					$commercial->disponibilite_id = DISPONIBILITE::MISSION;
					$commercial->save();
				}
			}else{
				$data->status = false;
				$data->message = "veuillez selectionner un véhicule pour la vente!";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors de l'enregistrement de la vente!";
		}
		return $data;
	}



	//les livraions programmées du jour
	public static function programmee(String $date){
		return static::findBy(["DATE(dateretour) ="=>$date, "etat_id !="=>ETAT::ANNULEE]);
	}


	//les livraions effectuéez du jour
	public static function effectuee(String $date){
		return static::findBy(["DATE(dateretour) ="=>$date, "etat_id ="=>ETAT::VALIDEE]);
	}


	// Supprimer toutes les ventes programmée qui n'ont pu etre effectuée...
	public static function ResetProgramme(){
		$datas = VENTE::findBy(["etat_id ="=>ETAT::PARTIEL, "DATE(dateretour) <"=>dateAjoute()]);
		foreach ($datas as $key => $vente) {
			$vente->fourni("lignedevente");
			foreach ($vente->lignedeventes as $key => $value) {
				$value->delete();
			}
			$vente->delete();
		}
		
		// $requette = "DELETE FROM vente WHERE etat_id = ? AND DATE(dateretour) < ? ";
		// static::query($requette, [ETAT::PARTIEL, dateAjoute()]);
	}


	public function chauffeur(){
		if ($this->vehicule_id == VEHICULE::AUTO) {
			return "...";
		}else if ($this->vehicule_id == VEHICULE::TRICYCLE) {
			return $this->nom_tricycle;
		}else{
			return $this->chauffeur->name();
		}
	}


	public function vehicule(){
		if ($this->vehicule_id == VEHICULE::AUTO) {
			return "SON PROPRE VEHICULE";
		}else if ($this->vehicule_id == VEHICULE::TRICYCLE) {
			return "TRICYCLE";
		}else{
			return $this->vehicule->name();
		}
	}



	public function annuler(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::ANNULEE;
			$this->historique("La vente en reference $this->reference vient d'être annulée !");
			$data = $this->save();
			if ($data->status) {
				$this->actualise();
				$this->groupecommande->etat_id = ETAT::ENCOURS;
				$this->groupecommande->save();

				if ($this->chauffeur_id > 0) {
					$this->chauffeur->etatchauffeur_id = ETATCHAUFFEUR::RAS;
					$this->chauffeur->save();
				}

				$this->vehicule->etat_id = ETATVEHICULE::RAS;
				$this->vehicule->save();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cette vente !";
		}
		return $data;
	}



	public function terminer(){
		$data = new RESPONSE;
		if ($this->etat_id == ETAT::ENCOURS) {
			$this->etat_id = ETAT::VALIDEE;
			$this->dateretour = date("Y-m-d H:i:s");
			$this->historique("La vente en reference $this->reference vient d'être terminé !");
			$data = $this->save();
			if ($data->status) {
				$this->actualise();
				if ($this->chauffeur_id > 0) {
					$this->chauffeur->etatchauffeur_id = ETATCHAUFFEUR::RAS;
					$this->chauffeur->save();
				}

				$this->vehicule->etatvehicule_id = ETATVEHICULE::RAS;
				$this->vehicule->save();

				$this->groupecommande->etat_id = ETAT::ENCOURS;
				$this->groupecommande->save();
			}
		}else{
			$data->status = false;
			$data->message = "Vous ne pouvez plus faire cette opération sur cette vente !";
		}
		return $data;
	}



	public static function perte(string $date1, string $date2){
		$total = 0;
		$datas = VENTE::findBy(["etat_id ="=>ETAT::VALIDEE, "DATE(dateretour) >= " => $date1, "DATE(dateretour) <= " => $date2]);
		foreach ($datas as $key => $vente) {
			$lots = $vente->fourni("lignedevente");
			foreach ($lots as $key => $ligne) {
				$total += $ligne->quantite - $ligne->quantite_vendu;
			}
		}
		return $total;
	}



	public function montant(){
		$total = 0;
		$datas = $this->fourni("lignedevente");
		foreach ($datas as $key => $ligne) {
			$ligne->actualise();
			$total += $ligne->prixdevente->prix->price * $ligne->quantite;
		}
		return $total;
	}


	public function payer(int $montant, Array $post){
		$data = new RESPONSE;
		$solde = $this->reste;
		if ($solde > 0) {
			if ($solde >= $montant) {
				$payement = new OPERATION();
				$payement->hydrater($post);
				if ($payement->modepayement_id != MODEPAYEMENT::PRELEVEMENT_ACOMPTE) {
					$payement->categorieoperation_id = CATEGORIEOPERATION::PAYE_TRICYLE;
					$payement->manoeuvre_id = $this->getId();
					$payement->comment = "Réglement de la paye de tricycle ".$this->chauffeur()." pour la commande N°".$this->reference;
					$data = $payement->enregistre();
					if ($data->status) {
						$this->reste -= $montant;
						$this->isPayer = 1;
						$data = $this->save();
					}
				}else{
					$data->status = false;
					$data->message = "Vous ne pouvez pas utiliser ce mode de payement pour effectuer cette opération !";
				}
			}else{
				$data->status = false;
				$data->message = "Le montant à verser est plus élévé que sa paye !";
			}
		}else{
			$data->status = false;
			$data->message = "Vous etes déjà à jour pour la paye de ce tricycle !";
		}
		return $data;
	}


	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}


}
?>