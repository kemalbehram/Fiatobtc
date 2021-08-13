<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mt-2">Primes de fidélité</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
              </li>
            </ol>
          </div>
          <!-- /. Message de confirmation -->
        
          <?php if ($this->session->flashdata('primesent')):?>
                  <div class="col-6">
                    <div class="alert alert-warning alert-dismissible" role="alert" id="connexion-failed">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?= $this->session->flashdata('primesent');?></strong>
                    </div>
                  </div>
          <?php endif;?>
        </div>  
      </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
      <div class="container">
        <!-- /.row -->
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="col-sm-3 mt-2 ml-2">
              <a href="<?=base_url()?>buying/createPrime" class="btn btn-primary">Nouvelle</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Email abonnée</th>
                    <th>Nom abonné</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Motif</th>
                  </tr>
                  </thead>
                  <tbody>
                    
                    <?php foreach ($primes as $row):?>
                    <tr>
                      <td><img src="<?= base_url()?>assets/img/users/<?= $row->photo_abonne?>" class="img-circle img-thumbnail" style="width: 50px; height: 50px"></td>
                     <td><?= $row->email_abonne?></td>
                      <td><?= ucfirst($row->prenom_abonne).' '.ucfirst($row->nom_abonne)?></td>
                      
                      <td>USD <?= $row->montant?></td>
                      <td><?= date('M-d-Y', strtotime($row->created_at_prime)) ?></td>
                      <td><?= $row->motif ?></td>
                     
                   
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>#</th>
                    <th>Email abonnée</th>
                    <th>Nom abonné</th>
                    <th>Montant</th>
                    <th>Date</th>
                    <th>Motif</th>
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