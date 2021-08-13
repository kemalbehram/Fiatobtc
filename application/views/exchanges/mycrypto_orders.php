<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-5">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Ordres d'echange</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" title="Page d'accueil">Accueil</a></li>
                        <li class="breadcrumb-item active">Ordres</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <?php if ($this->session->flashdata('achat_order_sent')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?php echo $this->session->flashdata('achat_order_sent'); ?></strong>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('solde_sent')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?php echo $this->session->flashdata('solde_sent'); ?></strong>
                    </div>
                <?php endif; ?>
                <!-- /.card -->
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <!-- /.card -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Mes ordres de ventes (CRYPTO VS FIAT)</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php if ($userorderdata == ''): ?>
                            <h5 class="text-danger text-center">Vous n'avez aucun ordre de vente crypto contre du fiat
                                posé sur la plate-forme</h5>
                        <?php else: ?>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Crypto</th>
                                    <th>Quantité</th>
                                    <th>Taux</th>
                                    <th>Statut</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($userorderdata

                                as $row): ?>
                                <tr>
                                    <td><?= $row->product ?></td>
                                    <td><?= $row->qte ?></td>
                                    <td><?= $row->taux ?> %</td>
                                    <?php if ($row->statut_demande == 'cancel'): ?>
                                        <td class="text-danger">Rejeté</td>
                                    <?php elseif ($row->statut_demande == 'confirm'): ?>
                                        <td class="text-success">Accepté</td>
                                    <?php else: ?>
                                        <td class="text-warning">En cours</td>
                                    <?php endif; ?>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <?php if ($row->statut_demande == 'confirm' || $row->statut_demande == 'process') : ?>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#modal-view-details-<?= $row->id_exchange ?>"
                                                   class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                            <?php else: ?>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#modal-view-details-<?= $row->id_exchange ?>"
                                                   class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tbody>

                                <!-- /.modal -->
                                <div class="modal fade" id="modal-view-details-<?= $row->id_exchange ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Statut :
                                                    <?php
                                                    if ($row->statut_demande == 'confirm') {
                                                        echo 'Accepté';
                                                    } elseif ($row->statut_demande == 'cancel') {
                                                        echo 'Réjeté';
                                                    } else {
                                                        echo 'En cours';
                                                    }
                                                    ?>
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="#" method="post">
                                                <div class="modal-body">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <div class="row text-center">
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Date</span>
                                                                        </div>
                                                                        <input type="text"
                                                                               class="form-control text-center" disabled
                                                                               value="<?= date('d M Y', strtotime($row->date_envoi)) ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Crypto</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->product ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Quantité</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->qte ?>">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Taux</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->taux ?>">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-8 col-sm-8 col-12">
                                                                    <div class="input-group mb-3">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Paie via</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->telephone ?>">
                                                                        <div class="input-group-append">
                                                                            <?php if ($row->moyen_paiement == '244'): ?>
                                                                                <span class="input-group-text">MPESA</span>
                                                                            <?php else: ?>
                                                                                <span class="input-group-text">AIRTEL</span>
                                                                            <?php endif; ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Adresse Crypto</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center text-primary"
                                                                               value="<?= $row->cryptoAdresse ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Hash</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center text-primary"
                                                                               value="<?= $row->hash ?>">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Fermer
                                                    </button>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    </form>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <?php endforeach; ?>

                            </table>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <!-- /.card -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Mes ordres d'achats (CRYPTO VS FIAT)</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php if ($cryptobuyorders == ''): ?>
                            <h5 class="text-danger text-center">Vous n'avez aucun ordre d'achats crypto contre du fiat
                                sur la plate-forme</h5>
                        <?php else: ?>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Crypto</th>
                                    <th>Quantité</th>
                                    <th>Total(Qte+Taux)</th>
                                    <th>Statut</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($cryptobuyorders

                                as $row): ?>
                                <tr>
                                    <td><?= $row->product ?></td>
                                    <td><?= $row->qte_commande ?></td>
                                    <td><?= $row->qte_totale ?> $ <?= $row->product ?></td>
                                    <?php if ($row->statut_buy_exchange == 'cancel'): ?>
                                        <td class="text-danger">Rejeté</td>
                                    <?php elseif ($row->statut_buy_exchange == 'confirm'): ?>
                                        <td class="text-success">Accepté</td>
                                    <?php else: ?>
                                        <td class="text-warning">En cours</td>
                                    <?php endif; ?>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" data-toggle="modal"
                                               data-target="#modal-view-details-achats-<?= $row->id_buying ?>"
                                               class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tbody>

                                <!-- /.modal -->
                                <div class="modal fade" id="modal-view-details-achats-<?= $row->id_buying ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Statut :
                                                    <?php
                                                    if ($row->statut_buy_exchange == 'confirm') {
                                                        echo 'Accepté';
                                                    } elseif ($row->statut_buy_exchange == 'cancel') {
                                                        echo 'Réjeté';
                                                    } else {
                                                        echo 'En cours';
                                                    }
                                                    ?>
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="#" method="#">
                                                <div class="modal-body">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <div class="row text-center">
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Date</span>
                                                                        </div>
                                                                        <input type="text"
                                                                               class="form-control text-center" disabled
                                                                               value="<?= date('d M Y', strtotime($row->date_envoi_cbe)) ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Crypto</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->product ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Quantité totale</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->qte_totale ?>$ <?= $row->product ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Hash Code</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center text-primary"
                                                                               value="<?= $row->hashAcheteur ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Crypto Adress</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center text-primary"
                                                                               value="<?= $row->cryptoAdresseAch ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">ID de transaction</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center text-primary"
                                                                               value="<?= $row->id_transaction ?>">
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Fermer
                                                    </button>
                                                </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    </form>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <?php endforeach; ?>

                            </table>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>


        <div class="row">
            <div class="col-md-6">
                <!-- /.card -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Mes ordres de ventes (FIAT VS CRYPTO)</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php if ($fiatorders == ''): ?>
                            <h5 class="text-danger text-center">Vous n'avez aucun ordre de vente de fiat contre crypto
                                posé sur la plate-forme</h5>
                        <?php else: ?>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Fiat</th>
                                    <th>Quantité</th>
                                    <th>Taux</th>
                                    <th>Crypto</th>
                                    <th>Statut</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($fiatorders

                                as $row): ?>
                                <tr>
                                    <td>USD</td>
                                    <td><?= $row->qte ?> USD</td>
                                    <td><?= $row->taux ?> %</td>
                                    <td><?= $row->product ?></td>
                                    <?php if ($row->statut_demande == 'cancel'): ?>
                                        <td class="text-danger">Rejeté</td>
                                    <?php elseif ($row->statut_demande == 'confirm'): ?>
                                        <td class="text-success">Accepté</td>
                                    <?php else: ?>
                                        <td class="text-warning">En cours</td>
                                    <?php endif; ?>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <?php if ($row->statut_demande == 'confirm' || $row->statut_demande == 'process') : ?>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#modal-view-details-orders-<?= $row->id_exchange ?>"
                                                   class="btn btn-info"><i class="fas fa-eye"></i></a>
                                                <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                                            <?php else: ?>
                                                <a href="#" data-toggle="modal"
                                                   data-target="#modal-view-details-<?= $row->id_exchange ?>"
                                                   class="btn btn-info"><i class="fas fa-eye"></i></a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tbody>

                                <!-- /.modal -->
                                <div class="modal fade" id="modal-view-details-orders-<?= $row->id_exchange ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Statut :
                                                    <?php
                                                    if ($row->statut_demande == 'confirm') {
                                                        echo 'Accepté';
                                                    } elseif ($row->statut_demande == 'cancel') {
                                                        echo 'Réjeté';
                                                    } else {
                                                        echo 'En cours';
                                                    }
                                                    ?>
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="#" method="post">
                                                <div class="modal-body">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <div class="row text-center">
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Date</span>
                                                                        </div>
                                                                        <input type="text"
                                                                               class="form-control text-center" disabled
                                                                               value="<?= date('d M Y', strtotime($row->date_envoi)) ?>">
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Quantité de départ</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->qte_max ?> USD">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Quantité actuelle</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->qte ?> USD">
                                                                    </div>
                                                                </div>


                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Taux</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->taux ?>">
                                                                        <div class="input-group-append">
                                                                            <span class="input-group-text">%</span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                 <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Crypto</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->product ?>">
                                                                    </div>
                                                                </div>
                                                               
                                                                <div class="col-md-12 col-sm-12 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Hash Code</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center text-primary"
                                                                               value="<?= $row->hash ?>">
                                                                    </div>
                                                                </div>
                                                                

                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Fermer
                                                    </button>
                                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Annuler</button>
                                                </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    </form>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <?php endforeach; ?>

                            </table>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <!-- /.card -->
                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Mes ordres d'achats (FIAT VS CRYPTO)</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <?php if ($fiatcommandes == ''): ?>
                            <h5 class="text-danger text-center">Vous n'avez aucun ordre d'achats de fiat contre crypto 
                                sur la plate-forme</h5>
                        <?php else: ?>
                            <table class="table table-responsive">
                                <thead>
                                <tr>
                                    <th>Crypto</th>
                                    <th>Quantité</th>
                                    <th>Total(Qte+Taux)</th>
                                    <th>Statut</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($fiatcommandes

                                as $row): ?>
                                <tr>
                                    <td><?= $row->product ?></td>
                                    <td><?= $row->qte_commande ?></td>
                                    <td><?= $row->qte_totale ?> $ <?= $row->product ?></td>
                                    <?php if ($row->statut_buy_exchange == 'cancel'): ?>
                                        <td class="text-danger">Rejeté</td>
                                    <?php elseif ($row->statut_buy_exchange == 'confirm'): ?>
                                        <td class="text-success">Accepté</td>
                                    <?php else: ?>
                                        <td class="text-warning">En cours</td>
                                    <?php endif; ?>
                                    <td class="text-right py-0 align-middle">
                                        <div class="btn-group btn-group-sm">
                                            <a href="#" data-toggle="modal"
                                               data-target="#modal-view-details-achats-fiat-<?= $row->id_buying ?>"
                                               class="btn btn-info"><i class="fas fa-eye"></i></a>
                                        </div>
                                    </td>
                                </tbody>

                                <!-- /.modal -->
                                <div class="modal fade" id="modal-view-details-achats-fiat-<?= $row->id_buying ?>">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Statut :
                                                    <?php
                                                    if ($row->statut_buy_exchange == 'confirm') {
                                                        echo 'Accepté';
                                                    } elseif ($row->statut_buy_exchange == 'cancel') {
                                                        echo 'Réjeté';
                                                    } else {
                                                        echo 'En cours';
                                                    }
                                                    ?>
                                                </h4>
                                                <button type="button" class="close" data-dismiss="modal"
                                                        aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <form action="#" method="#">
                                                <div class="modal-body">
                                                    <div class="card card-info">
                                                        <div class="card-body">
                                                            <div class="row text-center">
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Date</span>
                                                                        </div>
                                                                        <input type="text"
                                                                               class="form-control text-center" disabled
                                                                               value="<?= date('d M Y', strtotime($row->date_envoi_cbe)) ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Crypto</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->product ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4 col-sm-4 col-12">
                                                                    <div class="input-group mb-2">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Qté totale</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center"
                                                                               value="<?= $row->qte_totale ?>$ <?= $row->product ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Hash Code</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center text-primary"
                                                                               value="<?= $row->hashAcheteur ?>">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-12 col-sm-12 col-12">
                                                                    <div class="input-group">
                                                                        <div class="input-group-prepend">
                                                                            <span class="input-group-text">Crypto Adress</span>
                                                                        </div>
                                                                        <input type="text" disabled
                                                                               class="form-control text-center text-primary"
                                                                               value="<?= $row->cryptoAdresseAch ?>">
                                                                    </div>
                                                                </div>
                                                              

                                                            </div>
                                                        </div>
                                                        <!-- /.card-body -->
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Fermer
                                                    </button>
                                                </div>
                                        </div>
                                        <!-- /.modal-content -->
                                    </div>
                                    </form>
                                    <!-- /.modal-dialog -->
                                </div>
                                <!-- /.modal -->
                                <?php endforeach; ?>

                            </table>
                        <?php endif; ?>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
    <!-- /.content -->


</div>
<!-- /.content-wrapper -->