<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container mt-5">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Détails</h1>
          </div>
          <div class="col-sm-6 ">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?= base_url();?>">Accueil</a></li>
              <li class="breadcrumb-item active">Détails</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <div class="container">
      <!-- Default box -->
      <div class="card card-solid">
        <div class="card-body pb-0">
          <div class="row d-flex align-items-stretch">
          	<!-- Empty Colomn-->
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
             
            </div>


            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-white">
                <div class="card-header text-muted border-bottom-0">
                  Nouvel abonnement
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?= ucfirst($subscribe['prenom_abonne']) . ' '. ucfirst($subscribe['nom_abonne'])?></b></h2>
                      <p class="text-muted text-sm"><b>Email: </b><?=$subscribe['email_abonne']?>  </p>
                      <p class="text-muted text-sm"><b>Inscrit le : </b><?= substr($subscribe['created_at'],5,13)?>  </p>
                      <p class="text-muted text-sm"><b>Referal Key : </b><?=$subscribe['referal_key_abonne']?>  </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Referal Key parain : <?=$subscribe['referal_key_parain']?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: <?=$subscribe['telephone_abonne']?></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="<?= base_url()?>assets/img/users/<?=$subscribe['photo_abonne']?>" alt="<?=$subscribe['prenom_abonne']?>" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="mailto:<?=$subscribe['email_abonne']?>" class="btn btn-sm bg-teal" title="Envoyer un mail">
                      <i class="fas fa-comments"></i>
                    </a>
                    
                  </div>
                </div>
              </div>
            </div>

			<!-- Empty Colomn-->
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
            </div>

            <?php foreach ($allsubscibes as $subscribes):?>
            <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
              <div class="card bg-light">
                <div class="card-header text-muted border-bottom-0">
                  Membres inscrits
                </div>
                <div class="card-body pt-0">
                  <div class="row">
                    <div class="col-7">
                      <h2 class="lead"><b><?= ucfirst($subscribes->prenom_abonne) . ' '. ucfirst($subscribes->nom_abonne)?></b></h2>
                      <p class="text-muted text-sm"><b>Email: </b><?=$subscribes->email_abonne?>  </p>
                      <p class="text-muted text-sm"><b>Inscrit le : </b><?= substr($subscribes->created_at,5,13)?>  </p>
                      <p class="text-muted text-sm"><b>Referal Key : </b><?=$subscribes->referal_key_abonne?>  </p>
                      <ul class="ml-4 mb-0 fa-ul text-muted">
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span> Referal Key parain : <?=$subscribes->referal_key_parain?></li>
                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span> Phone #: <?=$subscribes->telephone_abonne?></li>
                      </ul>
                    </div>
                    <div class="col-5 text-center">
                      <img src="<?= base_url()?>assets/img/users/<?=$subscribes->photo_abonne ?>" alt="" class="img-circle img-fluid">
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="text-right">
                    <a href="mailto:<?=$subscribes->email_abonne?>" class="btn btn-sm bg-teal" title="Envoyer un email">
                      <i class="fas fa-comments"></i>
                    </a>
                    <a href="<?= base_url()?>register/fetchAbonnes" class="btn btn-sm btn-primary">
                      <i class="fas fa-user"></i> Voir la liste
                    </a>
                  </div>
                </div>
              </div>
            </div>
        <?php endforeach;?>

          </div>
        </div>
      
      </div>
      <!-- /.card -->
 	 </div> <!-- /.container -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->