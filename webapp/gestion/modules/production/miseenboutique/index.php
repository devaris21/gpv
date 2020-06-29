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
                <h2 class="text-uppercase text-green gras">Mise en boutique de la production</h2>
                <div class="container">
                    <!-- <div class="row">
                        <div class="col-xs-7 gras ">Afficher même les rangements passées</div>
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
                    </div> -->
                </div>
            </div>
            <div class="col-sm-3">
             <div class="row">
                <div class="col-md-12">
                    <div class="widget style1 lazur-bg">
                        <div class="row">
                            <div class="col-3">
                                <i class="fa fa-th-large fa-3x"></i>
                            </div>
                            <div class="col-9 text-right">
                                <span> Mise en boutique </span>
                                <h2 class="font-bold"><?= start0(count(Home\PRODUCTIONJOUR::ranges()))  ?></h2>
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
                <h5>Toutes les mises en boutique de la production</h5>
                <div class="ibox-tools">
                    <button data-toggle="modal" data-target="#modal-miseenboutique" class="btn btn-primary dim btn-block"><i class="fa fa-plus"></i> Nouvelle mise en boutique</button>
                </div>
            </div>
            <div class="ibox-content">
             <?php if (count($datas) > 0) { ?>
               <table class="table table-striped table-hover table-commande">
                <thead>
                    <tr>
                        <th>A la date du</th>
                        <th>Produit concerné</th>
                        <th>Quantité</th>
                        <th>Stock restant</th>
                        <th>Effectué par</th>
                        <th >Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($datas as $key => $mise) {
                        $mise->actualise(); ?>
                        <tr>
                            <td><?= datecourt3($mise->created) ?></td>
                            <td><?= $mise->prixdevente->produit->name() ?> <?= $mise->prixdevente->prix->price() ?> <?= $params->devise ?></td>
                            <td><?= $mise->quantite ?> unité(s)</td>
                            <td><?= $mise->restant ?> unité(s)</td>
                            <td><?= $mise->employe->name() ?></td>
                            <td onclick="suppressionWithPassword('miseenboutique', <?= $mise->getId() ?>)"><i class="fa fa-close cursor text-danger"></i></td>
                        </tr>
                    <?php  } ?>
                </tbody>
            </table>
        <?php }else{ ?>
            <h1 style="margin: 6% auto;" class="text-center text-muted"><i class="fa fa-folder-open-o fa-3x"></i> <br> Aucune mise en boutique effectuée pour le moment</h1>
        <?php } ?>

    </div>
</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/footer.php")); ?> 

<?php include($this->rootPath("composants/assets/modals/modal-miseenboutique.php")); ?> 


</div>
</div>


<?php include($this->rootPath("webapp/gestion/elements/templates/script.php")); ?>
<script type="text/javascript" src="<?= $this->relativePath("../../master/client/script.js") ?>"></script>


</body>

</html>
