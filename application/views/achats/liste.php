<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mt-2">Commandes (Achats BTC)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
              </li>
            </ol>
          </div>
          <!-- /. Message de confirmation -->
        
          <?php if ($this->session->flashdata('inscription_delete')):?>
                  <div class="col-6">
                    <div class="alert alert-warning alert-dismissible" role="alert" id="connexion-failed">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?= $this->session->flashdata('inscription_delete');?></strong>
                    </div>
                  </div>
          <?php endif;?>
        </div>  
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <h5 class="mb-2">Boite d'infos</h5>
        <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Nouvelles</span>
                <span class="info-box-number"><?= $news;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Traitées</span>
                <span class="info-box-number"><?= $traitees;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">En cours</span>
                <span class="info-box-number"><?= $encours;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-flag"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Rejetées</span>
                <span class="info-box-number"><?= $rejetees;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-default"><i class="far fa-star"></i></span>
              <div class="info-box-content">
                <span class="info-box-text">Total</span>
                <span class="info-box-number"><?= $total;?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Numéro</th>
                    <th>Noms</th>
                    <th>Email</th>
                    <th>Produit</th>
                    <th>Qte USD</th>
                    <th>Qte BTC-USDT</th>
                    <th>Montant Envoyé</th>
                    <th>Commission</th>
                    <th>Total</th>
                    <th>Téléphone transaction</th>
                    <th>Moyen paiement</th>
                    <th>Etat commande</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($commandes as $row):?>
                    <tr>
                      <td><img src="<?= base_url()?>assets/img/users/<?= $row->photo_abonne?>" class="img-circle img-thumbnail" style="width: 50px; height: 50px"></td>
                      <td><?= $row->numero_commande ?></td>
                      <td><?= ucfirst($row->prenom_abonne).' '.ucfirst($row->nom_abonne)?></td>
                      <td><?= $row->email_abonne?></td>
                      <td><?= $row->codeProduit?></td>
                      <td><?= $row->qte_achete_usd ?></td>
                      <td><?= $row->qte_achete_btc ?></td>
                      <td><?= $row->montant_envoye ?></td>
                      <td><?= $row->frais_commission ?></td>
                      <td><?= $row->total_a_payer ?></td>
                      <td><?= $row->phone_transaction ?></td>
                      <?php if($row->moyen_paiement=='243'):?>
                      <td class="text-danger">Airtel Money</td>
                      <?php else :?>
                          <td class="text-success">M-PESA</td>
                      <?php endif;?>

                      <?php if($row->etat_commande=='en cours'):?>
                      <td class="text-primary"><?= $row->etat_commande?></td>
                      <?php elseif ($row->etat_commande=='traitée') :?>
                          <td class="text-success"><?= $row->etat_commande?></td>
                      <?php else:?> 
                          <td class="text-danger"><?= $row->etat_commande?></td>
                      <?php endif;?>

                      <td><a href="<?= base_url()?>buying/details/<?= $row->numero_commande?>" class="btn btn-sm btn-info">View</a></td>
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Numéro</th>
                    <th>Noms</th>
                    <th>Email</th>
                    <th>Produit</th>
                    <th>Qte USD</th>
                    <th>Qte BTC-USDT</th>
                    <th>Montant Envoyé</th>
                    <th>Commission</th>
                    <th>Total</th>
                    <th>Téléphone transaction</th>
                    <th>Moyen paiement</th>
                    <th>Etat commande</th>
                    <th></th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->