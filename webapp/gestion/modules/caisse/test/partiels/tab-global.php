  
<div role="tabpanel" id="tab-global" class="tab-pane active">
    <div class="panel-body">
        <div class="row">
            <div class="col-sm-5">
                <h1 class="mp0 d-inline">Trésorerie générale</h1> <span> /// Pour l'exercixe 2019 - 2020</span>
            </div>

            <div class="offset-5 col-sm-2 text-center">
                <div class="form-group">
                    <?php Native\BINDING::html("select", "client"); ?>
                </div>
            </div>
        </div>
        

        <div class="row white-bg dashboard-header">
            <div class="col-md-3">
                <ul class="list-group clear-list">
                    <li class="list-group-item fist-item">
                        <span class="label label-success">1</span> Please contact me
                        <span class="float-right">
                            09:00 pm
                        </span>
                    </li>
                    <li class="list-group-item">
                        Impôts et TVA
                        <span class="float-right">
                            10:16 am
                        </span>
                    </li>
                    <li class="list-group-item">
                        Masse salariale
                        <span class="float-right">
                            08:22 pm
                        </span>
                    </li>
                    <li class="list-group-item">
                        Dette de clients
                        <span class="float-right">
                            11:06 pm
                        </span>
                    </li>
                    <li class="list-group-item">
                        Dette de fournisseurs
                        <span class="float-right">145 000 Fcfa</span>
                    </li>
                    <li class="list-group-item">
                        Dette de fournisseurs
                        <span class="float-right">145 000 Fcfa</span>
                    </li>
                    <li class="list-group-item">
                        Dette de fournisseurs
                        <span class="float-right">145 000 Fcfa</span>
                    </li>
                </ul>
            </div>
            <div class="offset-1 col-md-8">
                <div class="flot-chart">
                    <div class="flot-chart-content" id="flot-dashboard-chart" height="700px"></div>
                </div><hr>
                <div class="row text-center">
                    <div class="col">
                        <div class=" m-l-md">
                            <span class="h5 font-bold block">$ 406,100</span>
                            <small class="text-muted block">Trésorerie Net</small>
                        </div>
                    </div>
                    <div class="col">
                        <span class="h5 font-bold block">$ 150,401</span>
                        <small class="text-muted block">Resultat Net</small>
                    </div>
                    <div class="col">
                        <span class="h5 font-bold block">$ 16,822</span>
                        <small class="text-muted block">Net en caisse</small>
                    </div>
                </div>
            </div>
        </div><hr>

        <div class="row text-center" style="font-size: 11px">
            <div class="col-md">
                <button class="btn btn-primary dim"><i class="fa fa-cart-plus"></i> Faire nouvelle commande</button>
            </div>
            <div class="col-md">
                <button class="btn btn-success dim"><i class="fa fa-truck"></i> Programmer livraison </button>
            </div>
            <div class="col-md">
                <button class="btn btn-success dim"><i class="fa fa-truck"></i> Voir le budget prévisionnel </button>
            </div>
            <div class="col-md">
                <button class="btn btn-warning dim"><i class="fa fa-truck"></i> Documents de synthèse </button>
            </div>
            <div class="col-md">
                <button class="btn btn-success dim"><i class="fa fa-truck"></i> Cloture de l'exercice </button>
            </div>
        </div>
    </div>
</div>