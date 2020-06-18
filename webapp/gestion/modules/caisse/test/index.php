<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

            <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  


            <div class="wrapper wrapper-content">

                <div class="row">
                    <div class="col-lg-8">
                        <div class="ibox ">
                            <div class="ibox-content">
                                <div class="m-t-sm">
                                    <div class="border-right">
                                        <div>
                                            <canvas id="lineChart" height="110"></canvas>
                                        </div>
                                    </div><hr>
                                    <div class="row stat-list text-center">
                                        <div class="col-4">
                                         <h3 class="no-margins text-green"><?= money(Home\OPERATION::entree(dateAjoute() , dateAjoute(+1))) ?> <?= $params->devise ?> </h3>
                                         <small>Entrées du jour</small>

                                         <div class="progress progress-mini" style="margin-top: 5%;">
                                            <div class="progress-bar" style="width: 100%; background-color: #dedede"></div>
                                        </div><br>

                                        <div class="cursor" data-toggle="modal" data-target="#modal-attente">
                                            <h3 class="no-margins text-blue"><?= money(comptage(Home\OPERATION::enAttente(), "montant", "somme")) ?> <?= $params->devise ?> *</h3>
                                            <small>Versement en attente</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <br>
                                        <h2 class="no-margins gras"><?= money(Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , dateAjoute())) ?> <small><?= $params->devise ?></small></h2>
                                        <small>En caisse actuellement</small>
                                        <div class="progress progress-mini">
                                            <div class="progress-bar" style="width: 100%;"></div>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h3 class="no-margins text-red"><?= money(Home\OPERATION::sortie(dateAjoute() , dateAjoute(+1))) ?> <?= $params->devise ?> </h3>
                                        <small>Dépenses du jour</small>

                                        <div class="progress progress-mini" style="margin-top: 5%;">
                                            <div class="progress-bar" style="width: 100%; background-color: #dedede"></div>
                                        </div><br>

                                        <?php if ($employe->isAutoriser("paye des manoeuvre")) { ?>
                                            <h3 class="no-margins text-orange"><?= money(Home\MANOEUVRE::reste_paye()) ?> <?= $params->devise ?></h3>
                                            <small>Paye de salaire</small>
                                        <?php } ?>
                                    </div>
                                </div>                                
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="ibox">
                        <div class="ibox-title">
                            <h5 class="text-uppercase">résultats 3 derniers jours</h5>
                        </div>
                        <?php $i = -2;  while ($i <= 0) {
                            $date1 = dateAjoute($i-1);
                            $date2 = dateAjoute($i);
                            $ouv = Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , $date1);
                            $ferm = Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , $date2);

                            $taux = 0;
                            if ($ouv > 0) {
                               $taux = (($ferm - $ouv) / $ouv);
                           }
                           ?>
                           <div class="ibox-content text-center">
                            <div class="row">
                                <div class="col-4">
                                    <small class="stats-label">Ouverture <?= datecourt2($date2)  ?></small>
                                    <h4><?= money($ouv) ?> <small><?= $params->devise ?></small></h4>
                                </div>
                                <div class="col-4">
                                    <small class="stats-label ">Progession</small>
                                    <h4 class="text-<?= ($taux > 0)?"green":"red"  ?>"><?= round(($taux * 100), 2) ?>%</h4>
                                </div>
                                <div class="col-4">
                                    <small class="stats-label">Cloture <?= datecourt2($date2)  ?></small>
                                    <h4><?= money($ferm) ?> <small><?= $params->devise ?></small></h4>
                                </div>
                            </div>
                        </div>
                        <?php
                        $i++;
                    } ?>

                    <div class="ibox-content" style="padding-bottom: 0;">
                        <button data-toggle="modal" data-target="#modal-entree" class="btn btn-sm btn-primary dim" style="font-size: 10px"><i class="fa fa-check"></i> Nouvelle entrée</button>
                        <button data-toggle="modal" data-target="#modal-depense" class="btn btn-sm btn-danger dim pull-right" style="font-size: 10px"><i class="fa fa-check"></i> Nouvelle dépense</button><hr class="mp3">

                        <button data-toggle="modal" data-target="#modal-attente" class="btn btn-sm btn-success dim btn-block" ><i class="fa fa-eye"></i> Voir les versemments en attente</button>
                    </div>

                </div>
            </div>

        </div>


        <div class="">
            <div class="tabs-container">
                <ul class="nav nav-tabs text-uppercase" role="tablist">
                    <li><a class="nav-link active" data-toggle="tab" href="#tab-global"><i class="fa fa-globe"></i> Global</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-capitaux"><i class="fa fa-home"></i> Capitaux & Immobilisation</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-stock"><i class="fa fa-cubes"></i> Stock & en-cours</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-banques"><i class="fa fa-money"></i> Comptes & Banques</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-tiers"><i class="fa fa-users"></i> Comptes de tiers</a></li>
                    <li><a class="nav-link" data-toggle="tab" href="#tab-recettes"><i class="fa fa-charts-line"></i> Recettes & charges</a></li>
                </ul>

                <div class="tab-content">

                    <?php include($this->relativePath("partiels/tab-global.php")) ?>
                    <?php include($this->relativePath("partiels/tab-capitaux.php")) ?>
                    <?php include($this->relativePath("partiels/tab-stock.php")) ?>
                    <?php include($this->relativePath("partiels/tab-banques.php")) ?>
                    <?php include($this->relativePath("partiels/tab-tiers.php")) ?>
                    <?php include($this->relativePath("partiels/tab-recettes.php")) ?>

                </div>
            </div>
        </div>
        <br><br>



        <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>

        <?php include($this->rootPath("composants/assets/modals/modal-entree.php")); ?>  
        <?php include($this->rootPath("composants/assets/modals/modal-depense.php")); ?>  
        <?php include($this->rootPath("composants/assets/modals/modal-operation.php")); ?>  

    </div>
