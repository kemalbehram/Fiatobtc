<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container mt-5">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?= base_url(); ?>">Accueil</a></li>
                        <li class="breadcrumb-item active">Profile Membre</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container">

            <div class="row">
                
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="<?= base_url() ?>assets/img/users/<?= $mydata['photo_abonne'] ?>"
                                     alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= ucfirst($mydata['prenom_abonne']) . ' ' . ucfirst($mydata['nom_abonne']) ?></h3>

                            <p class="text-muted text-center"><?= $mydata['email_abonne'] ?></p>
                            <button type="button" class="btn btn-primary mt-2 btn-block" data-toggle="modal" data-target="#modal-lg">
                              Changer mot de passe
                            </button>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Mes ventes</b> <a class="float-right"><?= number_format($total_sales['somme'],2, ',',''); ?>USD</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Mes achats</b> <a class="float-right"><?= number_format($total_buying['somme'],2, ',',''); ?> USD</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Mes filleuls</b> <a class="float-right"><?= $nb_fiels; ?></a>
                                </li>
                            </ul>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                    <!-- About Me Box -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">A propos de moi</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <strong><i class="fas fa-book mr-1"></i> Pay d'origine</strong>
                            <?php if ($mydata['pays_origine']): ?>
                                <p class="text-muted">
                                    <?= $mydata['pays_origine'] ?>
                                </p>
                            <?php else : ?>
                                <p class="text-warning">
                                    Veuillez compléter votre profil</p>
                            <?php endif; ?>
                            <hr>

                            <strong><i class="fas fa-map mr-1"></i> Ville</strong>
                            <?php if ($mydata['ville_abonne']): ?>
                                <p class="text-muted">
                                    <?= $mydata['ville_abonne'] ?>
                                </p>
                            <?php else : ?>
                                <p class="text-warning">
                                    Veuillez compléter votre profil</p>
                            <?php endif; ?>
                            <hr>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Adresse</strong>
                            <?php if ($mydata['adresse']): ?>
                                <p class="text-muted">
                                    <?= $mydata['adresse'] ?>
                                </p>
                            <?php else : ?>
                                <p class="text-warning">
                                    Veuillez compléter votre profil</p>
                            <?php endif; ?>
                            <hr>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <?php if ($this->session->flashdata('account_updated')):?>
                      <div class="col-6">
                        <div class="alert alert-success alert-dismissible" role="alert" id="connexion-failed">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <strong><?= $this->session->flashdata('account_updated');?></strong>
                        </div>
                      </div>
                    <?php endif;?>
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Compléter</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#fiels" data-toggle="tab">Mes filleuls</a></li>
                                <li class="nav-item"><a class="nav-link" href="#activity" data-toggle="tab">Mes achats</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#ventes" data-toggle="tab">Mes ventes</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#bonus" data-toggle="tab">Mes Bonus</a>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#primes" data-toggle="tab">Mes Primes</a>
                                </li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane" id="activity">
                                  
                                 <div class="card">
                                  <div class="card-header">
                                    <h3 class="card-title">Vos commandes d'achats</h3>
                                    </div>
                                      <!-- /.card-header -->
                                      <div class="card-body p-0">
                                        <table class="table table-bordered table-striped table-hover table-responsive">
                                          <thead>
                                            <tr>
                                              <th>#</th>
                                              <th>Date commande </th>
                                              <th>Produit</th>
                                              <th>Qte USD</th>
                                              <th>Qte BTC-USDT</th>
                                              <th>Etat commande</th>
                                              <th>Preuve de paiement</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php if(!$buyingcommands):?>
                                                <tr>
                                                <p class="text-center font-weight-bold text-warning">Vous n'avez pas encore effectué une commande</p>
                                                </tr>
                                            <?php else: $id=1; ?>
                                            <?php foreach($buyingcommands as $buyingcommand):?>
                                                <tr>
                                                  <td><?= $id++; ?></td>
                                                  <td><?= substr($buyingcommand->date_commande,0,11)?></td>
                                                   <td><?= $buyingcommand->codeProduit?></td>
                                                  <td><?= $buyingcommand->qte_achete_usd?></td>
                                                  <td><?= $buyingcommand->qte_achete_btc?></td>

                                                  <td>
                                                    <div class="progress progress-xs">
                                                        <?php if($buyingcommand->etat_commande=='en cours'):?>
                                                        <div class="progress-bar progress-bar-primary bg-primary" style="width: 55%">
                                                        </div>
                                                        <?php elseif($buyingcommand->etat_commande=='rejetée'):?>
                                                        <div class="progress-bar progress-bar-danger bg-danger" style="width: 55%">
                                                            
                                                        </div>
                                                        <?php elseif($buyingcommand->etat_commande=='traitée'):?>
                                                        <div class="progress-bar progress-bar-success bg-success" style="width: 55%"> 
                                                        </div>
                                                        
                                                        <?php endif;?>
                                                    </div>
                                                  </td>
                                                  <td class="text-center"><a href="<?= base_url()?>buying/preuvePaiment/<?= $buyingcommand->numero_commande?>" class="btn btn-sm btn-primary">Voir</a>
                                                  </td>
                                                
                                                </tr>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                            
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                    <strong>Légende d'état : </strong>
                                      <span class="badge bg-primary">En cours</span>
                                      <span class="badge bg-danger">Rejetée</span>
                                      <span class="badge bg-success">Validée</span>

                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="bonus">
                                  
                                 <div class="card">
                                  <div class="card-header">
                                    <h3 class="card-title">Vos bonus</h3>
                                    </div>
                                      <!-- /.card-header -->
                                      <div class="card-body p-0">
                                        <table class="table table-sm">
                                          <thead>
                                            <tr>
                                              <th style="width: 10px">#</th>
                                              <th>Provenance</th>
                                              <th>Montant USD</th>
                                              <th>Motif</th>
                                              <th style="width: 40px">Etat</th>
                                              <th></th>
                                            
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php if(!$bonus):?>
                                                <tr>
                                                <p class="text-center font-weight-bold text-warning">Vous n'avez pas encore eu de bonus</p>
                                                </tr>
                                            <?php else: $id=1; ?>
                                            <?php foreach($bonus as $row):?>
                                                <tr>
                                                  <td><?= $id++; ?></td>
                                                  <td><?= $row->prenom_abonne.' '.$row->nom_abonne ?></td>
                                                  <td><?= $row->bonus?></td>
                                                  <td>Achat</td>

                                                    <?php if($row->statut_bonus=='non réglé'):?>
                                                    <td> 
                                                        <button class="btn btn-xs btn-danger btn-reclamer-bonus" data-bonusid="<?= $row->id_bonus?>">Non réglé(Reclamer)</button>
                                                    </td>
                                                    <?php else:?>
                                                        <td class="text-success font-weight-bold"><?= ucfirst($row->statut_bonus)?>
                                                        </td>
                                                    <?php endif;?>
                                                </tr>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->

                                    </div>
                                    <div id="success_bonus" class="mt-3 pb-0">
                                        
                                    </div>
                                </div>
                                <div class="tab-pane" id="ventes">
                                    <div class="card">
                                  <div class="card-header">
                                    <h3 class="card-title">Vos ventes</h3>
                                    </div>
                                      <!-- /.card-header -->
                                      <div class="card-body p-0">
                                        <table class="table table-sm">
                                          <thead>
                                            <tr>
                                              <th style="width: 10px">#</th>
                                              <th>Date</th>
                                              <th>Produit</th>
                                              <th>Montant USD</th>
                                              <th>Montant BTC</th>
                                              <th style="width: 40px">Statut</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php if(!$sales):?>
                                                <tr>
                                                <p class="text-center font-weight-bold text-warning">Vous n'avez pas encore effectué une vente</p>
                                                </tr>
                                            <?php else: $id=1; ?>
                                            <?php foreach($sales as $row):?>
                                                <tr>
                                                  <td><?= $id++; ?></td>
                                                  <td><?= $row->created_at ?></td>
                                                  <td><?= $row->to_currency ?></td>
                                                  <td><?= $row->entered_amount ?></td>
                                                  <td><?= $row->amount ?></td>
                                                  <?php if($row->status=='initialized'):?>
                                                  <td class="text-warning"><?= $row->status ?></td>
                                                  <?php else : ?>
                                                  <td class="text-info"><?= $row->status ?></td>
                                                    <?php endif;?>
                                                </tr>
                                            <?php endforeach;?>
                                            <?php endif;?>
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="active tab-pane" id="settings">

                                  <p class="font-weight-bold text-muted">Compléter ou modifier les informations supplémentaires</p>

                                  <div class="form-group row">
                                    <label for="inputSkills" class="col-sm-2 col-form-label">Lien de parainage</label>
                                    <div class="col-sm-9">
                                        <input class="form-control text-blue text-underline" type="text"
                                       value="<?=base_url()?>register/index/<?= $mydata['referal_key_abonne']?>" id="copyArea" readonly="true">
                                    </div>
                                    <p class="col-sm-1"><a href="#" class="link-black text-sm" id="btnCopy"><i class="far fa-copy mr-1"></i>
                                        Copier</a>
                                    </p>      
                                  </div>

                                  <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Clé de parainage</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="inputSkills"value="<?= $mydata['referal_key_abonne']?>" readonly="true">
                                        </div>
                                  </div>
                                      <?php
                                        $hidden = array('class' => 'form-horizontal');
                                            echo form_open_multipart('register/updateAccount', '', $hidden);
                                       ?>
                                        <div class="form-group row">
                                            <label for="inputPays" class="col-sm-2 col-form-label">Votre pays</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name ="pays_origine" placeholder="Pays" value="<?= $mydata['pays_origine']?>" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="inputEmail" class="col-sm-2 col-form-label">Ville</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="ville_abonne"
                                                       placeholder="Ville" value="<?= $mydata['ville_abonne']?>">
                                            </div>
                                        </div>
                                      
                                        <div class="form-group row">
                                            <label for="inputExperience"
                                                   class="col-sm-2 col-form-label">Adresse</label>
                                            <div class="col-sm-10">
                                                <textarea class="form-control" name="adresse" id="inputAdresse" placeholder="Adresse">
                                                    <?= $mydata['adresse']?>          
                                              </textarea>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                        <!-- <label for="customFile">Custom File</label> -->
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                            <div class="custom-file">
                                              <input type="file" class="custom-file-input" id="customFile" name="photo_abonne" accept=".jpg, .png, .gif">
                                              <label class="custom-file-label" for="customFile">Changer la photo de profil</label>
                                            </div>
                                            </div>
                                        </div>
                                    
                                        
                                        <div class="form-group row">
                                            <div class="offset-sm-2 col-sm-10">
                                                <button type="submit" class="btn btn-danger">Mettre à jour</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane" id="fiels">
                                    <!-- Post -->
                                    <?php if ($fiels): ?>
                                        <?php foreach ($fiels as $fiel): ?>
                                            <div class="post">
                                                <div class="user-block">
                                                    <img class="img-circle img-bordered-sm"
                                                         src="<?= base_url() ?>assets/img/users/<?= $fiel->photo_abonne ?>"
                                                         alt="user image">
                                                    <span class="username">
                                        <a href="#"><?= $fiel->prenom_abonne . ' ' . $fiel->nom_abonne ?></a>
                                        <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                      </span>
                                                    <span class="description">Insrit depuis - <?= $fiel->created_at ?></span>
                                                </div>
                                                <!-- /.user-block -->
                                                <input class="form-control form-control-sm font-weight-bold" type="text"
                                                       value="Clé de référence : <?= $fiel->referal_key_abonne ?>"
                                                       readonly="true">
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                        <div class="post">
                                            <p class="text-danger text-lg text-center font-weight-bold">Vous n'avez
                                                aucun parainé !</p>
                                        </div>
                                    <?php endif; ?>

                                    <!-- /.post -->
                                </div>

                                <div class="tab-pane" id="primes">
                                  
                                 <div class="card">
                                  <div class="card-header">
                                    <h3 class="card-title">Vos primes</h3>
                                    </div>
                                      <!-- /.card-header -->
                                      <div class="card-body p-0">
                                        <table class="table table-sm">
                                          <thead>
                                            <tr>
                                              <th>Date</th>
                                              <th>Montant USD</th>
                                              <th>Motif</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php if(!$primes):?>
                                                <tr>
                                                <p class="text-center font-weight-bold text-warning">Vous n'avez pas encore eu de prime</p>
                                                </tr>
                                            <?php else :?>
                                              <?php foreach($primes as $row):?>
                                                  <tr>
                                                    <td><?= date('M-d-Y', strtotime($row->created_at_prime)) ?></td>
                                                    <td><?= $row->montant ?></td>
                                                    <td><?= $row->motif?></td>
                                                  </tr>
                                              <?php endforeach;?>
                                            <?php endif;?>
                                          </tbody>
                                        </table>
                                      </div>
                                      <!-- /.card-body -->

                                    </div>
                                </div>

                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- /.modal -->

     <div class="modal fade" id="modal-lg">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Changer le mot de passe</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <form action="<?= base_url()?>register/changePassword" method="post" id="account_form">
            <div class="modal-body">
            <div class="card card-info">
              <div class="card-body">
                <span id="ancient_password_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                  <input type="password" class="form-control" name="ancient_password" id="ancient_password" placeholder="Ancien Mot de passe">
               </div>

                <span id="new_password_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Nouveau mot de passe" name="new_password" id="new_password">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                  </div>
                </div>
                <span id="confirm_new_password_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Confirmer le mot de passe" name="confirm_new_password" id="confirm_new_password">
                  <div class="input-group-append">
                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
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
              <a type="button" class="btn btn-warning" data-dismiss="modal">Fermer</a>
              <button type="submit" class="btn btn-primary" id="btn_savepassword">Enregistrer</button>
            </div>
          </div>
          <!-- /.modal-content -->
          </div>
        </form>
        <!-- /.modal-dialog -->
      </div>
      <!-- /.modal -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->