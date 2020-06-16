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
                        <div class="col-lg-9">
                            <div class="flot-chart">
                                <div class="flot-chart-content" id="flot-line-chart-multi" height="350px"></div>
                            </div><hr>
                            <div class="row text-center" style="font-size: 11px">
                                <div class="col-md">
                                    <button class="btn btn-primary dim"><i class="fa fa-cart-plus"></i> Faire nouvelle commande</button>
                                </div>
                                <div class="col-md">
                                    <button class="btn btn-warning dim"><i class="fa fa-truck"></i> Transfert de fonds </button>
                                </div>
                                <div class="col-md">
                                    <button class="btn btn-success dim"><i class="fa fa-truck"></i> Cloture de l'exercice </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <ul class="stat-list">
                                <?php foreach (Home\COMPTEBANQUE::getAll() as $key => $banque) { ?>
                                    <li>
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
                    </div><br><br>

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

            </div>

        </div>

    </div>
</div>
</div>
</div>
</div>
