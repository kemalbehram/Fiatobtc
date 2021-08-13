<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Preuve de paiment</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url()?>register/myaccount">Mes achats</a></li>
              <li class="breadcrumb-item active">Preuve</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container">
        <div class="row">
          <div class="col-12">
            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- info row -->
              <div class="row invoice-info">
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  <address>
                    <strong><?= $commands['prenom_abonne'].' '.$commands['nom_abonne'] ?></strong><br>
                    <?= $commands['adresse'] ?><br>
                    <?= $commands['ville_abonne'] ?>, <?= $commands['pays_origine']?><br>
                    Téléphone: <?= $commands['telephone_abonne'] ?><br>
                    Email: <?= $commands['email_abonne'] ?>
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 col-md-8 invoice-col">
                  <b>ID Transaction :  #<?= $commands['id_transaction'] ?></b><br>
                  
                  <b>Numéro commande :  </b> <?= $commands['numero_commande'] ?><br>
                  <b>Date commande:  </b> <?= $commands['date_commande'] ?><br>
                  <b>Produit(Crypto):  </b> <?= $commands['codeProduit'] ?><br>
                  <b>Adresse BTC :</b>   <span class="text-muted"><?= $commands['adresse_btc_client'] ?></span><br><br>
                  
                  <div class="form-group row">
                    <b class="col-sm-1">Hash : </b>
                    <div class="col-sm-8">
                        <input class="form-control text-blue text-underline" type="text"
                       value="<?= $commands['hash_code']?>" id="copyArea" readonly="true">
                    </div>
                    <p class="col-sm-2"><a href="#" class="link-black text-sm" id="btnCopy"><i class="far fa-copy mr-1"></i>
                        Copier</a>
                    </p>      
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Numéro commande</th>
                      <th>Qty USD -USDT</th>
                      <th>Qte BTC</th>
                      <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td><?=$commands['numero_commande']?></td>
                      <td><?=$commands['qte_achete_usd']?></td>
                      <td><?=$commands['qte_achete_btc']?></td>
                      <td class="font-weight-bold text-info">La commande est <?=$commands['etat_commande']?></td>
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
                    <h4 class="text-success">M-PESA</h4>
                  <?php endif;?>
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Le délai de la validité de la commande est de 24 h, après ce délai vous pouvez reclamer ce que nous vous devons en nous écrivant à <a href="mailto:contact@fiatobtc.com">contact@fiatobtc.com</a>
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Détails de la commande</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Sous-total:</th>
                        <td>$<?= number_format($commands['qte_achete_usd'],2,'.','')?></td>
                      </tr>
                      <tr>
                        <?php 
                        if($commands['qte_achete_usd']<=1000 || $commands['qte_achete_usd']==50){
                           $taux=10;
                         }elseif ($commands['qte_achete_usd'] <= 10000 || $commands['qte_achete_usd'] == 1001) {
                           $taux=9.5;
                         }elseif ($commands['qte_achete_usd'] > 10000) {
                           $taux=9;
                         }

                         $commission=$commands['qte_achete_usd'] * $taux / 100;
                        ?>
                        <th>Taux (<?= $taux ?> %)</th>
                        <td>$<?= number_format($commission, 2, '.', '')?> </td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>$ <?=number_format($commission + $commands['qte_achete_usd'],2,'.','')?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">

            
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>