<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Détails de la commande de vente</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url()?>">Accueil</a></li>
              <li class="breadcrumb-item active">Commande</li>
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
                    <small class="float-right">Date: <?= date('Y-m-d')?></small>
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
                    Téléphone: (243) 999-000-000<br>
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
                  <b>ID Passerelle:  #<?= $commands['gateway_id'] ?></b><br>
                  <br>
                  <b>Commande ID: </b> <?= $commands['id_paiement'] ?><br>
                  <b>Date commande: </b> <?= $commands['created_at'] ?><br>
                  <b>URL Passerelle: </b><?= substr($commands['gateway_url'],0,28) ?>...
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
                      <th>Qty USD</th>
                      <th>Qte BTC</th>
                      <th>Description</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                      <td><?=$commands['id_paiement']?></td>
                      <td><?=$commands['entered_amount']?></td>
                      <td><?=$commands['amount']?></td>
                      <td class="text-info">La commande est en état : <?=$commands['status']?></td>
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
                 
                    <h4 class="text-primary">CoinPaiment API</h4>
                 
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px;">
                    Le délai de la validité de la commande est de 48h, après ce délai vous pouvez reclamer ce que nous devons.
                  </p>
                </div>
                <!-- /.col -->
                <div class="col-6">
                  <p class="lead">Détails de la commande</p>

                  <div class="table-responsive">
                    <table class="table">
                      <tr>
                        <th style="width:50%">Sous-total:</th>
                        <td>$<?= number_format($commands['entered_amount'],2,'.','')?></td>
                      </tr>
                      <tr>
                      
                        <th>Taux 5.5 %)</th>
                        <td>$<?= number_format($commands['entered_amount'], 2, '.', '')?> </td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>$ <?=number_format($commands['entered_amount'],2,'.','')?></td>
                      </tr>
                    </table>
                  </div>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">

                <input type="hidden" value="<?=$commands['id_paiement']?>" id="id_paiement" name= "id_paiement">
                <div class="col-12">
                  <div id="success_message_sales"></div>
                  <a href="#" onclick="return window.print();" class="btn btn-default"><i class="fas fa-print"></i> Imprimer</a>

                  <?php if($commands['status'] == 'initialized'):?>

                    <button type="button" class="btn btn-danger float-right mr-2" id="btn_cancel_sales" ><i class="far fa-credit-card"></i>
                      Rejeter
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" id="btn_validate_sales">
                      <i class="fas fa-check" ></i>Valider
                    </button>
                    <a href="<?=base_url('sales/fetchAll')?>" class="btn btn-success float-right mr-2"><i class="far fa-credit-card"></i>
                      Liste complète
                  </a>
                    <?php elseif($commands['status'] == 'success' || $commands['status'] == 'error'):?>
                    <a href="<?=base_url('buying/fetchAll')?>" class="btn btn-success float-right"><i class="far fa-credit-card"></i> 
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