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
	public $stock = 0;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = PRODUIT::findBy(["id ="=>$this->produit_id]);
		if (count($datas) == 1) {
			$datas = PRIX::findBy(["id ="=>$this->prix_id]);
			if (count($datas) == 1) {
				$data = $this->save();
				if ($data->status) {
					$ligne = new LIGNEPRODUCTIONJOUR();
					$ligne->productionjour_id = 1;
					$ligne->prixdevente_id = $data->lastid;
					$ligne->production = 0;
					$ligne->setCreated(PARAMS::DATE_DEFAULT);
					$ligne->save();
				}
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



	public function name()
	{
		return $this->produit->name()." / ".$this->prix->price;
	}


	public function stock(String $date){
		$total = 0;
		$requette = "SELECT SUM(production) as production FROM ligneproductionjour, prixdevente, productionjour WHERE ligneproductionjour.prixdevente_id = prixdevente.id AND prixdevente.id = ? AND ligneproductionjour.productionjour_id = productionjour.id AND DATE(productionjour.ladate) <= ? GROUP BY prixdevente.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), $date]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		$total += $item[0]->production;


		$requette = "SELECT SUM(quantite) as quantite  FROM lignedevente, prixdevente, vente WHERE lignedevente.prixdevente_id = prixdevente.id AND lignedevente.vente_id = vente.id AND prixdevente.id = ? AND vente.etat_id != ?  AND vente.etat_id != ? AND DATE(vente.created) <= ? GROUP BY prixdevente.id";
		$item = LIGNEDEVENTE::execute($requette, [$this->getId(), ETAT::ANNULEE, ETAT::PARTIEL, $date]);
		if (count($item) < 1) {$item = [new LIGNEDEVENTE()]; }
		$total -= $item[0]->quantite;

		return $total + intval($this->stock);
	}



	public function production(string $date1 = "2020-04-01", string $date2){
		$requette = "SELECT SUM(production) as production  FROM ligneproductionjour, prixdevente WHERE ligneproductionjour.prixdevente_id = prixdevente.id AND prixdevente.id = ? AND DATE(ligneproductionjour.created) >= ? AND DATE(ligneproductionjour.created) <= ? GROUP BY prixdevente.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		return $item[0]->production;
	}


	public function perte(string $date1 = "2020-04-01", string $date2){
		$total = 0;

		$requette = "SELECT SUM(perte) as perte  FROM ligneprospection, prixdevente, prospection WHERE ligneprospection.prixdevente_id = prixdevente.id AND prixdevente.id = ? AND ligneprospection.prospection_id = prospection.id AND prospection.etat_id != ? GROUP BY prixdevente.id";
		$item = LIGNEPROSPECTION::execute($requette, [$this->getId(), ETAT::ANNULEE]);
		if (count($item) < 1) {$item = [new LIGNEPROSPECTION()]; }
		$total += $item[0]->perte;

		return $total;
	}
	


	public function vendu(string $date1 = "2020-04-01", string $date2){
		$total = 0;
		$requette = "SELECT SUM(quantite_vendu) as quantite_vendu  FROM ligneprospection, prixdevente, prospection WHERE ligneprospection.prixdevente_id = prixdevente.id AND ligneprospection.prospection_id = prospection.id AND prixdevente.id = ? AND prospection.etat_id != ? AND DATE(ligneprospection.created) >= ? AND DATE(ligneprospection.created) <= ? GROUP BY prixdevente.id";
		$item = LIGNEPROSPECTION::execute($requette, [$this->getId(), ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEPROSPECTION()]; }
		$total += $item[0]->quantite_vendu;

		$requette = "SELECT SUM(quantite) as quantite  FROM lignedevente, prixdevente, vente WHERE lignedevente.prixdevente_id = prixdevente.id AND lignedevente.vente_id = vente.id AND prixdevente.id = ? AND vente.etat_id != ? AND DATE(lignedevente.created) >= ? AND DATE(lignedevente.created) <= ? GROUP BY prixdevente.id";
		$item = LIGNEDEVENTE::execute($requette, [$this->getId(), ETAT::ANNULEE, $date1, $date2]);
		if (count($item) < 1) {$item = [new LIGNEDEVENTE()]; }
		$total += $item[0]->quantite;

		return $total;
	}



	public function commandee(){
		$total = 0;
		$datas = GROUPECOMMANDE::encours();
		foreach ($datas as $key => $comm) {
			$total += $comm->reste($this->getId());
		}
		return $total;
	}



	public function enBoutique(){
		$datas = $this->fourni("miseenboutique", ["etat_id !="=>ETAT::ANNULEE]);
		$total = comptage($datas, "quantite", "somme");

		$requette = "SELECT SUM(quantite_vendu) as perte  FROM ligneprospection, prixdevente, prospection WHERE ligneprospection.prixdevente_id = prixdevente.id AND prixdevente.id = ? AND ligneprospection.prospection_id = prospection.id AND prospection.etat_id != ? AND prospection.typeprospection_id = ? GROUP BY prixdevente.id";
		$item = LIGNEPROSPECTION::execute($requette, [$this->getId(), ETAT::ANNULEE, TYPEPROSPECTION::LIVRAISON]);
		if (count($item) < 1) {$item = [new LIGNEPROSPECTION()]; }
		$total -= $item[0]->perte;

		$requette = "SELECT SUM(perte) as perte  FROM ligneprospection, prixdevente, prospection WHERE ligneprospection.prixdevente_id = prixdevente.id AND prixdevente.id = ? AND ligneprospection.prospection_id = prospection.id AND prospection.etat_id != ? GROUP BY prixdevente.id";
		$item = LIGNEPROSPECTION::execute($requette, [$this->getId(), ETAT::ANNULEE]);
		if (count($item) < 1) {$item = [new LIGNEPROSPECTION()]; }
		$total -= $item[0]->perte;

		$requette = "SELECT SUM(quantite) as quantite  FROM lignedevente, prixdevente, vente WHERE lignedevente.prixdevente_id = prixdevente.id AND prixdevente.id = ? AND lignedevente.vente_id = vente.id AND vente.etat_id IN (?, ?) GROUP BY prixdevente.id";
		$item = LIGNEDEVENTE::execute($requette, [$this->getId(), ETAT::ENCOURS, ETAT::VALIDEE]);
		if (count($item) < 1) {$item = [new LIGNEDEVENTE()]; }
		$total -= $item[0]->quantite;

		$total -= $this->enProspection();

		return $total;
	}



	public function enProspection(){
		$requette = "SELECT SUM(quantite) as quantite  FROM ligneprospection, prixdevente, prospection WHERE ligneprospection.prixdevente_id = prixdevente.id AND prixdevente.id = ? AND ligneprospection.prospection_id = prospection.id AND prospection.etat_id = ? GROUP BY prixdevente.id";
		$item = LIGNEDEVENTE::execute($requette, [$this->getId(), ETAT::ENCOURS]);
		if (count($item) < 1) {$item = [new LIGNEDEVENTE()]; }
		return $item[0]->quantite;
	}



	public function enStock(){
		$requette = "SELECT SUM(production) as production  FROM ligneproductionjour, prixdevente, productionjour WHERE ligneproductionjour.prixdevente_id = prixdevente.id AND prixdevente.id = ? AND ligneproductionjour.productionjour_id = productionjour.id AND productionjour.etat_id = ? GROUP BY prixdevente.id";
		$item = LIGNEPRODUCTIONJOUR::execute($requette, [$this->getId(), ETAT::PARTIEL]);
		if (count($item) < 1) {$item = [new LIGNEPRODUCTIONJOUR()]; }
		$a =  $item[0]->production;

		$datas = $this->fourni("miseenboutique");
		$b = comptage($datas, "quantite", "somme");

		return $a - $b + intval($this->stock);
	}



	public function stockGlobal(){
		return $this->enBoutique() + $this->enStock();
	}


	public static function rupture(){
		$params = PARAMS::findLastId();
		$datas = static::findBy(["isActive ="=>TABLE::OUI]);
		foreach ($datas as $key => $item) {
			if ($item->enStock() > $params->ruptureStock) {
				unset($datas[$key]);
			}
		}
		return $datas;
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
			$pro = PRODUCTIONJOUR::today();
			$datas = LIGNEPRODUCTIONJOUR::findBy(["productionjour_id ="=>$pro->getId(), "prixdevente_id ="=>$pdv->getId()]);
			if (count($datas) == 0) {
				$ligne = new LIGNEPRODUCTIONJOUR();
				$ligne->productionjour_id = $pro->getId();
				$ligne->prixdevente_id = $pdv->getId();
				$ligne->enregistre();
			}			
		}
		return $this->save();
	}



	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}
}

?>