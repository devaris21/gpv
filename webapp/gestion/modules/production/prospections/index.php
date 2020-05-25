<!DOCTYPE html>
<html>

<?php include($this->rootPath("webapp/gestion/elements/templates/head.php")); ?>


<body class="fixed-sidebar">

    <div id="wrapper">

        <?php include($this->rootPath("webapp/gestion/elements/templates/sidebar.php")); ?>  

        <div id="page-wrapper" class="gray-bg">

          <?php include($this->rootPath("webapp/gestion/elements/templates/header.php")); ?>  

          <div class="row wrapper border-bottom white-bg page-heading">
            <div class="col-sm-9">
                <h2 class="text-uppercase text-warning gras">Les ventes en cours</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-xs-7 gras ">Afficher même les ventes passées</div>
                        <div class="offset-1"></div>
                        <div class="col-xs-4">
                            <div class="switch">
                                <div class="onoffswitch">
                                    <input type="checkbox" class="onoffswitch-checkbox" id="example1">
                                    <label class="onoffswitch-label" for="example1">
                                        <span class="onoffswitch-inner"></span>
                                        <span class="onoffswitch-switch"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-3">
               <div class="row">
                <div class="col-md-12">
                    <div class="widget style1 bg-orange">
                        <div class="row">
                            <div class="col-4">
                                <i class="fa fa-truck fa-3x"></i>
                            </div>
                            <div class="col-8 text-right">
                                <span> ventes en cours </span>
                                <h2 class="font-bold"><?= start0(count($prospections__)) ?></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content">
        <div class="ibox">
            <div class="ibox-title">
                <h5>Toutes les ventes</h5>
                <div class="ibox-tools">
                    <button style="margin-top: -5%;" type="button" data-toggle=modal data-target='#modal-clients' class="btn btn-primary btn-sm dim float-right"><i class="fa fa-plus"></i> Nouvelle vente </button>
                </div>
            </div>
            <div class="ibox-content" style="min-height: 300px">
                <table class="table table-hover table-vente">
                    <tbody>
                        <?php foreach ($prospections as $key => $vente) {
                            $vente->actualise(); 
                            $client = new CLIENT();
                            $client->setId(Home\CLIENT::ANONYME)->actualise();
                            if ($vente->groupecommande_id != null) {
                                $client = $vente->groupecommande->client;
                            }
                            $vente->fourni("lignedevente");
                            ?>
                            <tr class="<?= ($vente->etat_id != Home\ETAT::ENCOURS)?'fini':'' ?> border-bottom" style="border-bottom: 2px solid black">
                                <td class="project-status">
                                    <span class="label label-<?= $vente->etat->class ?>"><?= $vente->etat->name ?></span>
                                </td>
                                <td class="project-title border-right" style="width: 30%;">
                                    <h4 class="text-uppercase">vente N°<?= $vente->reference ?></h4>
                                    <h6 class="text-uppercase text-muted">Client :  <?= $vente->groupecommande->client->name() ?></h6>
                                    <h6 class="text-uppercase text-muted">Chauffeur :  <?= $vente->chauffeur->name() ?></h6>
                                    <span>Emise <?= depuis($vente->created) ?></span>
                                </td>
                                <td class="border-right" style="width: 25%">
                                    <div class="row">
                                        <div class="col-3">
                                            <img style="width: 40px" src="<?= $this->stockage("images", "vehicules", $vente->vehicule->image) ?>">
                                        </div>
                                        <div class="col-9">
                                            <h5 class="mp0"><?= $vente->vehicule->typevehicule->name() ?></h5>
                                            <h6 class="mp0"><?= $vente->vehicule() ?></h6>
                                        </div>
                                    </div><hr class="mp3">
                                    <h5 class="mp0"><small><?= $vente->zonevente->name() ?></small><br> <?= $vente->lieu ?></h5>
                                </td>
                                <td class="border-right" style="width: 32%">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="no">
                                                <th></th>
                                                <?php foreach ($vente->lignedeventes as $key => $ligne) { 
                                                    $ligne->actualise(); ?>
                                                    <th class="text-center text-uppercase"><?= $ligne->produit->name() ?></th>
                                                <?php } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="no">
                                                <td><h4 class="mp0"><?= ($vente->etat_id == Home\ETAT::VALIDEE)?'livrés':'à livrer' ?> : </h4></td>
                                                <?php foreach ($vente->lignedeventes as $key => $ligne) { ?>
                                                    <td class="text-center <?= ($vente->etat_id == Home\ETAT::VALIDEE)?'text-warning':'' ?>"><?= $ligne->quantite_livree ?></td>
                                                <?php   } ?>
                                            </tr>
                                            <?php if ($vente->etat_id == Home\ETAT::VALIDEE) { ?>
                                                <tr class="no">
                                                    <td><h4 class="mp0">Restait :</h4></td>
                                                    <?php foreach ($vente->lignedeventes as $key => $ligne) { ?>
                                                        <td class="text-center"><?= $ligne->reste ?></td>
                                                    <?php   } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </td>
                                <td>
                                    <a href="<?= $this->url("gestion", "fiches", "bonvente", $vente->getId()) ?>" target="_blank" class="btn btn-block btn-white btn-sm"><i class="fa fa-file-text text-blue"></i> Bon de vente</a><br>
                                    <?php if ($vente->etat_id == Home\ETAT::ENCOURS) { ?>
                                        <button onclick="terminer(<?= $vente->getId() ?>)" class="btn btn-primary btn-sm"><i class="fa fa-check"></i> Terminer</button>
                                        <?php if ($employe->isAutoriser("modifier-supprimer")) { ?>
                                            <button onclick="annulervente(<?= $vente->getId() ?>)" class="btn btn-white btn-sm"><i class="fa fa-close text-red"></i></button>
                                        <?php } ?>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php  } ?>
                    </tbody>
                </table>
                <?php if (count($prospections__) == 0) { ?>
                    <h1 style="margin-top: 30% auto;" class="text-center text-muted aucun"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune prospection en cours pour le moment !</h1>
                <?php } ?>

            </div>
        </div>
    </div>


    <?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?>

    <?php include($this->rootPath("composants/assets/modals/modal-clients.php")); ?> 

    <?php 
    foreach ($prospections as $key => $vente) {
        if ($vente->etat_id == Home\ETAT::ENCOURS) { 
            $vente->actualise();
            $vente->fourni("lignedevente");
            include($this->rootPath("composants/assets/modals/modal-vente2.php"));
        } 
    } 
    ?>

</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->relativePath("../../master/client/script.js") ?>"></script>


</body>

</html>
