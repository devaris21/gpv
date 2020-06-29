<?php
namespace Home;
use Native\RESPONSE;

/**
 * 
 */
class MISEENBOUTIQUE extends TABLE
{
	
	
	public static $tableName = __CLASS__;
	public static $namespace = __NAMESPACE__;


	public $prixdevente_id;
	public $quantite;
	public $restant = 0;
	public $employe_id;
	public $etat_id = ETAT::VALIDEE;


	public function enregistre(){
		$data = new RESPONSE;
		$datas = PRIXDEVENTE::findBy(["id ="=>$this->prixdevente_id]);
		if (count($datas) == 1) {
			if ($this->quantite > 0) {
				$this->employe_id = getSession("employe_connecte_id");
				$data = $this->save();
			}				
		}else{
			$data->status = false;
			$data->message = "Une erreur s'est produite lors du prix !";
		}
		return $data;
	}




	public function sentenseCreate(){}
	public function sentenseUpdate(){}
	public function sentenseDelete(){}
}

?>