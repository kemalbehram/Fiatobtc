<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper mt-5">
    <!-- Content Header (Page header) -->
    <section class="content-header pt-5">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Echange de Fiat VS Crypto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url() ?>" title="Page d'accueil">Accueil</a></li>
                        <li class="breadcrumb-item active">Cryptos contre Fiat</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <?php if ($this->session->flashdata('demande_sent')): ?>
                    <div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?php echo $this->session->flashdata('demande_sent'); ?></strong>
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
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">A lire avant de vous lancer</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputDescription">Avis à tous nos abonnés</label>
                            <textarea id="inputDescription" disabled class="form-control" rows="4">Raw denim you probably haven't heard of them jean shorts Austin. Nesciunt tofu stumptown aliqua butcher retro keffiyeh dreamcatcher synth. Cosby sweater eu banh mi, qui irure terr.</textarea>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <div class="row">
                    <?php if ($soldes != ''): ?>
                        <?php foreach ($soldes as $solde): ?>
                            <div class="col-md-6 col-sm-6 col-6">
                                <div class="info-box">
                                    <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?= $solde->product ?></span>
                                        <span class="info-box-number"><?= $solde->quantite_depose ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="form-group">

                                        <textarea id="inputDescription" disabled class="form-control text-danger text-bold" rows="2">Votre solde est insuffisant pour effectuer les opérations d'echange, Veuillez recharger votre solde.</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>
                    <div class="col-md-12 col-sm-12 col-12">
                        <button type="button" class="btn btn-primary mt-2 mb-2" data-toggle="modal"
                                data-target="#modal-add-solde">
                            Recharger mon solde
                        </button>
                    </div>
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Placer un ordre</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip"
                                    title="Collapse">
                                <i class="fas fa-minus"></i></button>
                        </div>
                    </div>

                    <div class="card-body">
                        <form action="<?= base_url() ?>exchange/postViewFiatCrypto" method="post">
                            <div class="form-group">
                                <label for="inputSpentBudget">Quantité à vendre USD</label>
                                <input type="number" class="form-control" step="any" name="qte"
                                       value="<?= $data["qte"] ?>" min="20" required>
                            </div>

                            <div class="form-group">
                                <label for="inputEstimatedDuration">Taux en %</label>
                                <input type="number" class="form-control" value="<?= $data["taux"] ?>" step="any"
                                       name="taux" max="10" min="3" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                 <label>Moyen de payement</label>
                                <select class="form-control select2" id="select-payment-mode" style="width: 100%;" name="moyen_paiement" required>
                                  <option selected="selected" disabled>Séléctionner</option>
                                  <option value="244">MPESA</option>
                                  <option value="243">Airtel Money</option>
                                </select>
                            </div>


                          <div class="form-group mb-3" id="sendPhoneNumber">
                            <label class="text-danger">Airtel Money</label>
                            <div class="row p-2">
                              <input type="text" class="form-control col-sm-5" value="0971359902" readonly="true"> <span class="col-sm-2 text-center font-weight-bold"> - </span>
                              <input type="text" class="form-control col-sm-5" value="Chrispin Tshibanda" readonly="true">
                            </div>
                         </div>
                        <div class="form-group mb-3" id="sendPhoneNumber2">
                              <label class="text-success">Vodacom MPESA</label>
                                <div class="row p-2">
                          <input type="text" class="form-control col-sm-5" value="05122129" readonly="true"> <span class="col-sm-2 text-center font-weight-bold"> - </span>
                          <input type="text" class="form-control col-sm-5" value="KANANE SHUKURU" readonly="true">
                        </div>
                      </div>

                        <div class="form-group">
                            <label for="inputEstimatedBudget">ID de Transaction</label>
                            <div class="row ml-1 mr-1">
                                <input type="text" class="form-control mb-1 text-info"
                                       placeholder="Votre ID de Transaction" name="id_transaction"
                                       value="<?= $data["id_transaction"] ?>" required>
                            </div>
                        </div>
                        <div class="form-group">
                                <label>Produit (Crypto)</label>
                                <select class="form-control select2" id="select-product" style="width: 100%;"
                                        name="product"
                                        required>
                                    <option value="<?= $data["product"] ?>" selected><?= $data["product"] ?></option>
                                    <option disabled>Séléctionner Crypto</option>
                                    <option value="BTC">BTC</option>
                                    <option value="USDT.ERC20">USDT(ERC20)</option>
                                </select>
                        </div>
                            <div class="row">
                                <div class="col-12">
                                    <a onclick="return confirm('Etes-vous sûr d\'annuler votre ordre de vente ?')"
                                       href="<?= base_url() ?>exchange/fiatTocrypto" title="Annuler"
                                       class="btn btn-secondary">Annuler</a>
                                    <input type="submit" value="Suivant" class="btn btn-success float-right">
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->

    <!-- /.modal -->
    <div class="modal fade" id="modal-add-solde">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Créditer votre Solde</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url() ?>exchange/createsoldeCryptoFiat" method="post">
                    <div class="modal-body">
                        <div class="card card-info">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Produit (Crypto)</label>
                                    <select class="form-control select2" id="select-product" style="width: 100%;"
                                            name="product"
                                            required>
                                        <option disabled>Séléctionner Crypto</option>
                                        <option value="BTC">BTC</option>
                                        <option value="USDT.ERC20">USDT(ERC20)</option>
                                    </select>
                                </div>

                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Votre adresse crypto</span>
                                    </div>
                                    <input type="text" class="form-control" name="cryptoAdresse" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Votre hash</span>
                                    </div>
                                    <input type="text" class="form-control" name="hash" required>
                                </div>
                                <div class="input-group mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Quantité</span>
                                    </div>
                                    <input type="number" class="form-control" name="quantite_depose" min="0" step="any"
                                           required>
                                </div>

                            </div>
                            <!-- /.card-body -->
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
            </div>
            <!-- /.modal-content -->
        </div>
        </form>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->

</div>
<!-- /.content-wrapper -->