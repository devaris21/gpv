
<div role="tabpanel" id="tab-stock" class="tab-pane">
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
            <div class="col-md-12">
                <h2 class="text-uppercase">Stock des intrants</h2>
                <table class="table table-striped table-hover text-center">
                    <thead>
                        <tr>
                            <th class="text-left">Libéllé</th>
                            <th>stock init</th>
                            <th>Achat</th>
                            <th>Conso</th>
                            <th>Variation</th>
                            <th>En cours</th>
                            <th>stock final</th>
                            <th>Valeur final</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0;
                        foreach (Home\RESSOURCE::getAll() as $key => $ressource) {
                            $prix = $ressource->stock($date2) * $ressource->price();
                            $total += $prix; ?>
                            <tr>
                                <td class="gras text-left">Stock de <?= $ressource->name() ?></td>
                                <td class="text-center"><?= $ressource->stock($date1) ?> <?= $ressource->abbr ?></td>
                                <td class="text-center"><?= $ressource->achat($date1, $date2) ?> <?= $ressource->abbr ?></td>
                                <td class="text-center"><?= $ressource->consommee($date1, $date2) ?> <?= $ressource->abbr ?></td>
                                <td class="text-center"><?= $ressource->stock($date2) - $ressource->stock($date1) ?> <?= $ressource->abbr ?></td>
                                <td class="text-center"><?= $ressource->en_cours() ?> <?= $ressource->abbr ?></td>
                                <td class="text-center"><?= $ressource->stock($date2) + $ressource->en_cours() ?> <?= $ressource->abbr ?></td>
                                <td class="text-center"><?= money($prix) ?> <?= $params->devise ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6" class="text-right"><h2 class="mp0">Total =</h2></td>
                            <td colspan="2" class="text-right"><h2 class="mp0"><?= money($total) ?> <?= $params->devise ?></h2></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-md-6">
                <h2 class="text-uppercase">Stock des produits </h2>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="2">Libéllé</th>
                            <th>Val début. Exe.</th>
                            <th></th>
                            <th>Val fin Exe.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total = 0;
                        foreach (Home\PRODUIT::getAll() as $key => $produit) {
                            $datas = $produit->fourni("prixdevente", ["isActive ="=>Home\TABLE::OUI]);
                            if (count($datas) > 0) {
                                $pdv = $datas[0];
                                $pdv->actualise();
                                unset($datas[0]);
                                $total += $pdv->montantStock();
                            } ?>
                            <tr>
                                <td class="gras text-muted text-center" rowspan="<?= count($datas)+1 ?>">
                                    <br><i class="fa fa-flask fa-3x"></i><br><?= $produit->name() ?>
                                </td>
                                <td class="gras text-muted"><?= $pdv->prix->price() ?> <?= $params->devise ?></td>
                                <!-- <td><?= $a = $pdv->stock($date1) ?></td> -->
                                <td><?= money($a * $pdv->prix->price) ?> <?= $params->devise ?></td>
                                <!-- <td><?= $pdv->stockGlobal() ?></td> -->
                                <td></td>
                                <td><?= money($pdv->montantStock()) ?> <?= $params->devise ?></td>
                            </tr>
                            <?php foreach ($datas as $key => $pdv) {
                                $pdv->actualise();
                                $total += $pdv->montantStock(); ?>
                                <tr>
                                    <td class="gras text-muted"><?= $pdv->prix->price() ?> <?= $params->devise ?></td>
                                    <!--  <td><?= $a = $pdv->stock($date1) ?></td> -->
                                    <td><?= money($a * $pdv->prix->price) ?> <?= $params->devise ?></td>
                                    <!-- <td><?= $pdv->stockGlobal() ?></td> -->
                                    <td></td>
                                    <td><?= money($pdv->montantStock()) ?> <?= $params->devise ?></td>
                                </tr>
                            <?php } ?>
                            <tr height="25px"></tr>
                        <?php } ?>

                        <tr>
                            <td colspan="3" class="text-right"><h2 class="mp0">Total =</h2></td>
                            <td colspan="2"><h2 class="mp0"><?= money($total) ?> <?= $params->devise ?></h2></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <strong>Donec quam felis</strong>

        <p>Thousand unknown plants are noticed by me: when I hear the buzz of the little world among the stalks, and grow familiar with the countless indescribable forms of the insects
        and flies, then I feel the presence of the Almighty, who formed us in his own image, and the breath </p>

        <p>I am alone, and feel the charm of existence in this spot, which was created for the bliss of souls like mine. I am so happy, my dear friend, so absorbed in the exquisite
        sense of mere tranquil existence, that I neglect my talents. I should be incapable of drawing a single stroke at the present moment; and yet.</p>
    </div>
</div>