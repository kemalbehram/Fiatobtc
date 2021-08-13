<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container  mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="mt-2">Produits</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#modal-lg">
                  Nouveau Produit
                </button>
                </li>
            </ol>
          </div>
          <!-- /. Message de confirmation -->
          <?php if ($this->session->flashdata('product_created')):?>
                  <div class="col-6">
                    <div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?= $this->session->flashdata('product_created');?></strong>
                    </div>
                  </div>
          <?php endif;?>
          <?php if ($this->session->flashdata('product_delete')):?>
                  <div class="col-6">
                    <div class="alert alert-warning alert-dismissible" role="alert" id="connexion-failed">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <strong><?= $this->session->flashdata('product_delete');?></strong>
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
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Liste de produits</h3>
                
                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Rechercher">
                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 400px;">
                <table class="table table-hover table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Désignation</th>
                      <th>Taux d'achat</th>
                      <th>Taux de vente</th>
                      <th>Date création</th>
                      <th>Statut du produit</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
                    $id=1;
                  ?>
                  <?php foreach($products as $row):?>
                    <tr>
                      <td><?= $id++ ;?></td>
                      <td><?= $row->designation ?></td>
                      <td><?= $row->taux_achat; ?> %</td>
                      <td><?= $row->taux_vente; ?> %</td>
                      <td><?= $row->product_date_created ?></td>
                      <td><span class="tag tag-success"><?= $row->product_publish ?></span></td>
                      <td><a class="btn btn-xs btn-primary fa fa-edit"href="<?= site_url('products/edit/'.$row->id_product)?>"></a></td>
                      <td><a onclick="return confirm('Etes-vous sûr de supprimer ce produit ?');" class="btn btn-xs btn-danger fa fa-remove"href="<?= site_url('products/delete/'.$row->id_product)?>"></a></td>
                    </tr>
                  <?php endforeach;?>
                  </tbody>
                </table>
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
     <!-- /.modal -->
     <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Nouveau produit</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="<?= base_url()?>products/create" method="post" id="product_form">
            <div class="modal-body">
            <div class="card card-info">
              <div class="card-body">
                <span id="designation_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">@</span>
                  </div>
                  <input type="text" class="form-control" name="designation" id="designation" placeholder="Désignation">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                  </div>
                </div>

                <span id="tauxvente_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Taux de vente" name="taux_vente" id="taux_vente">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>

                <span id="tauxachat_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Taux d'achat" name="taux_achat" id="taux_achat">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>

                 <div id="success_message">
                  
                </div>
                <!-- /input-group -->

              </div>
              <!-- /.card-body -->
            </div>
            </div>
            <div class="modal-footer justify-content-between">
              <a class="btn btn-warning" href="<?=base_url()?>products" >Fermer</a>
              <button type="submit" class="btn btn-primary" id="btn_saveproduct">Enregistrer</button>
            </div>
          </div>
          <!-- /.modal-content -->
          </div>
        </form>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->


  </div>
  <!-- /.content-wrapper -->