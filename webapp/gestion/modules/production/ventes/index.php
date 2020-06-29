<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-7">
                <h2 class="text-uppercase">Le Stock des ressources de production</h2>
                <span>au <?= datecourt(dateAjoute())  ?></span>
            </div>
            <div class="col-sm-5">

            </div>
        </div>

        <div class="wrapper wrapper-content">
            <div class="text-center animated fadeInRightBig">

                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 class="float-left">Pour les <?= $this->getId() ?> derniers jours</h5>
                        <div class="float-right">
                            <div class="btn-group text-right">
                                <a href="<?= $this->url("gestion", "production", "production", 7) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 7)?"active":"" ?>"><i class="fa fa-calendar"></i> la semaine</a>
                                <a href="<?= $this->url("gestion", "production", "production", 15) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 15)?"active":"" ?>"><i class="fa fa-calendar"></i> la quinzaine</a>
                                <a href="<?= $this->url("gestion", "production", "production", 30) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 30)?"active":"" ?>"><i class="fa fa-calendar"></i> le mois</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="">
                            <div class="text-center">
                                <p>Veuillez les produits pour lesquels vous voulez voir la production</p>
                                <div>
                                    <?php $i = 0; foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                        $i++; ?>
                                        <button class="btn btn-success dim btnproduit" data-id="<?= $i ?>" data-toggle="tooltip" title="<?= $produit->description ?>"><?= $produit->name(); ?></button>
                                    <?php }  ?>
                                </div>
                            </div>
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="border-none"></th>
                                        <?php $i = 0; foreach ($produits as $key => $produit) {
                                            $i++;
                                            $array = $produit->fourni("prixdevente", ["isActive ="=>Home\TABLE::OUI]);
                                            foreach ($array as $key => $value) {
                                                $value->di = $i;
                                            }
                                            $lots = array_merge($lots, $array); ?>
                                            <th class="produit-<?= $i ?>" colspan="<?= count($array) ?>"><span class="text-uppercase"><?= $produit->name ?></span> </th>
                                        <?php } ?>
                                    </tr>
                                    <tr>
                                        <?php foreach ($lots as $key => $pdv) {
                                            $pdv->actualise(); ?>
                                            <th class="produit-<?= $pdv->di ?>"><small><?= $pdv->prix->price() ?></small></th>
                                        <?php } ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Stock de la veille</td>
                                        <?php foreach ($lots as $key => $pdv) { ?>
                                            <td class="produit-<?= $pdv->di ?>"><span class="text-muted gras" style="font-size: 15px"><?= $pdv->stock(dateAjoute1($productionjours[0]->ladate, -1)) ?></span> &nbsp;</td>
                                        <?php } ?>
                                    </tr>

                                    <?php
                                    $i =0;
                                    foreach ($productionjours as $key => $production) {
                                        $i++; ?>
                                        <tr>
                                            <td><?= datecourt3($production->ladate)  ?></td>
                                            <?php
                                            $production->fourni("ligneproductionjour");
                                            foreach ($lots as $key => $pdv) {
                                                foreach ($production->ligneproductionjours as $key => $ligne) {
                                                    if ($pdv->getId() == $ligne->prixdevente_id) { 
                                                        $requette = "SELECT ligneprospection.prixdevente_id, SUM(quantite) as quantite, SUM(quantite_vendu) as vendu, SUM(perte) as perte FROM prixdevente, prospection, ligneprospection WHERE prixdevente.id = ligneprospection.prixdevente_id AND ligneprospection.prospection_id = prospection.id AND prospection.etat_id !=? AND prospection.etat_id !=? AND prixdevente.id = ? AND DATE(prospection.created) = ? GROUP BY ligneprospection.prixdevente_id ";
                                                        $datas = Home\PRIXDEVENTE::execute($requette, [Home\ETAT::ANNULEE, Home\ETAT::PARTIEL, $produit->getId(), $production->ladate]);
                                                        if (count($datas) > 0) {
                                                            $item = $datas[0];
                                                        }else{
                                                            $item = new \stdclass();
                                                            $item->quantite = 0;
                                                            $item->vendu = 0;
                                                            $item->perte = 0;
                                                        }
                                                        ?>
                                                        <td class="produit-<?= $pdv->di ?>">
                                                            <h5 class="d-inline text-danger"><?php 
                                                            $a = $pdv->vendu(Home\PARAMS::DATE_DEFAULT, $production->ladate);
                                                            echo ($a > 0)?start0($a):""; ?></h5> &nbsp; 
                                                            <!-- | &nbsp; <small class="text-red"><?= start0($item->perte) ?></small> -->
                                                        </td>
                                                    <?php }
                                                }
                                            } ?>
                                        </tr>
                                    <?php } ?>
                                    <tr style="height: 18px;"></tr>
                                    <tr>
                                        <td style="width: 20%"><h3 class="text-center gras text-uppercase mp0">Stock global actuel</h3><small>Entrepot + boutique</small></td>
                                        <?php foreach ($lots as $key => $pdv) { ?>
                                            <td class="produit-<?= $pdv->di ?>"><h2 class="text-green gras" ><?= start0($pdv->stock(dateAjoute())) ?></h2></td>
                                        <?php } ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>


            </div>
        </div>


        <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>


    </div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>


</body>

</html>
