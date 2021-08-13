<?php
$session_data = $this->session->userdata('fiato_logged_in');
    
    if (isset($session_data)) {
        
        $data['id_abonne'] = $session_data['id_abonne'];
   }

//Conversion de CRYPTO EN USD
//$query=20;
//echo file_get_contents("https://blockchain.info/tobtc?currency=USD&value=$query");

?>
<!-- Main content -->
<section class="container-fluid pt-5" style="background-color: #192a56;">
    <div class="card text-center" style="background-color: #192a56;">
        <h3 class="pt-4 font-weight-bold text-light">BIENVENUE SUR FIATOBTC</h3>
        <p class="text-light mt-1">ACHETEZ ET VENDEZ DU BITCOIN</p>
    </div>
</section>

<!-- Small Box (Stat card) -->
<div class="container">
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box text-light" style="background-color: #273c75">
                <div class="inner">
                    <h4>Vente</h4>
                    <p>Vendre du BitCoin contre du Fiat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-code-branch"></i>
                </div>
                <?php if(!isset($data['id_abonne'])):?>
                <a href="#" class="small-box-footer exchangeNonDispo">
                    Commencer <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php else :?>
                    <a href="#" class="small-box-footer exchangeNonDispo">
                    Commencer <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php endif;?>
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <!-- small card -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h4>Achat</h4>
                    <p>Acheter du Bitcoin contre du Fiat</p>
                </div>
                <div class="icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <?php if(!isset($data['id_abonne'])):?>
                <a href="<?=base_url()?>register" class="small-box-footer">
                    Commencer <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php else :?>
                    <a href="<?=base_url()?>buying" class="small-box-footer">
                    Commencer <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php endif;?>
            </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-4 col-12">
            <!-- small card -->
            <div class="small-box bg-primary">
                <div class="inner">
                    <h4>Echange</h4>
                    <p>Echanger les crypto monnaies</p>
                </div>
                <div class="icon">
                    <i class="fas fa-money-bill"></i>
                </div>
                <?php if(!isset($data['id_abonne'])):?>
                <a href="<?=base_url()?>register" class="small-box-footer">
                    Commencer <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php else :?>
                    <a href="<?=base_url()?>exchange/cryptoTofiat" class="small-box-footer">
                    Commencer <i class="fas fa-arrow-circle-right"></i>
                </a>
                <?php endif;?>
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
<!-- Ordre d'echange de crypto-monnaie  !-->
<div class="container mt-0 pt-0">
    <!-- /.row -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold">Ordres d'échange de la crypto-monnaie contre  du fiat</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>Vendeur</th>
                            <th>Méthode de paiement</th>
                            <th>Quantité USD</th>
                            <th>Taux</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($orderscrypto as $row): ?>
                        <tr>
                            <td><?= $row->prenom_abonne. ' '.$row->nom_abonne ?></td>
                            <?php if ($row->moyen_paiement == "244"): ?>
                                <td>MPESA :  05122129 </td>
                            <?php elseif ($row->moyen_paiement == "243"): ?>
                                <td>Airtel Money : 0971359902  </td>
                            <?php endif; ?>
                            <td><span class="tag tag-success"><?= $row->qte?> USD/<?= $row->product?> </span></td>
                            <td><?= $row->taux?> %</td>
                            <td>USD <?= number_format($row->qte + ($row->qte * $row->taux/100),2,',','')?></td>
                            <?php if (isset($data['id_abonne'])): ?>
                            <td><a class="btn-sm btn-secondary" href="<?= base_url()?>exchange/buycrypto/<?= $row->id_exchange?>" title="Cliquer pour Acheter">Acheter</a></td>
                            <?php else: ?>
                            <td><a class="btn-sm btn-secondary" href="<?= base_url()?>pages/connexion" title="Connectez-vous pour Acheter">Acheter</a></td>

                            <?php endif ?>
                        </tr>
                        <?php endforeach;?>

                        <?php foreach ($ordersfiat as $row): ?>
                            
                        <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title text-bold">Ordres d'échange de fiat contre la crypto-monnaie  </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0" style="height: 200px;">
                    <table class="table table-head-fixed text-nowrap">
                        <thead>
                        <tr>
                            <th>Vendeur</th>
                            <th>Méthode de paiement</th>
                            <th>Quantité USD</th>
                            <th>Taux</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($ordersfiat as $row): ?>
                        <tr>
                            <td><?= $row->prenom_abonne. ' '.$row->nom_abonne ?></td>
                            <?php if ($row->moyen_paiement == "244"): ?>
                                <td>MPESA :  05122129 </td>
                            <?php elseif ($row->moyen_paiement == "243"): ?>
                                <td>Airtel Money : 0971359902  </td>
                            <?php endif; ?>
                            <td><span class="tag tag-success"><?= $row->qte?> USD/<?= $row->product?> </span></td>
                            <td><?= $row->taux?> %</td>
                            <td>USD <?= number_format($row->qte + ($row->qte * $row->taux/100),2,',','')?></td>
                            <?php if (isset($data['id_abonne'])): ?>
                            <td><a class="btn-sm btn-secondary" href="<?= base_url()?>exchange/buyfiat/<?= $row->id_exchange?>" title="Cliquer pour Acheter">Acheter</a></td>
                            <?php else: ?>
                            <td><a class="btn-sm btn-secondary" href="<?= base_url()?>pages/connexion" title="Connectez-vous pour Acheter">Acheter</a></td>

                            <?php endif ?>
                        </tr>
                        <?php endforeach;?>
                        </tbody>
                    </table>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
    </div>
    <!-- /.row -->
