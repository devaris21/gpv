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
                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title border">
                            <span class="label label-success float-right">An</span>
                            <h5 class="d-inline text-uppercase">Chif. affaire</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?= money(Home\COMMANDE::CA(date("Y")."-01-01" , dateAjoute())) ?></h1>
                            <div class="stat-percent font-bold text-warning"><?= money(Home\CLIENT::dettes()) ?></div>
                            <small>Dette des clients</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <h5 class="text-uppercase text-green">Entrées</h5>
                            <span class="label label-primary float-right">Mensuel</span>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins text-green"><?= money(Home\OPERATION::entree(date("Y-m")."-01" , dateAjoute())) ?></h1>
                            <div class="stat-percent font-bold text-green"><?= money(Home\OPERATION::entree(date("Y")."-01-01" , dateAjoute())) ?></div>
                            <small>Total annuel</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-primary float-right">Mensuel</span>
                            <h5 class="text-uppercase text-red">Dépenses</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins text-red"><?= money(Home\OPERATION::sortie(date("Y-m")."-01" , dateAjoute())) ?></h1>
                            <div class="stat-percent font-bold text-red"><?= money(Home\OPERATION::sortie(date("Y")."-01-01" , dateAjoute())) ?></div>
                            <small>Total annuel</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="ibox ">
                        <div class="ibox-title">
                            <span class="label label-primary float-right">Mensuel</span>
                            <h5 class="text-uppercase">Résultats</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins"><?= money(Home\OPERATION::resultat(date("Y-m")."-01" , dateAjoute())) ?></h1>
                            <div class="stat-percent font-bold text-info"><?= money(Home\OPERATION::resultat(date("Y")."-01-01" , dateAjoute())) ?></div>
                            <small>Total annuel</small>
                        </div>
                    </div>
                </div>
            </div>
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
                <li><a class="nav-link active" data-toggle="tab" href="#global"><i class="fa fa-globe"></i> Global</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#capitaux"><i class="fa fa-home"></i> Capitaux & Immobilisation</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#stock"><i class="fa fa-cubes"></i> Stock & en-cours</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#banques"><i class="fa fa-money"></i> Comptes & Banques</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#tiers"><i class="fa fa-users"></i> Comptes de tiers</a></li>
                <li><a class="nav-link" data-toggle="tab" href="#recettes"><i class="fa fa-charts-line"></i> Recettes & charges</a></li>
            </ul>
            <div class="tab-content">

                <div role="tabpanel" id="global" class="tab-pane active">
                    <div class="panel-body">
                        <div class="row  border-bottom white-bg dashboard-header">

                            <div class="col-md-3">
                                <h2>Welcome Amelia</h2>
                                <small>You have 42 messages and 6 notifications.</small>
                                <ul class="list-group clear-list m-t">
                                    <li class="list-group-item fist-item">
                                        <span class="float-right">
                                            09:00 pm
                                        </span>
                                        <span class="label label-success">1</span> Please contact me
                                    </li>
                                    <li class="list-group-item">
                                        <span class="float-right">
                                            10:16 am
                                        </span>
                                        <span class="label label-info">2</span> Sign a contract
                                    </li>
                                    <li class="list-group-item">
                                        <span class="float-right">
                                            08:22 pm
                                        </span>
                                        <span class="label label-primary">3</span> Open new shop
                                    </li>
                                    <li class="list-group-item">
                                        <span class="float-right">
                                            11:06 pm
                                        </span>
                                        <span class="label label-default">4</span> Call back to Sylvia
                                    </li>
                                    <li class="list-group-item">
                                        <span class="float-right">
                                            12:00 am
                                        </span>
                                        <span class="label label-primary">5</span> Write a letter to Sandra
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div class="flot-chart dashboard-chart">
                                    <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                </div>
                                <div class="row text-center">
                                    <div class="col">
                                        <div class=" m-l-md">
                                            <span class="h5 font-bold m-t block">$ 406,100</span>
                                            <small class="text-muted m-b block">Trésorerie Net</small>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <span class="h5 font-bold m-t block">$ 150,401</span>
                                        <small class="text-muted m-b block">Resultat Net</small>
                                    </div>
                                    <div class="col">
                                        <span class="h5 font-bold m-t block">$ 16,822</span>
                                        <small class="text-muted m-b block">Net en caisse</small>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="statistic-box">
                                    <h4>
                                        Project Beta progress
                                    </h4>
                                    <p>
                                        You have two project with not compleated task.
                                    </p>
                                    <div class="row text-center">
                                        <div class="col-lg-6">
                                            <canvas id="doughnutChart2" width="80" height="80" style="margin: 18px auto 0"></canvas>
                                            <h5 >Kolter</h5>
                                        </div>
                                        <div class="col-lg-6">
                                            <canvas id="doughnutChart" width="80" height="80" style="margin: 18px auto 0"></canvas>
                                            <h5 >Maxtor</h5>
                                        </div>
                                    </div>
                                    <div class="m-t">
                                        <small>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</small>
                                    </div>

                                </div>
                            </div>

                        </div>


                        <strong>Lorem ipsum dolor sit amet, consectetuer adipiscing</strong>

                        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I enjoy with my whole heart. I am alone, and feel the charm of
                        existence in this spot, which was created for the bliss of souls like mine.</p>

                        <p>I am so happy, my dear friend, so absorbed in the exquisite sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at
                        the present moment; and yet I feel that I never was a greater artist than now. When.</p>
                    </div>
                </div>


                <div role="tabpanel" id="capitaux" class="tab-pane">
                    <div class="panel-body">
                       <div class="row">
                        <div class="col-lg-3">
                            <div class="widget style1 blue-bg">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="fa fa-trophy fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span> Today income </span>
                                        <h2 class="font-bold">$ 4,232</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget style1 navy-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-cloud fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span> Today degrees </span>
                                        <h2 class="font-bold">26'C</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget style1 lazur-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-envelope-o fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span> New messages </span>
                                        <h2 class="font-bold">260</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="widget style1 yellow-bg">
                                <div class="row">
                                    <div class="col-4">
                                        <i class="fa fa-music fa-5x"></i>
                                    </div>
                                    <div class="col-8 text-right">
                                        <span> New albums </span>
                                        <h2 class="font-bold">12</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><br>

                    <div class="row">
                        <div class="col-md-5">
                            <h1 class="text-uppercase">Capitaux <button class="btn btn-sm btn-primary dim pull-right"><i class="fa fa-plus"></i> Ajouter nouveau</button></h1>
                            <table class="table table-stripped table-hover">
                                <thead>
                                    <tr>
                                        <th>Libéllé</th>
                                        <th>Montant</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><h2 class="mp0">Total =</h2></td>
                                        <td colspan="2"><h2 class="mp0">5 000 000 Fcfa</h2></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="offset-md-2 col-md-5">
                            <h1 class="text-uppercase">Immobilisations <button class="btn btn-sm btn-primary dim pull-right"><i class="fa fa-plus"></i> Ajouter nouveau</button></h1>
                            <table class="table table-stripped table-hover">
                                <thead>
                                    <tr>
                                        <th>Libéllé</th>
                                        <th>Montant</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><h2 class="mp0">Total =</h2></td>
                                        <td colspan="2"><h2 class="mp0">5 000 000 Fcfa</h2></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>


                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>



            <div role="tabpanel" id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>

            <div role="tabpanel" id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>


            <div role="tabpanel" id="tab-2" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>


            <div role="tabpanel" id="recettes" class="tab-pane">
                <div class="panel-body">
                    <strong>Donec quam felis</strong>

                    <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
                    and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

                    <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
                    sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>



