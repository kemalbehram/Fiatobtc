<!-- Main content -->
<section class="container-fluid pt-5" style="background-color: #192a56;">
    <div class="card text-center" style="background-color: #192a56;">
        <h3 class="pt-4 font-weight-bold text-light">FIATOBTC</h3>
        <p class="text-light mt-1">ACHETER DU BITCOIN</p>
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
               
                </div>
                <div class="card card-widget widget-user-2 mt-2">
              <!-- Add the bg color to the header using any of the bg-* classes -->
              <div class="widget-user-header bg-default">
              
                <!-- /.widget-user-image -->
                <h3 class="widget-user-desc">Taux d'achat BTC</h3>
                <h5 class="widget-user-desc">(Fixaxion actuel)</h5>
              </div>
              <div class="card-footer p-0">
                <ul class="nav flex-column">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      De 50 à 1000 $ <span class="float-right badge bg-primary"> 10 %</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      De 1001 à 10.000 $ <span class="float-right badge bg-info">9.5 %</span>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      + 10.000 <span class="float-right badge bg-success">9 %</span>
                    </a>
                  </li>
                  
                </ul>
              </div>
            </div>

                </div>
              </div>
              <!-- /.card-body -->
            </div>

          <div class="col-md-6">
            
            <!-- Input -->
            <div class="card">
              <div class="card-header fiatobtc-theme-main">
                <h3 class="card-title">Votre Commande</h3>
              </div>
               <form action="<?= base_url()?>buying/createCommand" method="post" id="buying_form">
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-12 col-md-12">
                      <span id="produit_error" class="text-danger text-sm font-italic"></span>
                      <div class="form-group mb-3">
                        <label>Produit (Crypto)</label>
                        <select class="form-control select2" id="select-product" style="width: 100%;" name="product" required>
                          <option disabled>Séléctionner Crypto</option>
                          <option value="BTC" selected>BTC</option>
                          <option value="USDT.ERC20">USDT(ERC20)</option>
                        </select>
                  </div>
                   </div>
                  <div class="col-md-5 col-sm-12">
                  <!-- Frais de commission -->
                   <span id="qte_usd_error" class="text-danger text-sm font-italic"></span> 
                    <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                        Quantité
                      </span>
                    </div>
                    <input type="text" class="form-control text-center" name="qte_usd" id="usd_qte">
                    <div class="input-group-append">
                      <div class="input-group-text">USD</div>
                    </div>
                    </div>
                  <span id="frais_commission_error" class="text-danger text-sm font-italic"></span>
                  </div>

                  <div class="col-md-7 col-sm-12">
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="qte_btc" id="btc_qte" readonly="true">
                      <div class="input-group-append">
                          <span class="input-group-text fiatobtc-second-theme">BTC-USDT</span>
                      </div>
                     
                    </div>
                  </div>
                  </div>
                  <span class="text-danger text-sm font-italic" id="msg-quantity"></span>

                  <!-- Frais de commission -->
                  <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">
                      Frais commision
                    </span>
                  </div>
                  <input type="text" class="form-control text-center" name="frais_commission" id="frais_commission" readonly="true"> 
                  <div class="input-group-append">
                    <div class="input-group-text fiatobtc-second-theme">USD</div>
                  </div>
                  </div>

                  <!-- Total à payer -->
                  <span id="total_a_payer_error" class="text-danger text-sm font-italic"></span>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <span class="input-group-text">Total à payer</span>
                    </div>
                    <input type="text" class="form-control text-center" name="total_a_payer" id="total_a_payer" readonly="true">
                    <div class="input-group-append">
                      <span class="input-group-text fiatobtc-second-theme">USD</span>
                    </div>
                  </div>

                  <!-- Adresse BTC -->
                  <span id="adresse_btc_error" class="text-danger text-sm font-italic"></span>
                  <div class="input-group mb-3">
                    <div class="input-group-prepend">
                      <button type="button" class="btn fiatobtc-theme-main" id="btnPaste">Coller</button>
                    </div>
                  
                    <input type="text" class="form-control" placeholder="Votre adresse BTC ou USDT.ERC20" name="adresse_btc" id="pastArea">
                  </div>

                  <!-- Moyen de paiement -->
                  <span id="moyen_paiement_error" class="text-danger text-sm font-italic"></span>
                  <div class="form-group mb-3">
                    <label>Moyen de payement</label>
                    <select class="form-control select2" id="select-payment-mode" style="width: 100%;" name="moyen_paiement">
                      <option selected="selected" disabled="true">Séléctionner</option>
                      <option value="244">MPESA</option>
                      <option value="243">Airtel Money</option>
                    </select>
                  </div>


                  <div class="form-group mb-3" id="sendPhoneNumber">
                    <label class="text-danger">Acheter via Airtel Money au :</label>
                    <div class="row p-2">
                      <input type="text" class="form-control col-sm-5" value="0971359902" readonly="true"> <span class="col-sm-2 text-center font-weight-bold"> - </span>
                      <input type="text" class="form-control col-sm-5" value="Chrispin Tshibanda" readonly="true">
                    </div>
                  </div>
                  <div class="form-group mb-3" id="sendPhoneNumber2">
                    <label class="text-success">Acheter via Vodacom MPESA au :</label>
                    <div class="row p-2">
                      <input type="text" class="form-control col-sm-5" value="05122129" readonly="true"> <span class="col-sm-2 text-center font-weight-bold"> - </span>
                      <input type="text" class="form-control col-sm-5" value="KANANE SHUKURU" readonly="true">
                    </div>
                  </div>

                  <!-- Phone transaction-->
                  <div class="form-group mb-3" id="phone_transaction">
                    <label>Numéro de téléphone utilisé pour la transaction</label>
                    <div class="input-group mb-3">
                      <input type="text" class="form-control" name="phone_transaction" required>
                    </div>
                  </div>

                  <div class="input-group mb-3" id="montant_transfere">
                    <div class="input-group-prepend">
                      <span class="input-group-text">
                       Montant envoyé
                      </span>
                    </div>
                    <input type="text" class="form-control text-center" name="montant_envoye" required> 
                    <div class="input-group-append">
                      <div class="input-group-text fiatobtc-second-theme">USD</div>
                    </div>
                  </div>

                  <!-- ID Transaction -->
                  <span id="id_transaction_error" class="text-danger text-sm font-italic"></span>
                  <div class="input-group mb-3" id="input-transaction-id">
                    <div class="input-group-prepend">
                      <button type="button" class="btn fiatobtc-theme-main" id="btnPasteIdtransaction">Coller</button>
                    </div>
                    <!-- /btn-group -->
                    <input type="text" class="form-control" placeholder="Coller l'ID de la transaction" name="id_transaction" id="pasteIdtransaction">
                  </div>

                

                  <a href="#" id="readmore" data-toggle="modal" data-target="#modal-lg">En savoir plus sur l'Identifiant de la transaction</a>
                <!-- /input-group -->
              </div><!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary" id="btnSaveCMD">Soumettre</button>
              </div>
              <div id="success_message">
                
              </div>
              
              </form>
            </div>
          </div>
        
          <!--/.col (right) -->
        </div>
        <!-- /.row -->

        <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Guide sur Trans ID</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            
            <div class="modal-body">
              <p>
                L'Identifiant d'une Transaction est un numéro unique octroyé par l'opérateur de télécommunication dans un SMS après avoir effectué une transaction via Mobile Money. 
              </p>
              <p>Il s'agit d'un numéro semblable à ceci : <strong>ID:MP201222.1055.D42399</strong>.
               </p>
               <p>Après avoir effectué votre transaction à l'un des nos numéros de téléphone qui sont indiqués, un SMS vous sera envoyé et vous allez copier l'ID de transaction dans le champ qui vous est indiqué pour finaliser votre commande.</p>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="btn" class="btn btn-warning"  data-dismiss="modal">Fermer</button> 
            </div>
          </div>
          <!-- /.modal-content -->
          </div>
        
        <!-- /.modal-dialog -->
      </div>

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>