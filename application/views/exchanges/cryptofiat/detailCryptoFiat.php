<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container mt-5">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Détails de la demande d'echange</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url()?>">Accueil</a></li>
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
                    <div class="callout callout-info">
                        <h5><i class="fas fa-info"></i> Note:</h5>
                        Cette page peut aussi être imprimée.
                    </div>


                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>
                                    <i class="fas fa-globe"></i> FiaToBTC, Sarl.
                                    <small class="float-right">Date: <?= date('d M Y') ?></small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                A
                                <address>
                                    <strong>FiaToBTC, Sarl.</strong><br>
                                    795 Frangipaniers , Kampemba<br>
                                    Lumbumbaashi, RDC<br>
                                    Téléphone: (243) 97 56 55 201<br>
                                    Email: contact@fiatobtc.com
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                De
                                <address>
                                    <strong><?= $commands['prenom_abonne'].' '.$commands['nom_abonne'] ?></strong><br>
                                    <?= $commands['adresse'] ?><br>
                                    <?= $commands['ville_abonne'] ?>, <?= $commands['pays_origine']?><br>
                                    Téléphone: <?= $commands['telephone_abonne'] ?><br>
                                    Email: <?= $commands['email_abonne'] ?>
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <br>
                                <b>Demande ID: </b> <?= $commands['id_exchange'] ?><br>
                                <b>Date demande: </b> <?= date('d M Y', strtotime($commands['date_envoi'])) ?><br>
                            </div>

                            <!-- /.col -->
                        </div>
                        <div class="form-group row">
                            <b class="col-sm-1">Hash : </b>
                            <div class="col-sm-8">
                                <input class="form-control text-blue text-underline" type="text"
                                       value="<?= $commands['hash']?>" id="copyArea" readonly="true">
                            </div>
                            <p class="col-sm-2"><a href="#" class="link-black text-sm" id="btnCopy"><i class="far fa-copy mr-1"></i>
                                    Copier</a>
                            </p>
                            <b class="ml-2">Crypto Adresse :</b> <span class="text-info"> <?= wordwrap($commands['cryptoAdresse'],10) ?></span> <br>
                        </div>
                        <!-- /.row -->

                        <!-- Table row -->
                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th>Numéro commande</th>
                                        <th>Produit</th>
                                        <th>Quantité</th>
                                        <th>Taux</th>
                                        <th>Statut</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><?=$commands['id_exchange']?></td>
                                        <td><?=$commands['product']?></td>
                                        <td><?=$commands['qte']?></td>
                                        <td><?=$commands['taux']?> %</td>

                                        <?php if ($commands['statut_demande']=='process'): ?>
                                        <td class="text-warning">En cours</td>
                                        <?php elseif ($commands['statut_demande']=='cancel'):?>
                                        <td class="text-danger">Réjetée</td>
                                        <?php elseif ($commands['statut_demande']=='confirm'):?>
                                        <td class="text-success">Acceptée</td>
                                        <?php endif;?>

                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->
                            <div class="col-6">
                                <p class="lead">Moyen de paiement :</p>
                                <?php if($commands['moyen_paiement']==243):?>
                                    <h4 class="text-danger">Airtel Money</h4>
                                <?php else :?>
                                    <h4 class="text-danger">M-PSA</h4>
                                <?php endif;?>
                                <h5 class="text-bold text-muted"><?= $commands['telephone']?></h5>
                                <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                                    Le délai du tratement de la demande est de 48h, après quoi vous pouvez reclamer vos droits.
                                </p>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <!-- this row will not appear when printing -->
                        <div class="row no-print">
                            <input type="hidden" value="<?=$commands['id_exchange']?>" id="id_exchangeCryptoFiat" name= "id_exchangeCryptoFiat">
                            <input type="hidden" value="<?= $commands['prenom_abonne'] ?>" id="prenomAbonne" name= "prenomAbonne">
                            <input type="hidden" value="<?= $commands['email_abonne']?>" id="emailAbonne" name= "emailAbonne">
                            <div class="col-12">

                                <div id="success_messageCryptoFiat"></div>

                                <?php if($commands['statut_demande'] == 'process'):?>
                                    <button type="button" class="btn btn-danger float-right mr-2" id="btn_cancel__exchange_crypto"><i class="far fa-credit-card"></i>
                                        Rejeter
                                    </button>
                                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" id="btn_validate_exchange_crypto">
                                        <i class="fas fa-check" ></i>Accepter
                                    </button>

                                    <a href="<?=base_url('exchange/fetchCryptoFiat')?>" class="btn btn-success float-right mr-2"><i class="far fa-credit-card"></i>
                                        Liste complète
                                    </a>
                                <?php elseif($commands['statut_demande'] == 'confirm' || $commands['statut_demande'] == 'cancel'):?>
                                    <a href="<?=base_url('exchange/fetchCryptoFiat')?>" class="btn btn-success float-right"><i class="far fa-credit-card"></i>
                                        Liste complète
                                    </a>
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
