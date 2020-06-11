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
            <div class="animated fadeInRightBig">

                <div class="ibox ">
                    <div class="ibox-title">
                        <h5 class="float-left">Pour les <?= $this->getId() ?> derniers jours</h5>
                        <div class="float-right">
                            <div class="btn-group text-right">
                                <a href="<?= $this->url("gestion", "ventes", "rapportvente", 7) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 7)?"active":"" ?>"><i class="fa fa-calendar"></i> la semaine</a>
                                <a href="<?= $this->url("gestion", "ventes", "rapportvente", 15) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 15)?"active":"" ?>"><i class="fa fa-calendar"></i> la quinzaine</a>
                                <a href="<?= $this->url("gestion", "ventes", "rapportvente", 30) ?>" class="btn btn-xs btn-white <?= ($this->getId() == 30)?"active":"" ?>"><i class="fa fa-calendar"></i> le mois</a>
                            </div>
                        </div>
                    </div>
                    <div class="ibox-content">



                        <div class="tabs-container" id="produits">
                            <ul class="nav nav-tabs text-uppercase" role="tablist">
                                <li ><a class="nav-link" data-toggle="tab" href="#pan-0"><i class="fa fa-flask" ></i> Global</a></li>

                                <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                                    <li style=" border-bottom: 3px solid <?= $produit->couleur; ?>,"><a class="nav-link" data-toggle="tab" href="#pan-<?= $produit->getId() ?>"><i class="fa fa-flask" style="color: <?= $produit->couleur; ?>"></i> <?= $produit->name() ?></a></li>
                                <?php } ?>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" id="pan-0" class="tab-pane">
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="ibox">
                                                    <div class="ibox-content">
                                                        <h5>Vente directe de la periode</h5>
                                                        <h1 class="no-margins">-200,100</h1>
                                                        <div class="stat-percent font-bold text-danger">12% <i class="fa fa-level-down"></i></div>
                                                        <small>Part du marché</small>
                                                    </div>
                                                </div>

                                                <div class="ibox">
                                                    <div class="ibox-content">
                                                        <h5>Vente par prospection de la période</h5>
                                                        <h1 class="no-margins">-200,100</h1>
                                                        <div class="stat-percent font-bold text-danger">12% <i class="fa fa-level-down"></i></div>
                                                        <small>Part du marché</small>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <button data-toggle=modal data-target="#modal-vente" class="btn btn-warning dim btn-block"> <i class="fa fa-file-text-o"></i> Nouvelle vente directe</button>

                                                <button data-toggle="modal" data-target="#modal-prospection" class="btn btn-primary dim btn-block"><i class="fa fa-cubes"></i> Nouvelle prospection</button>
                                            </div>

                                            <div class="col-md-3">

                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <?php foreach (Home\PRODUIT::getAll() as $key => $produit) {
                                    $total = 0; ?>
                                    <div role="tabpanel" id="pan-<?= $produit->getId() ?>" class="tab-pane">
                                        <div class="panel-body"><br>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <h3 class="text-uppercase">Stock de <?= $produit->name() ?></h3>
                                                    <ul class="list-group text-left clear-list m-t">
                                                        <?php foreach ($tableau[$produit->getId()] as $key => $pdv) { 
                                                            $total += $pdv->pdv->montantStock(); ?>
                                                            <li class="list-group-item">
                                                                <i class="fa fa-flask" style="color: <?= $produit->couleur; ?>"></i>&nbsp;&nbsp;&nbsp; <?= $pdv->name ?>                                        <span class="float-right">
                                                                    <span class="label label-<?= ($pdv->boutique>0)?"success":"danger" ?>"><?= money($pdv->boutique) ?></span>&nbsp;&nbsp;
                                                                    <small class=""><?= money($pdv->stock) ?></small>
                                                                </span>
                                                            </li>
                                                        <?php } ?>
                                                        <li class="list-group-item"></li>
                                                    </ul>

                                                    <div class="ibox">
                                                        <div class="ibox-content">
                                                            <h5>Estimation du stock actuel</h5>
                                                            <h1 class="no-margins"><?= money($total) ?> <?= $params->devise ?></h1>
                                                        </div><br>

                                                        <div class="ibox-content">
                                                            <h5>Comparaison du stock / commande / prix</h5>
                                                            <div id="ct-chart-<?= $produit->getId() ?>" style="height: 150px; width:100%"></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-7 border-right border-left">
                                                    <div class="" style="margin-top: 0%">
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
                                                        </div><hr class="mp3">
                                                        <table class="table table-bordered table-hover text-center">
                                                            <thead>
                                                                <tr>
                                                                    <th rowspan="2" class="border-none"></th>
                                                                    <?php 
                                                                    $lots = $produit->fourni("prixdevente", ["isActive ="=>Home\TABLE::OUI]) ;
                                                                    foreach ($tableau[$produit->getId()] as $key => $pdv) { ?>
                                                                        <th><small><?= $pdv->prix ?> <?= $params->devise ?></small></th>
                                                                    <?php } ?>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i =0;
                                                                foreach ($productionjours as $key => $production) {
                                                                    $i++; ?>
                                                                    <tr>
                                                                        <td><?= datecourt2($production->ladate)  ?></td>
                                                                        <?php foreach ($tableau[$produit->getId()] as $key => $pdv) {
                                                                            $pdv->tab[] = $pdv->pdv->montantVendu($production->ladate, $production->ladate);
                                                                            ?>
                                                                            <td>
                                                                                <h5 class="d-inline text-green"><?= start0($pdv->pdv->vendu($production->ladate, $production->ladate)); ?></h5> &nbsp;&nbsp;|&nbsp;&nbsp;

                                                                                <h5 class="d-inline text-success"><?= start0($pdv->pdv->livree($production->ladate, $production->ladate)) ?></h5> &nbsp;&nbsp;|&nbsp;&nbsp;

                                                                                <h5 class="d-inline text-danger"><?= start0($pdv->pdv->perte($production->ladate, $production->ladate)); ?></h5>
                                                                            </td>
                                                                        <?php } ?>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr style="height: 18px;"></tr>
                                                                <tr>
                                                                    <td class="text-center"><h4 class="text-center gras text-uppercase mp0">Vente totale</h4></td>
                                                                    <?php foreach ($tableau[$produit->getId()] as $key => $pdv) { ?>
                                                                        <td><h3 class="text-green gras" ><?= money($pdv->pdv->montantVendu(dateAjoute(-$id), dateAjoute())) ?> <?= $params->devise ?></h3></td>
                                                                    <?php } ?>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="6"> 145 000 Fcfa</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>   
                                                    </div>
                                                </div>

                                                <div class="col-md-2">
                                                    <?php foreach ($tableau[$produit->getId()] as $key => $pdv) { ?>
                                                        <div class="ibox">
                                                            <div class="ibox-content">
                                                                <h5>Courbe des ventes de <?= $pdv->prix ?></h5>
                                                                <div id="sparkline-<?= $pdv->id ?>"></div>
                                                            </div>
                                                        </div>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

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



<script>
    $(document).ready(function() {

        <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
           new Chartist.Bar('#ct-chart-<?= $produit->getId() ?>', {
            labels: [<?php foreach ($tableau[$produit->getId()] as $key => $data){ ?>"<?= $data->prix ?>", " ", " ",<?php } ?>],
            series: [
            [<?php foreach ($tableau[$produit->getId()] as $key => $data){ ?><?= $data->stock ?>, 0, 0,<?php } ?>],
            [<?php foreach ($tableau[$produit->getId()] as $key => $data){ ?><?= $data->boutique ?> , 0, 0,<?php } ?>],
            [<?php foreach ($tableau[$produit->getId()] as $key => $data){ ?>0, <?= $data->commande ?>, 0,<?php } ?>],
            ]
        }, {
           stackBars: true,
           axisX: {
            labelInterpolationFnc: function(value) {
                if (value >= 1000) {
                    return (value / 1000) + 'k';            
                }
                return value;
            }
        },
        reverseData:true,
        seriesBarDistance: 10,
        horizontalBars: true,
        axisY: {
            offset: 50
        }
    });


           <?php foreach ($tableau[$produit->getId()] as $key => $pdv) { ?>
            var sparklineCharts = function(){
                $("#sparkline-<?= $pdv->id ?>").sparkline([<?php foreach ($pdv->tab as $i){ echo $i.", "; } ?>], {
                    type: 'line',
                    width: '100%',
                    height: '60',
                    lineColor: '<?= $pdv->pdv->produit->couleur ?>',
                    fillColor: "#ffffff"
                });
            };


            var sparkResize;
            $(window).resize(function(e) {
                clearTimeout(sparkResize);
                sparkResize = setTimeout(sparklineCharts, 500);
            });
            sparklineCharts();
        <?php }

    } ?>


});
</script>



</body>

</html>
