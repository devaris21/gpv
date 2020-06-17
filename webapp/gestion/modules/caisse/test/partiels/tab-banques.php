  <div role="tabpanel" id="tab-banques" class="tab-pane">
    <div class="panel-body">
     <div class="row">
        <div class="col-lg-12">
            <div class="ibox ">
                <div class="ibox-title">
                    <h5 class="text-uppercase">Comptes & Banques</h5>
                    <div class="float-right">
                        <div class="btn-group">
                            <button type="button" data-toggle="modal" data-target="#modal-comptebanque" class="btn btn-xs btn-white active"><i class="fa fa-plus"></i> Ajouter un compte/banque</button>
                        </div>
                    </div>
                </div>
                <div class="ibox-content">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="flot-chart" style="height: 250px">
                                <div class="flot-chart-content" id="flot-line-chart-multi"></div>
                            </div><hr>
                            <div class="row text-center">
                                <div class="col-md">
                                    <button data-toggle="modal" data-target="#modal-transfertfond" class="btn btn-warning dim"><i class="fa fa-exchange"></i> Transfert de fonds </button>
                                </div>
                            </div>
                        </div>
                        <div class="offset-1 col-lg-3">
                            <ul class="stat-list">
                                <?php foreach (Home\COMPTEBANQUE::getAll() as $key => $banque) { ?>
                                    <li onclick="session('comptebanque_id', <?= $banque->getId() ?>)" class="cursor" data-toggle="modal" data-target="#modal-optioncompte-<?= $banque->getId() ?>">
                                        <h2 class="no-margins"><?= money($banque->solde(Home\PARAMS::DATE_DEFAULT, dateAjoute())) ?> <?= $params->devise ?></h2>
                                        <small><?= $banque->name() ?></small>
                                        <div class="stat-percent">à jour <i class="fa fa-calendar text-navy"></i></div>
                                        <div class="progress progress-mini">
                                            <div style="width: 48%;" class="progress-bar"></div>
                                        </div>
                                    </li><br>
                                <?php } ?>
                            </ul>
                        </div>
                    </div><hr><br>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-operation">
                                    <thead>
                                        <tr class="text-center text-uppercase">
                                            <th style="visibility: hidden; width: 65%"></th>
                                            <th>Dépot</th>
                                            <th>Retrait</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach (Home\MOUVEMENT::findBy(["comptebanque_id !="=>Home\COMPTEBANQUE::COURANT], [], ["created"=>"DESC"], 10) as $key => $mvt) {
                                            $mvt->actualise(); ?>
                                            <tr>
                                                <td>
                                                    <h6 style="margin-bottom: 3px" class="mp0 text-uppercase gras <?= ($mvt->typemouvement_id == Home\TYPEMOUVEMENT::DEPOT)?"text-green":"text-red" ?>"><?= $mvt->typemouvement->name() ?> | <span class="text-muted"><?= $mvt->comptebanque->name() ?></span>

                                                    <?php if ($employe->isAutoriser("modifier-supprimer")) { ?>
                                                        |
                                                        &nbsp;&nbsp;<i onclick="modifierOperation(<?= $mvt->getId() ?>)" class="cursor fa fa-pencil text-dark"></i> 
                                                        &nbsp;&nbsp;<i class="cursor fa fa-close text-red" onclick="suppressionWithPassword('mouvement', <?= $mvt->getId() ?>)"></i>
                                                    <?php } ?>
                                                    <span class="pull-right"><i class="fa fa-clock-o"></i> <?= datelong($mvt->created) ?></span>
                                                </h6>
                                                <i><?= $mvt->comment ?></i>
                                            </td>
                                            <?php if ($mvt->typemouvement_id == Home\TYPEMOUVEMENT::DEPOT) { ?>
                                                <td class="text-center text-green gras" style="padding-top: 12px;">
                                                    <?= money($mvt->montant) ?> <?= $params->devise ?>
                                                </td>
                                                <td class="text-center"> - </td>
                                            <?php }elseif ($mvt->typemouvement_id == Home\TYPEMOUVEMENT::RETRAIT) { ?>
                                                <td class="text-center"> - </td>
                                                <td class="text-center text-red gras" style="padding-top: 12px;">
                                                    <?= money($mvt->montant) ?> <?= $params->devise ?>
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>
</div>
</div>
</div>
