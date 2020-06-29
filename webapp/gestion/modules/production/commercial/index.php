<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="wrapper wrapper-content  animated fadeInRight">
            <div class="row">
                <div class="col-sm-8">
                    <div class="ibox">
                        <div class="ibox-content">
                            <p></p>
                            <div class="">                                
                             <ul class="nav nav-tabs">
                                <li><a class="nav-link active" data-toggle="tab" href="#tab-1"><i class="fa fa-user"></i> Toutes les prospections</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-2"><i class="fa fa-file-text"></i> Rapports journaliers</a></li>
                                <li><a class="nav-link" data-toggle="tab" href="#tab-3"><i class="fa fa-money"></i> Payement de salaire</a></li>
                            </ul>
                            <div class="tab-content" style="min-height: 300px;">



                             <?php if ($employe->isAutoriser("production")) { ?>

                                <div id="tab-1" class="tab-pane active"><br>
                                    <div class="row container-fluid">
                                        <button type="button" data-toggle=modal data-target='#modal-prospection_' class="btn btn-warning btn-sm dim float-right"><i class="fa fa-plus"></i> Nouvel prospection </button>
                                    </div>
                                    <div class="">
                                        <?php if (count($prospections) > 0) { ?>

                                            <table class="table table-hover table-vente">
                                                <tbody>
                                                    <?php foreach ($prospections as $key => $prospection) {
                                                        $prospection->actualise(); 
                                                        $prospection->fourni("ligneprospection");
                                                        ?>
                                                        <tr class="<?= ($prospection->etat_id != Home\ETAT::ENCOURS)?'fini':'' ?> border-bottom" style="border-bottom: 2px solid black">
                                                            <td class="project-title border-right" style="width: 30%;">
                                                                <h4 class="text-uppercase">N°<?= $prospection->reference ?></h4>
                                                                <h6 class="text-uppercase text-muted"> <?= $prospection->zonedevente->name() ?></h6>
                                                                <span>Emise <?= depuis($prospection->created) ?></span>
                                                                <span class="label label-<?= $prospection->etat->class ?>"><?= $prospection->etat->name ?></span>
                                                            </td>
                                                            <td class="border-right" style="width: 70%">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr class="no">
                                                                            <th></th>
                                                                            <?php foreach ($prospection->ligneprospections as $key => $ligne) { 
                                                                                $ligne->actualise(); ?>
                                                                                <th class="text-center mp0" style="padding: 0; margin: 0"><?= $ligne->prixdevente->produit->name() ?><br><small><?= $ligne->prixdevente->prix->price() ?> <?= $params->devise  ?></small></th>
                                                                            <?php } ?>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr class="no">
                                                                            <td><h5 class="mp0">Qté : </h5></td>
                                                                            <?php foreach ($prospection->ligneprospections as $key => $ligne) { ?>
                                                                                <td class="text-center"><?= start0($ligne->quantite) ?> // 
                                                                                    <?php if ($prospection->etat_id == Home\ETAT::VALIDEE) { ?>
                                                                                        <span class="text-green"><?= start0($ligne->quantite_vendu) ?></span>
                                                                                        <?php }  ?></td>
                                                                                    <?php   } ?>
                                                                                </tr>
                                                                                <?php if ($prospection->etat_id == Home\ETAT::VALIDEE) { ?>
                                                                                    <tr class="no">
                                                                                        <td><h5 class="mp0">Perte :</h5></td>
                                                                                        <?php foreach ($prospection->ligneprospections as $key => $ligne) { ?>
                                                                                            <td class="text-center"><?= start0($ligne->perte) ?></td>
                                                                                        <?php   } ?>
                                                                                    </tr>
                                                                                <?php } ?>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                    <td style="width: 10%">
                                                                        <button class="btn btn-white btn-sm"><a href="<?= $this->url("gestion", "fiches", "bonsortie", $prospection->getId()) ?>" target="_blank"><i class="fa fa-file-text text-blue"></i></a></button><br>
                                                                        <?php if ($prospection->etat_id == Home\ETAT::ENCOURS) { ?>
                                                                            <button onclick="terminer(<?= $prospection->getId() ?>)" class="btn btn-primary btn-sm"><i class="fa fa-check"></i></button><br>
                                                                            <?php if ($employe->isAutoriser("modifier-supprimer")) { ?>
                                                                                <button onclick="annulerProspection(<?= $prospection->getId() ?>)" class="btn btn-white btn-sm"><i class="fa fa-close text-red"></i></button>
                                                                            <?php } ?>
                                                                        <?php } ?>
                                                                    </td>
                                                                </tr>
                                                            <?php  } ?>
                                                        </tbody>
                                                    </table><hr>
                                                <?php  }else{ ?>
                                                    <h2 style="margin-top: 15% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune prospection encore pour ce commercial !</h2>
                                                <?php } ?>

                                            </div>
                                        </div>

                                    <?php } ?>


                                    <div id="tab-2" class="tab-pane"><br>
                                        <table class="table table-hover table-bordered table-striped table-hover text-center">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Nbr. de tours</th>
                                                    <th>Cumul Montant</th>
                                                    <th>Cumul recette</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                foreach ($commercial->rapports(7) as $key => $item) { ?>
                                                    <tr>
                                                        <td><?= datecourt3($item->date) ?></td>
                                                        <td><?= start0($item->count) ?> prospection(s)</td>
                                                        <td class="gras text-muted"><?= money($item->montant) ?> <?= $params->devise ?></td>
                                                        <td class="gras text-green"><?= money($item->vendu) ?> <?= $params->devise ?></td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                        <?php foreach ($fluxcaisse as $key => $transaction) {
                                            $transaction->actualise(); ?>
                                            <div class="timeline-item">
                                                <div class="row">
                                                    <div class="col-2 date" style="padding-right: 1%; padding-left: 1%;">
                                                        <i data-toggle="tooltip" tiitle="Imprimer le bon" class="fa fa-file-text"></i>
                                                        <?= heurecourt($transaction->created) ?>
                                                        <br/>
                                                        <small class="text-navy"><?= datecourt($transaction->created) ?></small>
                                                    </div>
                                                    <div class="col-10 content">
                                                        <p>
                                                            <span class="">Bon de caisse N°<strong><?= $transaction->reference ?></strong></span>
                                                            <span class="pull-right text-right <?= ($transaction->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::ENTREE)?"text-green":"text-red" ?>">
                                                                <span class="gras" style="font-size: 16px"><?= money($transaction->montant) ?> <?= $params->devise ?> <?= ($transaction->etat_id == Home\ETAT::ENCOURS)?"*":"" ?></span> <br>
                                                                <small>Par <?= $transaction->modepayement->name() ?></small><br>
                                                                <a href="<?= $this->url("gestion", "fiches", "boncaisse", $transaction->getId())  ?>" target="_blank" class="simple_tag"><i class="fa fa-file-text-o"></i> Bon de caisse</a>
                                                            </span>
                                                        </p>
                                                        <p class="m-b-xs"><?= $transaction->comment ?> </p>
                                                        <p class="m-b-xs"><?= $transaction->structure ?> - <?= $transaction->numero ?></p>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>                 
                                    </div>



                                    <?php if ($employe->isAutoriser("caisse")) { ?>
                                        <div id="tab-3" class="tab-pane"><br>
                                            <?php foreach ($fluxcaisse as $key => $transaction) {
                                                $transaction->actualise(); ?>
                                                <div class="timeline-item">
                                                    <div class="row">
                                                        <div class="col-2 date" style="padding-right: 1%; padding-left: 1%;">
                                                            <i data-toggle="tooltip" tiitle="Imprimer le bon" class="fa fa-file-text"></i>
                                                            <?= heurecourt($transaction->created) ?>
                                                            <br/>
                                                            <small class="text-navy"><?= datecourt($transaction->created) ?></small>
                                                        </div>
                                                        <div class="col-10 content">
                                                            <p>
                                                                <span class="">Bon de caisse N°<strong><?= $transaction->reference ?></strong></span>
                                                                <span class="pull-right text-right <?= ($transaction->categorieoperation->typeoperationcaisse_id == Home\TYPEOPERATIONCAISSE::ENTREE)?"text-green":"text-red" ?>">
                                                                    <span class="gras" style="font-size: 16px"><?= money($transaction->montant) ?> <?= $params->devise ?> <?= ($transaction->etat_id == Home\ETAT::ENCOURS)?"*":"" ?></span> <br>
                                                                    <small>Par <?= $transaction->modepayement->name() ?></small><br>
                                                                    <a href="<?= $this->url("gestion", "fiches", "boncaisse", $transaction->getId())  ?>" target="_blank" class="simple_tag"><i class="fa fa-file-text-o"></i> Bon de caisse</a>
                                                                </span>
                                                            </p>
                                                            <p class="m-b-xs"><?= $transaction->comment ?> </p>
                                                            <p class="m-b-xs"><?= $transaction->structure ?> - <?= $transaction->numero ?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php } ?>                 
                                        </div>
                                    <?php } ?>


                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-sm-4">
                    <div class="ibox selected">

                        <div class="ibox-content">
                            <div class="tab-content">
                                <div id="contact-1" class="tab-pane active">
                                    <h2><?= $commercial->name() ?> 

                                    <?php if ($employe->isAutoriser("modifier-supprimer")) { ?>
                                        <i onclick="modification('commercial', <?= $commercial->getId() ?>)" data-toggle="modal" data-target="#modal-commercial" class="pull-right fa fa-pencil cursor"></i>
                                    <?php } ?>
                                </h2>
                                <address>
                                    <i class="fa fa-phone"></i>&nbsp; <?= $commercial->contact ?><br>
                                    <i class="fa fa-map-marker"></i>&nbsp; <?= $commercial->adresse ?><br>
                                </address><hr>

                                <div class="m-b-lg">
                                    <span>Salaire mensuel fixe</span><br>
                                    <h2 class="font-bold d-inline"><?= money($commercial->salaire) ?> <?= $params->devise  ?></h2> 
                                    <i onclick="modification('commercial', <?= $commercial->getId() ?>)" data-toggle="modal" data-target="#modal-salaire" class="fa fa-pencil fa-2x pull-right cursor"></i>
                                    <br><br>

                                    <span>Bonus/Prime du mois</span><br>
                                    <h3 class="font-bold text-muted"><?= money($commercial->salaire) ?> <?= $params->devise  ?></h3>     

                                    <hr>

                                    <span>Salaire à payer ce mois</span><br>
                                    <h2 class="font-bold text-red"><?= money($commercial->salaire) ?> <?= $params->devise  ?></h2> <br>
                                    <?php if ($commercial->salaire > 0) { ?>
                                     <button type="button" data-toggle="modal" data-target="#modal-fournisseur-rembourse" class="btn btn-danger dim btn-block"><i
                                        class="fa fa-money"></i> Payer le salaire
                                    </button>
                                <?php } ?>                

                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>

<?php include($this->rootPath("composants/assets/modals/modal-commercial.php")); ?>   
<?php include($this->rootPath("composants/assets/modals/modal-payement-salaire.php")); ?>  
<?php include($this->rootPath("composants/assets/modals/modal-prospection_.php")); ?>  

<?php 
foreach ($prospections as $key => $prospection) {
 $prospection->actualise();
 $prospection->fourni("ligneprospection");
 include($this->rootPath("composants/assets/modals/modal-prospection2.php"));
} 
?>

</div>
</div>


<div class="modal inmodal fade" id="modal-salaire">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Salaire</h4>
            </div>
            <form method="POST" class="formShamman" classname="commercial">
                <div class="modal-body">
                    <div class="">
                        <label>Nouveau salaire <span1>*</span1></label>
                        <div class="form-group">
                            <input type="number" number class="form-control" name="salaire" required>
                        </div>
                    </div>                  
                </div><hr>
                <div class="container">
                    <input type="hidden" name="id">
                    <button class="btn btn-sm dim btn-success pull-right"><i class="fa fa-check"></i> Valider</button>
                </div>
            </form>
        </div>
    </div>
</div>



<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->relativePath("../../master/client/script.js") ?>"></script>


</body>

</html>
