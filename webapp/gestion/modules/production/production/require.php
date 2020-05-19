<?php 
namespace Home;
if ($this->getId() > 0) {
	$id = $this->getId();
}else{
	$id = 7;
}
$produits = PRODUIT::getAll();

$productionjours = PRODUCTIONJOUR::findBy([],[],["ladate"=>"DESC"], $id);
usort($productionjours, 'comparerLadate');

$title = "GPV | Stock de la production ";
?>