</div>
<!--End Ordre d'echange de crypto-monnaie  !-->


<!-- Cryptocurrency Price Widget  !-->
<div class="container mt-0 pt-0 mb-5">
    <script type="text/javascript" src="https://files.coinmarketcap.com/static/widget/coinPriceBlock.js"></script><div id="coinmarketcap-widget-coin-price-block" coins="1,3408,4687,5068,4779,1027,52,1831,2" currency="USD" theme="light" transparent="false" show-symbol-logo="true"></div>
</div>
<!-- End Cryptocurrency Price Widget -->

<!-- Content Wrapper. Contains page content -->
<div class="container">
    <div class="row ">
        <div class="col-lg-6">
            <div class="card elevation-2">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold mb-3">Qu'est-ce que FIATOBTC ?</h5>
                    <p class="card-text">
                        FiatToBtc est une plateforme de vente et achat des cryptoactifs (principalement le Bitcoin).
                    </p>
                    <div class="card-img">
                        <img src="<?= base_url()?>assets/img/core/3090250_S.jpg" alt="FiaToBTC" class="img-thumbnail">
                    </div>
                    <p class="card-text">
                        Vu la difficulté d'accès à des plateformes du trading des cryptomonnaies en Afrique, nous avons conçu cette plateforme pour permettre à tous les congolais de pouvoir s’en procurer avec les moyens de paiement locaux accessibles par tous.
                    </p>
                    <?php if(!isset($data['id_abonne'])):?>
                    <a href="<?= base_url()?>register" class="card-link">Commencer</a>
                    <?php else :?>
                        <a href="#" class="card-link">Commencer</a>
                    <?php endif;?>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold mb-3">Acheter, Vendre Et Échanger </h5>
                    <div class="card-img">
                        <img src="<?= base_url()?>assets/img/core/3660218_S.jpg" alt="FiaToBTC" class="img-thumbnail">
                    </div>
                    <p class="card-text">
                        Tradez ici vos bitcoin, vos ether ou vos USDT ou que vous soyez et à n'importe quel
                        moment ...
                    </p>
                    <a href="#" class="card-link btn exchangeNonDispo" style="background-color:#273c75; color: white">Commencer</a>
                    <a href="<?= base_url()?>register" class="card-link">Inscrivez-vous</a>
                </div>
            </div><!-- /.card -->
        </div>
        <!-- /.col-md-6 -->
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-primary card-outline">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold mb-3">Qu'est-ce que la cryptomonnaie ? </h5>
                    <div class="card-img">
                        <img src="<?= base_url()?>assets/img/core/3215526_S.jpg" alt="FiaToBTC" class="img-thumbnail">
                    </div>
                    <p class="card-text">
                        Une cryptomonnaie, dite aussi cryptoactif, cryptodevise, monnaie cryptographique ou encore cybermonnaie, est une monnaie émise de pair à pair, sans nécessité de banque centrale, utilisable au moyen d'un réseau informatique décentralisé
                    </p>
                    <a href="<?= base_url()?>buying" class="card-link btn" style="background-color:#273c75; color: white">Commencer</a>
                    <a href="<?= base_url()?>register" class="card-link">Inscription</a>
                </div>
            </div><!-- /.card -->
        </div>
        <div class="col-lg-6">
            <div class="card elevation-2">
                <div class="card-body">
                    <h5 class="card-title font-weight-bold mb-3">Comment ça marche ?</h5>
                    <div class="card-img">
                        <img src="<?= base_url()?>assets/img/core/3990806_S.jpg" alt="FiaToBTC" class="img-thumbnail">
                    </div>
                    <p class="card-text">
                        Pour acheter, vendre et/ou échanger des cryptoactifs sur notre plateforme vous devez au préalable être inscrit puis être connecté.
                        Un système de parrainage et de bonus est prévu pour encourager à nos utilisateurs de trader ici.
                    </p>
                    <a href="<?= base_url()?>register" class="card-link">Inscription</a>
                    <a href="<?= base_url()?>buying" class="card-link btn" style="background-color:#273c75; color: white">Commencer</a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div><!-- /.container -->
<!-- /.content-wrapper -->

