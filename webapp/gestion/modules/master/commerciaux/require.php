<?php 
namespace Home;

$title = "GPV | Tous les commerciaux";

$commerciaux = COMMERCIAL::findBy(["visibility ="=>1]);


?>