<!DOCTYPE html>
<html lang="fr-FR" data-website-id="1" data-oe-company-name="FIATOBTC">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="generator" content="<?= $title_page; ?>"/>
    <meta name="description" content="<?= $description; ?>"/>
    <meta name="keywords" content="<?=$keywords?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title_page; ?> | <?= $title; ?></title>
    <link type="image/x-icon" rel="shortcut icon" href="<?= base_url() ?>assets/img/core/faveicon.ico"/>
  
  <!-- Tell the browser to be responsive to screen width -->
  

  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">

<div class="login-box">
    <div class="login-logo">
        <a title="Page d'accueil" href="<?=base_url()?>"><b>FiaTo</b>BTC</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">
            <?php if ($this->session->flashdata('connexion_failed')):?>
                <div class="alert alert-danger alert-dismissible" role="alert" id="connexion-failed">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close" id="btn-close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong><?php echo $this->session->flashdata('connexion_failed');?></strong>
                </div>
            <?php endif;?>

            <p class="login-box-msg">Connectez-vous pour ouvrir votre session</p>

            <form action="<?= base_url('login')?>" method="post">
                <div class="input-group mb-3">
                    <input type="email" class="form-control" placeholder="Email" name="email" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password" required>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">

                    <!-- /.col -->
                    <div class="col-12">
                        <button type="submit" class="btn btn-block btn-primary">
                            <i class="fas fa-user mr-2"></i> Se connecter
                        </button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <!-- /.social-auth-links -->
            <p class="mb-1 mt-3">
                <a href="<?= base_url()?>forgot">J'ai oublié mon mot de passe</a>
            </p>
            <p class="mb-0">
                <a href="<?= base_url()?>register" class="btn btn-block btn-danger">
                    <i class="fa fa-registered mr-2"></i> S'inscrire
                </a>
            </p>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
</div>
<!-- jQuery -->
<script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/js/adminlte.min.js"></script>
</body>
</html>