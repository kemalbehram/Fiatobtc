<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-5">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-5">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Détails de l'ordre de vente</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" title="Page d'accueil">Accueil</a></li>
                        <li class="breadcrumb-item active">Détails</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <div class="card card-secondary">


                    <div class="card-body">
                        <form action="<?= base_url() ?>exchange/cryptoTofiat" method="post">
                            <div class="form-group" disabled>
                                <label>Produit (Crypto)</label>
                                <input class="form-control" style="width: 100%;" readonly="true" name="product"
                                       value="<?= $data["product"] ?>">
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class=" col-sm-6 col-md-6">
                                        <label for="inputEstimatedBudget">Votre adresse BTC ou USDT(ERC20)</label>
                                        <input type="text" readonly class="form-control text-primary" name="cryptoAdresse"
                                               value="<?= $data["cryptoAdresse"] ?>" required>
                                    </div>

                                    <div class=" col-sm-6 col-md-6">
                                        <label for="inputEstimatedBudget">Votre Hash</label>
                                        <input type="text"  readonly class="form-control text-primary" name="hash" value="<?= $data["hash"] ?>"
                                               required>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class=" col-sm-6 col-md-6">
                                        <label for="inputSpentBudget">Quantité à vendre</label>
                                        <input type="number" readonly class="form-control" step="any" name="qte"
                                       value="<?= $data["qte"] ?>" required>
                                    </div>
                                    <div class="col-sm-6 col-md-6">
                                        <label for="inputEstimatedDuration">Taux en %</label>
                                        <input type="number" readonly class="form-control" step="any" name="taux"
                                               value="<?= $data["taux"] ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="row">
                                    <div class=" col-sm-6 col-md-6">
                                    <label>Moyen de payement</label>

                                    <select class="form-control" name="moyen_paiement" readonly>
                                        <?php if ($data["moyen_paiement"] == "244"): ?>
                                            <option selected readonly="true" value="<?= $data["moyen_paiement"] ?>">MPESA</option>
                                        <?php else: ?>
                                            <option selected readonly="true" value="<?= $data["moyen_paiement"] ?>">Airtel Money</option>
                                        <?php endif; ?>
                                    </select>
                                        </div>
                                        <div class=" col-sm-6 col-md-6">
                                            <label>Numéro de téléphone :</label>
                                                <input type="text" readonly class="form-control" name="telephone"
                                                       value="<?= $data["telephone"] ?>">
                                        </div>
                                    </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <a onclick="return confirm('Etes-vous sûr d\'annuler votre ordre de vente ?')" href="<?= base_url()?>exchange/cryptoTofiat" title="Annuler" class="btn btn-danger float-left">Annuler</a>
                                    <input type="submit" value="Modifier" name="btnUpdate" class="btn btn-warning ml-2">
                                    <input type="submit" value="Confirmer" name="btnConfirm"
                                           class="btn btn-success float-right">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>

            </div>
            <div class="col-sm-3"></div>
        </div>

    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->