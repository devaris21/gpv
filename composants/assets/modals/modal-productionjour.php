
<div class="modal inmodal fade" id="modal-productionjour" style="z-index: 1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-body">
                <div class="ibox-content">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <div class="">
                        <h2 class="title text-uppercase gras text-center">Nouvelle vente directe au client</h2>
                    </div><hr>

                    <form id="formProductionJour" classname="productionjour">

                        <?php foreach (Home\PRODUIT::getAll() as $key => $produit) { ?>
                            <div class="row">
                                <div class="col-md-3 col-md">
                                    <label>Quantité de <b><?= $produit->name() ?></b></label>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <?php $produit->fourni("prixdevente", ["isActive ="=>Home\TABLE::OUI]);
                                        foreach ($produit->prixdeventes as $key => $prixdv) {
                                            $prixdv->actualise(); ?>
                                            <div class="col-md col-sm">
                                                <label><b><?= money($prixdv->prix->price) ?></b> <?= $params->devise  ?></label>
                                                <input type="number" data-produit="" data-prix="" data-toggle="tooltip" value="0" min=0 number class="gras form-control text-center" name="prod-<?= $prixdv->getId() ?>">
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div><hr>
                        <?php } ?>

                       <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <h5 class="text-uppercase"><u>Montant total</u></h5>
                                <h1 class="gras">300 Fcfa</h1>
                            </div>

                            <div class="col-md-4 offset-md-2">
                                <h5 class="text-uppercase"><u>Mode de payement</u></h5>
                                <?php Native\BINDING::html("select", "modepayement") ?>
                            </div>
                        </div><br>


                        <div class="">
                            <button class="btn pull-right dim btn-primary" ><i class="fa fa-check"></i> Valider la vente</button>
                        </div><br>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
