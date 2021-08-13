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
<body class="hold-transition register-page">

    <div class="register-box">
      <div class="register-logo">
        <a href="<?= base_url()?>" title="Page d'accueil"><b>FiaTo</b>BTC</a>
      </div>
        <span id="succes_message" class=""></span>
        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Devenez un abonné</p>
                <form action="" method="post" id="register_form">
                    <div class="input-group mb-3">
                        <?php
                        if (isset($referalkey)){
                           echo ' <input type="text" class="form-control" value="'.$referalkey.'"  name="referalkey" id="referalkey">';
                        }
                        else{
                            echo '<input type="text" class="form-control" placeholder="Code de parainage (Optionnel)" value="" id="referalkey"  name="referalkey">';
                        }
                        ?>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span id="referalkey_error" class="text-danger text-md font-italic"></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Prenom" name="prenom" id="prenom" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <span id="prenom_error" class="text-danger text-md font-italic"></span>
                    </div>

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Nom" name="nom" id="nom" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        <span id="nom_error" class="text-danger text-md font-italic"></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        <span id="email_error" class="text-danger text-md font-italic"></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Téléphone ex :+243 000 039 013" name="telephone" id="telephone" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-phone"></span>
                            </div>
                        </div>
                        <span id="telephone_error" class="text-danger text-md font-italic"></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Mot de passe" name="password" id="password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span id="password_error" class="text-danger text-md font-italic"></span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirmer le mot mot de passe" name="passconfirm" id="passconfirm" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        <span id="passconfirm_error" class="text-danger text-md font-italic"></span>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                                <label for="agreeTerms">
                                    J'accepte les <a href="<?= base_url()?>register/terms" target="_blank">termes</a>
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block" id="btn_register">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <a href="<?=base_url()?>login" class="text-center">Je suis déjà abonné</a>
                <div id="sending-progress-msg">
                    
                </div>
                <div id="success-message"></div>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    <!-- /.register-box -->
    </div>

<!-- jQuery -->
<script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/js/adminlte.min.js"></script>
<script type="text/javascript">
    //VALIDATION DU FORMULAIRE D'INSCRIPTION AVEC AJAX JAQUERY & JSON
    $(document).ready(function () {
        //load_unseen_notification();
        $('#register_form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url:"<?= base_url()?>register/doregister",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function () {
                    $('#btn_register').attr('disabled', 'disabled');
                    $('#sending-progress-msg').html('<div class="alert alert-info p-3 text-lg-center mt-3 mb-0">Inscription en cours..... </div>');
                },
                success:function (data) {
                    if (data.error){
                        if (data.referalkey_error != ''){
                            $('#referalkey_error').html(data.referalkey_error);
                        } else {
                            $('#referalkey_error').html('');
                        }
                        if (data.nom_error != ''){
                            $('#nom_error').html(data.nom_error);
                        } else {
                            $('#nom_error').html('');
                        }
                        if (data.prenom_error != ''){
                            $('#prenom_error').html(data.prenom_error);
                        } else {
                            $('#prenom_error').html('');
                        }
                        if (data.email_error != ''){
                            $('#email_error').html(data.email_error);
                        } else {
                            $('#email_error').html('');
                        }
                        if (data.telephone_error != ''){
                            $('#telephone_error').html(data.telephone_error);
                        } else {
                            $('#telephone_error').html('');
                        }
                        if (data.password_error != ''){
                            $('#password_error').html(data.password_error);
                        } else {
                            $('#password_error').html('');
                        }
                        if (data.passconfirm_error != ''){
                            $('#passconfirm_error').html(data.passconfirm_error);
                        } else {
                            $('#passconfirm_error').html('');
                        }
                        $('#success-message').html('');
                        $('#sending-progress-msg').html('');
                    }
                    if (data.success){
                        $('#referalkey_error').html('');
                        $('#nom_error').html('');
                        $('#prenom_error').html('');
                        $('#email_error').html('');
                        $('#telephone_error').html('');
                        $('#password_error').html('');
                        $('#passconfirm_error').html('');
                        $('#register_form')[0].reset();
                        $('#sending-progress-msg').html('<div class="alert-success p-3 text-lg-center"> Merci pour votre inscription sur notre site. Vous pouvez vous <a href ="<?php echo base_url()?>pages/connexion" >connecter Maintenant</a></strong> !</div>');
                        $('#success-message').html('');

                        //load_unseen_notification();
                    }
                    $('#btn_register').attr('disabled', false);
                }
            })
        });

        /*function load_unseen_notification(view = '') {
            $.ajax({
                url: "<?= base_url()?>register/loadNotification",
                method: "POST",
                data: {view: view},
                dataType: "json",
                success: function (data) {
                    $('.dropdown-menu-js').html(data.notification);
                    if (data.unseen_notification > 0) {
                        $('.count').html(data.unseen_notification);
                    }
                }
            });
        }
        
        $(document).on('click', '.dropdown-toggle-count', function () {
            $('.count').html('');
            load_unseen_notification('yes');
        })
        setInterval(function () {
            load_unseen_notification();
        },10000);*/
    });
</script>
</body>
</html>