</div>


<div class="modal inmodal fade" id="modal-attente">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Liste des versements en attentes</h4>
                <div class="offset-md-4 col-md-4">
                 <input type="text" id="search" class="form-control text-center" placeholder="Rechercher un versements"> 
             </div>
         </div>
         <div class="modal-body">
            <table class="table table-bordered table-hover table-operation">
                <tbody class="tableau-attente">
                    <?php foreach (Home\OPERATION::enAttente() as $key => $operation) {
                        $operation->actualise(); ?>
                        <tr>
                            <td style="background-color: rgba(<?= hex2rgb($operation->categorieoperation->color) ?>, 0.6);" width="15"><a target="_blank" href="<?= $this->url("gestion", "fiches", "boncaisse", $operation->getId())  ?>"><i class="fa fa-file-text-o fa-2x"></i></a></td>
                            <td>
                                <h6 style="margin-bottom: 3px" class="mp0 text-uppercase gras <?= ($operation->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::ENTREE)?"text-green":"text-red" ?>"><?= $operation->categorieoperation->name() ?> <span><?= ($operation->etat_id == Home\ETAT::ENCOURS)?"*":"" ?></span> <span class="pull-right"><i class="fa fa-clock-o"></i> <?= datelong($operation->created) ?></span></h6>
                                <i><?= $operation->comment ?></i>
                            </td>
                            <td class="text-center gras" style="padding-top: 12px;">
                                <?= money($operation->montant) ?> <?= $params->devise ?>
                            </td>
                            <td width="110" class="text-center" >
                                <small><?= $operation->structure ?></small><br>
                                <small><?= $operation->numero ?></small>
                            </td>
                            <td class="text-center">
                                <button onclick="valider(<?= $operation->getId() ?>)" class="cursor simple_tag"><i class="fa fa-file-text-o"></i> Valider</button><span style="display: none">en attente</span>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div><hr><br>
    </div>
</div>
</div>



<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>

<script>
    $(document).ready(function() {

        var data2 = [
        [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
        [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
        [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
        [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
        [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
        [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
        [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
        [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
        ];

        var data3 = [
        [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
        [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
        [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
        [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
        [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
        [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
        [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
        [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
        ];


        var dataset = [
        {
            label: "Number of orders",
            data: data3,
            color: "#1ab394",
            bars: {
                show: true,
                align: "center",
                barWidth: 24 * 60 * 60 * 600,
                lineWidth:0
            }

        }, {
            label: "Payments",
            data: data2,
            yaxis: 2,
            color: "#1C84C6",
            lines: {
                lineWidth:1,
                show: true,
                fill: true,
                fillColor: {
                    colors: [{
                        opacity: 0.2
                    }, {
                        opacity: 0.4
                    }]
                }
            },
            splines: {
                show: false,
                tension: 0.6,
                lineWidth: 1,
                fill: 0.1
            },
        }
        ];


        var options = {
            xaxis: {
                mode: "time",
                tickSize: [3, "day"],
                tickLength: 0,
                axisLabel: "Date",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 10,
                color: "#d5d5d5"
            },
            yaxes: [{
                position: "left",
                max: 1070,
                color: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: 'Arial',
                axisLabelPadding: 3
            }, {
                position: "right",
                clolor: "#d5d5d5",
                axisLabelUseCanvas: true,
                axisLabelFontSizePixels: 12,
                axisLabelFontFamily: ' Arial',
                axisLabelPadding: 67
            }
            ],
            legend: {
                noColumns: 1,
                labelBoxBorderColor: "#000000",
                position: "nw"
            },
            grid: {
                hoverable: false,
                borderWidth: 0
            }
        };

        function gd(year, month, day) {
            return new Date(year, month - 1, day).getTime();
        }

        var previousPoint = null, previousLabel = null;

        $.plot($("#flot-dashboard-chart"), dataset, options);
    });
</script>



<script type="text/javascript">

    //Flot Multiple Axes Line Chart
    $(function() {
        function euroFormatter(v, axis) {
            return v.toFixed(axis.tickDecimals) + "€";
        }

        function doPlot(position) {
            $.plot($("#flot-line-chart-multi"), [
                <?php foreach (Home\COMPTEBANQUE::getAll() as $key => $banque) { ?>
                    {
                        data: [
                        <?php foreach ($banque->evolution(date("Y"."-01-01"), dateAjoute()) as $key => $value) { ?>
                            [<?= $value->time ?>, <?= $value->montant ?>],
                        <?php } ?>
                        ],
                        label: "<?= $banque->name() ?>"
                    },
                    <?php } ?> ], {
                        xaxes: [{
                            mode: 'time'
                        }],
                        yaxes: [{
                            min: 0
                        }, {
                // align if we are to the right
                alignTicksWithAxis: position == "right" ? 1 : null,
                position: position,
                tickFormatter: euroFormatter
            }],
            legend: {
                position: 'sw'
            },
            colors: ["#8878ac"],
            grid: {
                color: "#999999",
                hoverable: true,
                clickable: true,
                tickColor: "#D4D4D4",
                borderWidth:0,
                hoverable: true //IMPORTANT! this is needed for tooltip to work,

            },
            tooltip: true,
            tooltipOpts: {
                content: "%s: %y au %x",
                xDateFormat: "%d-%m-%Y",

                onHover: function(flotItem, $tooltipEl) {
                    // console.log(flotItem, $tooltipEl);
                }
            }

        });
        }

        doPlot("right");

        $("button").click(function() {
            doPlot($(this).text());
        });
    });





    $(document).ready(function() {
        var lineData = {
            labels: [<?php foreach ($statistiques as $key => $data) { ?>"<?= $data->name ?>", <?php } ?>],
            datasets: [
            {
                label: "Entrées",
                borderColor: "rgba(26,179,148,0.7)",
                pointBackgroundColor: "rgba(26,179,148,1)",
                pointBorderColor: "#fff",
                data: [<?php foreach ($statistiques as $key => $data) { ?>"<?= $data->entree ?>", <?php } ?>]
            },
            {
                label: "Dépenses",
                borderColor: "rgba(220,0,0,1)",
                pointBackgroundColor: "rgba(220,0,0,1)",
                pointBorderColor: "#fff",
                data: [<?php foreach ($statistiques as $key => $data) { ?>"<?= $data->sortie ?>", <?php } ?>]
            }
            ]
        };

        var lineOptions = {
            responsive: true
        };

        var ctx = document.getElementById("lineChart").getContext("2d");
        new Chart(ctx, {type: 'line', data: lineData, options:lineOptions});
    });
</script>



<?php include($this->rootPath("composants/assets/modals/modal-capital.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-immobilisation.php")); ?>
<?php include($this->rootPath("composants/assets/modals/modal-cloture.php")); ?>

<?php foreach (Home\IMMOBILISATION::getAll() as $key => $immobilisation) {
    $immobilisation->actualise();
    include($this->rootPath("composants/assets/modals/modal-immobilisation2.php")); 
}
?>  

<?php include($this->rootPath("composants/assets/modals/modal-comptebanque.php")); ?>  
<?php foreach (Home\COMPTEBANQUE::getAll() as $key => $banque) {
    $banque->actualise();
    include($this->rootPath("composants/assets/modals/modal-optioncompte.php")); 
}
?>  
<?php include($this->rootPath("composants/assets/modals/modal-retrait.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-depot.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-fraiscompte.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-transfertfond.php")); ?>  

</body>

</html>
