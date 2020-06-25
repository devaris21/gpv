<?php
namespace Home;
use Native\RESPONSE;
use Native\FICHIER;
use \DateTime;
use \DateInterval;
/**
/**
 * 
 */
class COMMERCIAL extends PERSONNE
{
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;

	const MAGASIN = 1;

	public $name;
	public $nationalite;
	public $adresse;
	public $sexe_id = SEXE::HOMME;
	public $contact;
	public $salaire = 0;
	public $objectif = 0;
	public $image = "default.png";
	
	public $disponibilite_id = DISPONIBILITE::LIBRE;



	public function enregistre(){
		$data = new RESPONSE;
		if ($this->name ) {
			if ($this->salaire >= 0 ) {
				$data = $this->save();
				if ($data->status) {
					$this->uploading($this->files);
				}
			}else{
				$data->status = false;
				$data->message = "Le salaire du chauffeur est incorrect !";
			}
		}else{
			$data->status = false;
			$data->message = "Veuillez le login et le mot de passe du nouvel chauffeur !";
		}
		return $data;
	}


	public function uploading(Array $files){
		//les proprites d'images;
		$tab = ["image"];
		if (is_array($files) && count($files) > 0) {
			$i = 0;
			foreach ($files as $key => $file) {
				if ($file["tmp_name"] != "") {
					$image = new FICHIER();
					$image->hydrater($file);
					if ($image->is_image()) {
						$a = substr(uniqid(), 5);
						$result = $image->upload("images", "commercials", $a);
						$name = $tab[$i];
						$this->$name = $result->filename;
						$this->save();
					}
				}	
				$i++;			
			}			
		}
	}



	public function rapports($date1, $date2)
	{
		$tableau = [];
		for ($i=0; $i < $jours ; $i++) { 
			$date = dateAjoute(-$i);
			$datas = $this->fourni("prospection", ["DATE(created) ="=>$date]);
			$item = new \stdClass();
			if (date('w', strtotime($date)) == 0) {
				$item->date = "";
				$item->count = 0;
				$item->montant = 0;
				$item->vendu = 0;
			}else{
				$item->date = $date;
				$item->count = count($datas);
				$item->montant = comptage($datas, 'montant', "somme");
				$item->vendu = comptage($datas, 'vendu', "somme");
			}			
			$tableau[] = $item;
		}
		return $tableau;
	}



	public static function libres(){
		return static::findBy(["disponibilite_id =" => DISPONIBILITE::LIBRE]);
	}

	public static function mission(){
		return static::findBy(["disponibilite_id =" => DISPONIBILITE::MISSION, 'visibility ='=>1]);
	}



	public function vendu(string $date1 = "2020-06-01", string $date2){
		return PROSPECTION::findBy(["commercial_id ="=>$this->getId(), "etat_id !="=>ETAT::ANNULEE, "DATE(prospection.created) >="=>$date1, "DATE(prospection.created) <="=>$date2]);
	}



	public function stats(string $date1 = "2020-04-01", string $date2){
		$tableaux = [];
		$nb = ceil(dateDiffe($date1, $date2) / 30);
		$index = $date1;
		while ( $index <= $date2 ) {
			$debut = $index;
			$fin = dateAjoute1($index, 1);

			$data = new \stdclass;
			$data->year = date("Y", strtotime($index));
			$data->month = date("m", strtotime($index));
			$data->day = date("d", strtotime($index));
			$data->nb = $nb;
			////////////

			$data->vendu = comptage($this->vendu($debut, $fin), "vendu", "somme");

			$tableaux[] = $data;
			///////////////////////
			
			$index = $fin;
		}
		return $tableaux;
	}



	public function sentenseCreate(){
		return $this->sentense = "Ajout d'un nouveau chauffeur dans votre gestion : $this->name $this->lastname";
	}


	public function sentenseUpdate(){
		return $this->sentense = "Modification des informations du chauffeur N°$this->id : $this->name $this->lastname.";
	}


	public function sentenseDelete(){
		return $this->sentense = "Suppression définitive du chauffeur N°$this->id : $this->name $this->lastname.";
	}



}

?>