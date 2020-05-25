<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class PRIXDEVENTE extends TABLE
{
	
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $produit_id;
	public $prix_id;
	public $isActive = TABLE::OUI;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = PRODUIT::findBy(["id ="=>$this->produit_id]);
		if (count($datas) == 1) {
			$datas = PRIX::findBy(["id ="=>$this->prix_id]);
			if (count($datas) == 1) {
				$data = $this->save();
			}else{
				$data->status = false;
				$data->message = "Une erreur s'est produite lors du prix !";
			}
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors du prix !";
		}
		return $data;
	}




	public function stock(String $date){
		$total = 0;
		$requette = "SELECT SUM(production) - SUM(perte) as production  FROM ligneproductionjour, produit, productionjour WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND ligneproductionjour.productionjour_id = productionjour.id AND DATE(productionjour.ladate) <= ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), $date]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		$total += $item[0]->production;


		$requette = "SELECT SUM(quantite) as quantite  FROM lignedevente, produit, vente WHERE lignedevente.produit_id = produit.id AND lignedevente.vente_id = vente.id AND produit.id = ? AND vente.etat_id != ?  AND vente.etat_id != ? AND DATE(vente.created) <= ? GROUP BY produit.id";
		$item = LIGNEDEVENTE::execute($requette, [$this->getId(), ETAT::ANNULEE, ETAT::PARTIEL, $date]);
		if (count($item) < 1) {$item = [new LIGNEDEVENTE()]; }
		$total -= $item[0]->quantite;

		return $total;
	}



	public function production(string $date1 = "2020-04-01", string $date2){
		$requette = "SELECT SUM(production) as production  FROM ligneproductionjour, produit WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND DATE(ligneproductionjour.created) >= ? AND DATE(ligneproductionjour.created) <= ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		return $item[0]->production;
	}


	public function perte(string $date1 = "2020-04-01", string $date2){
		$total = 0;

		$requette = "SELECT SUM(perte) as perte FROM ligneproductionjour, produit WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND DATE(ligneproductionjour.created) >= ? AND DATE(ligneproductionjour.created) <= ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		$total += $item[0]->perte;

		$requette = "SELECT SUM(quantite)-SUM(quantite_vendu) as quantite FROM lignedevente, produit, vente WHERE lignedevente.produit_id = produit.id AND lignedevente.vente_id = vente.id AND vente.etat_id != ? AND produit.id = ? AND DATE(lignedevente.created) >= ? AND DATE(lignedevente.created) <= ? GROUP BY produit.id";
		$item = LIGNEDEVENTE::execute($requette, [ETAT::ANNULEE, $this->getId(), $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEDEVENTE()]; }
		$total -= $item[0]->quantite;

		return $total;
	}
	

	public function livree(string $date1 = "2020-04-01", string $date2){
		$requette = "SELECT SUM(quantite_vendu) as quantite_vendu  FROM lignedevente, produit, vente WHERE lignedevente.produit_id = produit.id AND lignedevente.vente_id = vente.id AND produit.id = ? AND vente.etat_id != ? AND DATE(lignedevente.created) >= ? AND DATE(lignedevente.created) <= ? GROUP BY produit.id";
		$item = LIGNEDEVENTE::execute($requette, [$this->getId(), ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEDEVENTE()]; }
		return $item[0]->quantite_vendu;
	}



	public function commandee(){
		$total = 0;
		$datas = GROUPECOMMANDE::encours();
		foreach ($datas as $key => $comm) {
			$total += $comm->reste($this->getId());
		}
		return $total;
	}


	public function livrable(){
		$total = 0;

		$requette = "SELECT SUM(production) - SUM(perte) as production  FROM ligneproductionjour, produit, productionjour WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND ligneproductionjour.productionjour_id = productionjour.id AND productionjour.etat_id = ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), ETAT::VALIDEE]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		$total += $item[0]->production;


		$requette = "SELECT SUM(quantite) as quantite  FROM lignedevente, prixdevente, produit, vente WHERE lignedevente.prixdevente_id = prixdevente.id AND prixdevente.produit_id = produit.id AND lignedevente.vente_id = vente.id AND produit.id = ? AND vente.etat_id IN (?, ?) GROUP BY produit.id";
		$item = LIGNEDEVENTE::execute($requette, [$this->getId(), ETAT::ENCOURS, ETAT::VALIDEE]);
		if (count($item) < 1) {$item = [new LIGNEDEVENTE()]; }
		$total -= $item[0]->quantite;

		if ($total < 0) {
			return 0;
		}
		return $total;
	}



	public function enAttente(){
		$total = 0;
		$requette = "SELECT SUM(production) - SUM(perte) as production  FROM ligneproductionjour, produit, productionjour WHERE ligneproductionjour.produit_id = produit.id AND produit.id = ? AND ligneproductionjour.productionjour_id = productionjour.id AND productionjour.etat_id = ? GROUP BY produit.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), ETAT::PARTIEL]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		return $item[0]->production;
	}



	public function exigence(int $quantite, int $ressource_id){
		$datas = EXIGENCEPRODUCTION::findBy(["produit_id ="=>$this->getId(), "ressource_id ="=>$ressource_id]);
		if (count($datas) == 1) {
			$item = $datas[0];
			if ($item->quantite_produit == 0) {
				return 0;
			}
			return ($quantite * $item->quantite_ressource) / $item->quantite_produit;
		}
		return 0;
	}


	public function coutProduction(String $type, int $quantite){
		if(isJourFerie(dateAjoute())){
			$datas = PAYEFERIE_PRODUIT::findBy(["produit_id ="=>$this->getId()]);
		}else{
			$datas = PAYE_PRODUIT::findBy(["produit_id ="=>$this->getId()]);
		}
		if (count($datas) > 0) {
			$ppr = $datas[0];
			switch ($type) {
				case 'production':
				$prix = $ppr->price;
				break;
				
				case 'rangement':
				$prix = $ppr->price_rangement;
				break;

				case 'vente':
				$prix = $ppr->price_vente;
				break;

				default:
					$prix = $ppr->price;
				break;
			}
			return $quantite * $prix;
		}
		return 0;
	}



	public function changerMode(){
		if ($this->isActive == TABLE::OUI) {
			$this->isActive = TABLE::NON;
		}else{
			$this->isActive = TABLE::OUI;
		}
		return $this->save();
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}
}

?>