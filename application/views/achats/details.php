<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Détails de la commande d'achat</h1>
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
                  <b>ID Tans:  #<?= $commands['id_transaction'] ?></b><br>
                  <br>
                  <b>Commande ID: </b> <?= $commands['numero_commande'] ?><br>
                  <b>Date commande: </b> <?= $commands['date_commande'] ?><br>
                  <b>Account: </b><?= $commands['adresse_btc_client'] ?>
                </div>
               
                <!-- /.col -->
              </div>
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
                      <td><?=$commands['numero_commande']?></td>
                      <td><?=$commands['qte_achete_usd']?></td>
                      <td><?=$commands['qte_achete_btc']?></td>
                      <td>La commande est <?=$commands['etat_commande']?></td>
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

                <input type="hidden" value="<?=$commands['numero_commande']?>" id="numero_commande" name= "numero_commande">
                <input type="hidden" name="id_abonne" value="<?=$commands['id_abonne']?>" id="id_abonne">
                <input type="hidden" name="key_parain" value="<?=$commands['referal_key_parain']?>" id="key_parain">
                <div class="col-12">
                  <div id="success_message"></div>
                  

                  <?php if($commands['etat_commande'] == 'en cours'):?>
                    <div class="input-group mb-3" id="group-hashcode">
                    <div class="input-group-prepend">
                      <button type="button" class="btn btn-primary" id="btnPasteHash">Coller</button>
                    </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control text-info font-weigth-bold" placeholder="Code Hash" name="code_hash" id="code_hash">
                    </div>

                    <button type="button" class="btn btn-danger float-right mr-2" id="btn_cancel" ><i class="far fa-credit-card"></i>
                      Rejeter
                    </button>
                    <button type="button" class="btn btn-primary float-right" style="margin-right: 5px;" id="btn_validate">
                      <i class="fas fa-check" ></i>Valider
                    </button>
                    <a href="<?=base_url('buying/fetchAll')?>" class="btn btn-success float-right mr-2"><i class="far fa-credit-card"></i>
                      Liste complète
                  </a>
                    <?php elseif($commands['etat_commande'] == 'traitée' || $commands['etat_commande'] == 'rejetée'):?>
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
  