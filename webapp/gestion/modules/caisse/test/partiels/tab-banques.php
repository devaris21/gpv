  <div role="tabpanel" id="tab-banques" class="tab-pane">
                    <div class="panel-body">
                     <div class="row">
                        <div class="col-lg-12">
                            <div class="ibox ">
                                <div class="ibox-title">
                                    <h5 class="text-uppercase">Comptes & Banques</h5>
                                    <div class="float-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-xs btn-white active">Today</button>
                                            <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                            <button type="button" class="btn btn-xs btn-white">Annual</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="ibox-content">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <div class="flot-chart">
                                                <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <ul class="stat-list">
                                                <?php foreach (Home\COMPTEBANQUE::getAll() as $key => $banque) { ?>
                                                    <li>
                                                    <h2 class="no-margins"><?= money($banque->solde(dateAjoute())) ?> <?= $params->devise ?></h2>
                                                    <small><?= $banque->name() ?></small>
                                                    <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                                    <div class="progress progress-mini">
                                                        <div style="width: 48%;" class="progress-bar"></div>
                                                    </div>
                                                </li>
                                                <?php } ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
