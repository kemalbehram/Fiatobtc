<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container mt-5">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Détails de l'ordre d'achat</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Exchange</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="callout callout-danger">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        <strong class="text-info">Taux : <?= $commands['taux']?> %</strong><br>
                        <b class="text-info ">Quantité Maximale : <?= $commands['qte']?> USD</b>
                    </div>

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <form action="<?= base_url()?>exchange/savebuyfiat" method="post">
                            <input type="hidden" name="id_exchange" value="<?= $commands['id_exchange']?>">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12">
                                        <div class="input-group mb-3">
                                            <div class="input-group-append">
                                                <div class="input-group-text">Quantité</div>
                                            </div>
                                            <input type="number" class="form-control text-center" name="qte_usd" id="usd_qte" step="any" min="10" max="<?= $commands['qte']?>" required>
                                            <div class="input-group-append">
                                                <div class="input-group-text">USD/<?= $commands['product']?></div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($commands['product'] == 'BTC'): ?>
                                            <input type="text" class="form-control" name="qte_btc" id="btc_qte" readonly="true">
                                            <div class="input-group-append">
                                                <span class="input-group-text">BTC</span>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Total à payer</span>
                                    </div>
                                    <input type="text" class="form-control text-center" name="qte_totale" id="total_a_payer" readonly="true">
                                    <div class="input-group-append">
                                        <span class="input-group-text">USD</span>
                                    </div>
                                </div>

                                <input type="hidden" id="taux_transaction" name="taux_transaction" value="<?= $commands['taux']?>">
                                <input type="hidden" name="product" value="<?= $commands['product']?>">

                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text">Placer</div>
                                    </div>
                                    <input type="text" class="form-control" name="hash_code" placeholder="Coller votre le code Hash" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <div class="input-group-text">Téléphone Mobile Money</div>
                                    </div>
                                    <input type="text" class="form-control" name="telephone" placeholder="Votre numéro MPESA ou Airtel Money)" required>
                                </div>
                               
                                <input type="hidden" name="moyen_paiement" value="<?= $commands['moyen_paiement']?>">
                                <input type="submit" value="Acheter USD vs <?= $commands['product']?>" class="btn btn-primary">
                        </form>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
