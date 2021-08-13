<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            
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
    <section class="content">
      <div class="container mt-5">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Nouvelle prime</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <form action="<?= base_url()?>buying/sendPrime" method="post">
            <div class="modal-body">
            <div class="card card-info">
              <div class="card-body">
                <div class="input-group mb-3">
                    <label>Email abonné</label>
                    <select class="form-control select2" style="width: 100%;" name="email_abonne" required>
                      <option disabled selected="">Séléctionner</option>
                      <?php foreach($abonnes as $row):?>
                        <option value="<?= $row->email_abonne?>"><?= $row->email_abonne?></option>
                      <?php endforeach;?>
                    </select>
                </div>
              
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Montant" name="montant"required>
                </div>

                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-pen"></i></span>
                  </div>
                  <input type="text" class="form-control" placeholder="Motif" name="motif" required >
                </div>
                </div>
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <a class="btn btn-warning" href="<?=base_url()?>buying/fechAllFidelity" >Fermer</a>
              <button type="submit" class="btn btn-primary">Envoyer</button>
            </div>
            </div>
            
          </div>
          <!-- /.modal-content -->
          </div>
        </form>
        <!-- /.modal-dialog -->
      </div>

      <section/>