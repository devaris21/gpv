
<div class="modal inmodal fade" id="modal-immobilisation-<?= $immobilisation->getId() ?>">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Fiche du bien immobilisé</h4>
                <small class="font-bold">Renseigner ces champs pour enregistrer les informations</small>
            </div>
            <form method="POST" class="formShamman" classname="fournisseur">
                <div class="modal-body">
                    <h1 class="mp0 d-inline"><?= $immobilisation->name() ?> </h1>
                    <button class="btn btn-danger dim pull-right"><i class="fa fa-exclamation"></i> Mise au rebut</button>
                    <br><br>

                    <div class="row">
                        <div class="col-sm-7">
                            <h3><?= money($immobilisation->montant) ?> <?= $params->devise  ?> ~~ <?= money($immobilisation->resteAmortissement()) ?> <?= $params->devise  ?></h3>
                            <h5><?= $immobilisation->typeimmobilisation->name() ?></h5>
                        </div>
                        <div class="col-sm-5">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Total amortis :</td>
                                        <td class="text-right"><?= money($immobilisation->amortis()) ?> <?= $params->devise  ?></td>
                                    </tr>
                                    <tr>
                                        <td>Reste à amortis :</td>
                                        <td class="text-right"><?= money($immobilisation->resteAmortissement()) ?> <?= $params->devise  ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div><hr>

                    <div>
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>Exercice</th>
                                    <th>Base Amortis.</th>
                                    <th>Amort. fiscal</th>
                                    <th>Val. residuel</th>
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
                            </tbody>
                        </table>
                    </div>

                </div><hr>
                <div class="container">
                    <input type="hidden" name="id">
                    <button type="button" class="btn btn-sm  btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Annuler</button>
                    <button class="btn btn-sm bg-green pull-right"><i class="fa fa-refresh"></i> Valider le formulaire</button>
                </div>
                <br>
            </form>
        </div>
    </div>
</div>

