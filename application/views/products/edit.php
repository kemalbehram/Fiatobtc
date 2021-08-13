<!-- Content Wrapper. Contains page content -->
  <div class="mt-5 content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edititer le produit</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url()?>products">Produits</a></li>
              <li class="breadcrumb-item active"><?= ucfirst($product['designation'])?></li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container">
        <form method="post" action="<?= base_url()?>products/update" id="edit_product_form">
        <div class="card card-info">
              <div class="card-body">
                <span id="designation_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Désignation</span>
                  </div>
                  <input type="text" class="form-control" name="designation" id="designation" placeholder="Désignation" value="<?= $product['designation']?>">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-check"></i></span>
                  </div>
                </div>

                <span id="tauxvente_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Taux de vente</span>
                  </div>
                  <input type="text" class="form-control" placeholder="Taux de vente" name="taux_vente" id="taux_vente" value="<?= $product['taux_vente']?>">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>

                <span id="tauxachat_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Taux d'achat</span>
                  </div>
                  <input type="text" class="form-control" placeholder="Taux d'achat" name="taux_achat" id="taux_achat" value="<?= $product['taux_achat']?>">
                  <div class="input-group-append">
                    <span class="input-group-text">%</span>
                  </div>
                </div>
                <!-- /input-group -->
              </div>
              <!-- /.card-body -->
              <div class="card-footer justify-content-between">
                <input type="hidden" name="id" value="<?= $product['id_product']?>" required>
              <a href="<?= base_url()?>products" class="btn btn-warning">Annuler</a>
              <button type="submit" class="btn btn-primary" id="btn_updateproduct">Mettre à jour</button>
            </div>
            </div>
        <!-- /.row -->
        </form>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>