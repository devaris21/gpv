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
                <h2 class="text-uppercase">Rapport de vente par parfun / par prix</h2>
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
                                <a href="<?= $this->url("gestion", "ventes", "ventes", 7) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 7)?"active":"" ?>"><i class="fa fa-calendar"></i> la semaine</a>
                                <a href="<?= $this->url("gestion", "ventes", "ventes", 15) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 15)?"active":"" ?>"><i class="fa fa-calendar"></i> la quinzaine</a>
                                <a href="<?= $this->url("gestion", "ventes", "ventes", 30) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 30)?"active":"" ?>"><i class="fa fa-calendar"></i> le mois</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">
                        <div class="">

                            <div class="tabs-container">

                                <div class="tabs-left">
                                    <ul class="nav nav-tabs">
                                       <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                        <li style="background-color: <?= $produit->couleur; ?>"><a class="nav-link text-uppercase" data-toggle="tab" href="#tab-<?= $produit->getId() ?>">production de <?= $produit->name(); ?></a></li>
                                    <?php }  ?>
                                </ul>
                                <div class="tab-content " id="produits">
                                    <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                        <div id="tab-<?= $produit->getId() ?>" class="tab-pane">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-sm">
                                                        <div class="carre bg-primary"></div><span>Quantité vendue</span>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="carre bg-success"></div><span>Quantité livrée</span>
                                                    </div>
                                                    <div class="col-sm">
                                                        <div class="carre bg-danger"></div><span>Quantité perdue</span>
                                                    </div>
                                                </div><hr><br>
                                                <h2 class="text-uppercase gras text-center" style="color: <?= $produit->couleur; ?>">Rapport de production de <?= $produit->name(); ?></h2>
                                                <table class="table table-bordered table-hover">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2" class="border-none"></th>
                                                            <?php 
                                                            $lots = $produit->fourni("prixdevente", ["isActive ="=>Home\TABLE::OUI]) ;
                                                            foreach ($lots as $key => $pdv) {
                                                                $pdv->actualise(); ?>
                                                                <th><small><?= $pdv->prix->price ?> <?= $params->devise ?></small></th>
                                                            <?php } ?>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                       <!--  <tr>
                                                            <td>Stock de la veille</td>
                                                            <?php foreach ($lots as $key => $pdv) { ?>
                                                                <td class="produit-<?= $pdv->di ?>"><span class="text-muted gras" style="font-size: 15px"><?= $pdv->stock(dateAjoute1($productionjours[0]->ladate, -1)) ?></span> &nbsp;</td>
                                                            <?php } ?>
                                                        </tr> -->

                                                        <?php
                                                        $i =0;
                                                        foreach ($productionjours as $key => $production) {
                                                            $i++; ?>
                                                            <tr>
                                                                <td><?= datecourt3($production->ladate)  ?></td>
                                                                <?php foreach ($lots as $key => $pdv) {
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
                                                                        <h5 class="d-inline text-green"><?php 
                                                                        $a = $pdv->vendu($production->ladate, $production->ladate);
                                                                        echo ($a > 0)?start0($a):"0"; ?></h5> &nbsp;&nbsp;|&nbsp;&nbsp;

                                                                        <h5 class="d-inline text-success"><?php 
                                                                        $a = $pdv->livree($production->ladate, $production->ladate);
                                                                        echo ($a > 0)?start0($a):"0"; ?></h5> &nbsp;&nbsp;|&nbsp;&nbsp;
                                                                        
                                                                        <h5 class="d-inline text-danger"><?php 
                                                                        $a = $pdv->perte($production->ladate, $production->ladate);
                                                                        echo ($a > 0)?start0($a):"0"; ?></h5>
                                                                    </td>
                                                                <?php } ?>
                                                            </tr>
                                                        <?php } ?>
                                                        <tr style="height: 18px;"></tr>
                                                        <tr>
                                                            <td style="width: 28%"><h3 class="text-center gras text-uppercase mp0">Stock global actuel</h3><small>Entrepot + boutique</small></td>
                                                            <?php foreach ($lots as $key => $pdv) { ?>
                                                                <td class="produit-<?= $pdv->di ?>"><h2 class="text-green gras" ><?= start0($pdv->stock(dateAjoute())) ?></h2></td>
                                                            <?php } ?>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>   
                                    <?php }  ?>
                                </div>

                            </div>

                        </div>

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
