<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mt-2">Abonnés (Inscriptions)</h1>
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
        <h5 class="mb-2">Bointe d'infos</h5>
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
              <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Confirmées</span>
                <span class="info-box-number"><?= $confirmes;?></span>
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
                <span class="info-box-text">Non confirmés</span>
                <span class="info-box-number"><?= $nonconfirm;?></span>
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
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Date inscription</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Etat du compte</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php $id=1;?>
                    <?php foreach ($subscribes as $row):?>
                    <tr>
                      <td><?= $id++;?></td>
                      <td><?= $row->date_envoi ?></td>
                      <td><?= ucfirst($row->prenom_abonne)?></td>
                      <td><?= ucfirst($row->nom_abonne)?></td>
                      <td><?= $row->email_abonne ?></td>
                      <td><?= $row->telephone_abonne ?></td>
                      <?php if($row->statut_abonne=='online'):?>
                      <td class="text-success">Confirmé</td>
                      <?php else :?>
                          <td class="text-warning">Non confirmé</td>
                      <?php endif;?>
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Date inscription</th>
                    <th>Prénom</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Etat du compte</th>
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