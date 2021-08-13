<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mt-2">Bonus (Achats BTC)</h1>
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
                <span class="info-box-text">Réglés</span>
                <span class="info-box-number"><?= $regles;?></span>
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
                <span class="info-box-text">Non réglés</span>
                <span class="info-box-number"><?= $nonregles;?></span>
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
              <div id="success_message"></div>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Commande</th>
                    <th>Bénéficiaire</th>
                    <th>Déclancheur</th>
                    <th>Qte USD</th>
                    <th>Bonus (0.7%)</th>
                    <th>Statut bonus</th>
                    <th>Reclamation</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($bonus as $row):?>
                    <tr>
                      <td><span class="far fa-star"></span></td>
                      <td><?= $row->numero_commande ?></td>
                      <td><?= $row->referal_key_parain?></td>
                      <td><?= ucfirst($row->prenom_abonne).' '.ucfirst($row->nom_abonne)?></td>
                      
                      <td><?= $row->qte_achete_usd ?></td>
                      <td><?= $row->bonus ?></td>
                    
                      <?php if($row->statut_bonus=='réglé'):?>
                      <td class="text-success"><?= ucfirst($row->statut_bonus)?></td>
                      <?php else :?>
                          <td class="text-danger"><?= ucfirst($row->statut_bonus)?></td>
                      <?php endif;?>

                      <?php if($row->statut_reclamation=='oui'):?>
                       <td><button type="button" class="btn btn-sm btn-danger btn_regler_bonus" data-idbonus="<?= $row->id_bonus ?>">Régler(bonus reclamé)</button></td>
                      <?php elseif ($row->statut_reclamation=='non') :?>
                          <td><button type="button" class="btn btn-sm btn-info btn_regler_bonus" data-idbonus="<?= $row->id_bonus ?>">Régler</button></td>
                      <?php else:?> 
                          <td class="text-success">Bonus réglé</td>
                      <?php endif;?>
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                   <tr>
                    <th>#</th>
                    <th>Commande</th>
                    <th>Bénéficiaire</th>
                    <th>Déclancheur</th>
                    <th>Qte USD</th>
                    <th>Bonus (0.7%)</th>
                    <th>Statut bonus</th>
                    <th>Reclamation</th>
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