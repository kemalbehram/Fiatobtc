<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mt-2">Commandes (Ventes BTC)</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
              </li>
            </ol>
          </div>
          
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
              <span class="info-box-icon bg-danger"><i class="far fa-star"></i></span>
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
                <table id="example1" class="table table-striped table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Numéro</th>
                    <th>Noms</th>
                    <th>Email</th>
                    <th>Produit</th>
                    <th>Montant USD</th>
                    <th>Montant BTC</th>
                    <th>Moyen paiement choisi</th>
                    <th>Numéro téléphone</th>
                    <th>Status</th>
                    <th></th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($commandes as $row):?>
                    <tr>
                      <td>
                        <img src="<?= base_url()?>assets/img/users/<?= $row->photo_abonne ?>" class="img-circle img-thumbnail" style="width: 50px; height: 50px">
                      </td>

                      <td><?= $row->id_paiement ?></td>
                      <td><?= ucfirst($row->prenom_abonne).' '.ucfirst($row->nom_abonne)?></td>
                      <td><?= $row->email_abonne?></td>
                      <td><?= $row->to_currency?></td>
                      <td><?= $row->entered_amount ?></td>
                      <td><?= $row->amount ?></td>
                      <td><?= $row->transaction_moyen ?></td>
                      <td><?= $row->phone_transaction ?></td>
                      <?php if($row->status=='initialized'):?>
                      <td class="text-primary"><?= $row->status?></td>?> 
                       <?php elseif($row->status=='error') :?>
                       	<td class="text-danger"><?= $row->status?></td>
                      <?php elseif($row->status=='success') :?>
                        <td class="text-success"><?= $row->status?></td>
                      <?php endif;?>
                      
                      <td><a href="<?= site_url('sales/details/'.$row->id_paiement)?>" class="btn btn-sm btn-info">View</a></td>
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
                    <th>Montant USD</th>
                    <th>Montant BTC</th>
                    <th>Moyen paiement choisi</th>
                    <th>Numéro téléphone</th>
                    <th>Status</th>
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