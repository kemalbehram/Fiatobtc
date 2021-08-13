
<!-- Main content -->
<section class="container-fluid pt-5" style="background-color: #192a56;">
    <div class="card text-center" style="background-color: #192a56;">
        <h3 class="pt-4 font-weight-bold text-light">FIATOBTC</h3>
        <p class="text-light mt-1">VENDRE DU BITCOIN</p>
    </div>
</section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
           <div class="card card-warning">
              <div class="card-header">
                <h3 class="card-title">Calculateur (Convertisseur)</h3>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col col-5">
                    <div class="input-group">
                    <input type="number step='9'" class="form-control text-center" name="buying_price" id="buying_price">
                    <div class="input-group-append">
                      <div class="input-group-text">USD</div>
                    </div>
                    </div>
                  </div>
                  
                  <div class="col col-7">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control text-center" id="buying_result" readonly="true">
                      <div class="input-group-append">
                          <span class="input-group-text">BTC</span>
                      </div>
                    </div>
                  </div>
                  <div class="col col-12">
                    <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Taux de vente
                      </span>
                    </div>
                    <input type="text" class="form-control text-center" readonly="true" value="5.5 ">
                    <div class="input-group-append">
                      <div class="input-group-text"> %</div>
                    </div>
                    </div>
                  </div>
                </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          <div class="col-md-6">
            
            <!-- Input addon -->
            <div class="card">
              <div class="card-header fiatobtc-theme-main">
                <h3 class="card-title">Votre ordre de vente</h3>
              </div>
              <form action="<?=base_url('sales/process')?>" method="post" autocomplete="off">
              <div class="card-body">
                <div class="row">
                   <div class="col-sm-12 col-md-12">
                      <div class="form-group mb-3">
                        <label>Produit (Crypto)</label>
                        <select class="form-control select2" style="width: 100%;" name="product" required>
                          <option disabled="true">Séléctionner Crypto</option>
                          <option value="BTC" selected="selected">BTC</option>
                        </select>
                     </div>
                   </div>
                <div class="col-md-5 col-sm-12">
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Quantité
                      </span>
                    </div>
                    <input type="text" class="form-control text-center" id="sales_qte_usd" name="sales_qte_usd" required>
                    <div class="input-group-append">
                      <div class="input-group-text">USD</div>
                    </div>
                    </div>
                  </div>

                  <div class="col-md-7 col-sm-12">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control text-center" name="sales_qte_btc" id="sales_qte_btc" readonly="true">
                      <div class="input-group-append">
                          <span class="input-group-text">BTC</span>
                      </div>
                    </div>
                  </div>
                  </div>
                  <span class="text-danger text-sm font-italic" id="msg-quantity"></span>
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Intérêt
                    </span>
                  </div>
                  <input type="text" class="form-control text-center" name="frais_commission_vente" id="frais_commission_vente" readonly="true">
                  <div class="input-group-append">
                    <div class="input-group-text fiatobtc-second-theme">USD</div>
                  </div>
                  </div>

                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Total à payer</span>
                    </div>
                    <input type="text" class="form-control text-center" name="amount" id="total_vente" readonly="true" required="">
                    <div class="input-group-append">
                      <span class="input-group-text fiatobtc-second-theme">USD</span>
                    </div>
                  </div>
                  <div class="form-group">
                    <p class="font-weight-bold mt-1">Souhaitez-vous qu'on vous paye par : </p>
                        <div class="custom-control custom-radio mb-2">
                          <input class="custom-control-input" type="radio" id="customRadio2" name="customRadio" value="Airtel-money" checked>
                          <label for="customRadio2" class="custom-control-label text-danger">Airtel Money</label>
                        </div>
                        <div class="custom-control custom-radio mb-2">
                          <input class="custom-control-input" type="radio" id="customRadio1" name="customRadio" value="MPESA">
                          <label for="customRadio1" class="custom-control-label text-success ">MPESA</label>
                        </div>
                        
                        <input type="text" placeholder="Votre numéro de téléphone (Ex :+243990008005)" class="form-control" name="phone" required>
                  </div>
                  
                    <input type="hidden" name="email" value="<?= $email ?>">
                    <button type="submit" class="btn btn-block fiatobtc-theme-main">Payer à <?= $marchantname ?></button>
                  
                <!-- /input-group -->
                </form>
              <div class="card-footer">
                <?php if ($this->session->flashdata('erreur')):?>
                  <div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <strong><?= $this->session->flashdata('erreur');?></strong>
                  </div>
                <?php endif;?>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>