<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title">
                <h5 class="text-uppercase">Tableau des compte</h5>
                <div class="ibox-tools">
                    <div data-toggle="buttons" class="btn-group btn-group-toggle">
                        <label jour="-7" class="btn btn-sm btn-white active"><i class="fa fa-calendar"></i> Semaine </label>
                        <label jour="-30" class="btn btn-sm btn-white"><i class="fa fa-calendar"></i> Mois </label>
                        <label jour="-90" class="btn btn-sm btn-white"><i class="fa fa-calendar"></i> Trimestre </label>
                        <label jour="-360" class="btn btn-sm btn-white"><i class="fa fa-calendar"></i> Année </label>
                    </div>
                </div>
            </div>
            <div class="ibox-content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-operation">
                                <thead>
                                    <tr class="text-center text-uppercase">
                                        <th colspan="2" style="visibility: hidden; width: 65%"></th>
                                        <th>Entrée</th>
                                        <th>Sortie</th>
                                        <th>Résultats</th>
                                    </tr>
                                </thead>
                                <tbody class="tableau">
                                    <tr>
                                        <td colspan="2">Repport du solde de la veille (<?= datecourt(dateAjoute(-8)) ?>) </td>
                                        <td class="text-center">-</td>
                                        <td class="text-center">-</td>
                                        <td style="background-color: #fafafa" class="text-center"><?= money($repport = $last = Home\OPERATION::resultat(Home\PARAMS::DATE_DEFAULT , dateAjoute(-8))) ?> <?= $params->devise ?></td>
                                    </tr>
                                    <?php foreach ($operations as $key => $operation) {  ?>
                                        <tr>
                                            <td class="text-center" style="background-color: rgba(<?= hex2rgb($operation->categorieoperation->color) ?>, 0.6);" width="15"><a target="_blank" href="<?= $this->url("gestion", "fiches", "boncaisse", $operation->getId())  ?>"><i class="fa fa-file-text-o fa-2x"></i></a> 
                                            </td>
                                            <td>
                                                <h6 style="margin-bottom: 3px" class="mp0 text-uppercase gras <?= ($operation->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::ENTREE)?"text-green":"text-red" ?>"><?= $operation->categorieoperation->name() ?>  

                                                <?php if ($employe->isAutoriser("modifier-supprimer")) { ?>
                                                    |
                                                    &nbsp;&nbsp;<i onclick="modifierOperation(<?= $operation->getId() ?>)" class="cursor fa fa-pencil text-dark"></i> 
                                                    &nbsp;&nbsp;<i class="cursor fa fa-close text-red" onclick="suppressionWithPassword('operation', <?= $operation->getId() ?>)"></i>
                                                <?php } ?>

                                                <span class="pull-right"><i class="fa fa-clock-o"></i> <?= datelong($operation->created) ?></span>
                                            </h6>
                                            <i><?= $operation->comment ?> ## <u style="font-size: 9px; font-style: italic;"><?= $operation->structure ?> - <?= $operation->numero ?></u></i>
                                        </td>
                                           <!--  <td width="110" class="text-center" style="padding: 0; border-right: 2px dashed grey">
                                             <?php if ($operation->etat_id == Home\ETAT::ENCOURS) { ?>
                                                 <button style="padding: 2px 6px;" onclick="valider(<?= $operation->getId() ?>)" class="cursor simple_tag"><i class="fa fa-file-text-o"></i> Valider</button><span style="display: none">en attente</span>
                                             <?php } ?>
                                             <br><small style="display: inline-block; font-style: 8px; line-height: 12px;"><?= $operation->structure ?> - <?= $operation->numero ?></small>
                                         </td> -->
                                         <?php if ($operation->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::ENTREE) { ?>
                                            <td class="text-center text-green gras" style="padding-top: 12px;">
                                                <?= money($operation->montant) ?> <?= $params->devise ?>
                                            </td>
                                            <td class="text-center"> - </td>
                                        <?php }elseif ($operation->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::SORTIE) { ?>
                                            <td class="text-center"> - </td>
                                            <td class="text-center text-red gras" style="padding-top: 12px;">
                                                <?= money($operation->montant) ?> <?= $params->devise ?>
                                            </td>
                                        <?php } ?>
                                        <?php $last += ($operation->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::ENTREE)? $operation->montant : -$operation->montant ; ?>
                                        <td class="text-center gras" style="padding-top: 12px; background-color: #fafafa"><?= money($last) ?> <?= $params->devise ?></td>
                                    </tr>
                                <?php } ?>
                                <tr style="height: 15px;"></tr>
                                <tr>
                                    <td style="border-right: 2px dashed grey" colspan="2"><h4 class="text-uppercase mp0 text-right">Total des comptes au <?= datecourt(dateAjoute()) ?></h4></td>
                                    <td><h3 class="text-center text-green"><?= money(comptage($entrees, "montant", "somme") + $repport) ?> <?= $params->devise ?></h3></td>
                                    <td><h3 class="text-center text-red"><?= money(comptage($depenses, "montant", "somme")) ?> <?= $params->devise ?></h3></td>
                                    <td style="background-color: #fafafa"><h3 class="text-center text-blue gras"><?= money($last) ?> <?= $params->devise ?></h3></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-md-2">

                </div>
            </div>
        </div>
    </div>

</div>


</div>


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

<script type="text/javascript">
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


</body>

</html>
