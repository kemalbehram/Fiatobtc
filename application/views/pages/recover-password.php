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
        <a href="<?= base_url()?>"><b>FiaTo</b>BTC</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
        <div class="card-body login-card-body">

            <p class="login-box-msg">Merci <strong><?= $noms; ?></strong>. Vous n'êtes qu'à une étape de votre nouveau mot de passe, récupérez votre mot de passe maintenant.</p>

            <form action="<?= base_url()?>recover/changePassword" method="post" id="recover-form">
                <span id="password_error" class="text-danger text-sm font-italic"> </span>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Nouveau mot de passe" name="password" id="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>

                <span id="confirmPassword_error" class="text-danger text-sm font-italic"></span>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirmer Mot de passe" name="passwordConfirm" id="passwordConfirm">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id_abonne" value="<?= $user['id_abonne']?>" require>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block" id="btn-recover">Changer mot de passe</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            <div id="success_message"></div>
        </div>
        <!-- /.login-card-body -->
    </div>
</div>
<!-- /.login-box -->
</div>


<!-- jQuery -->
<script src="<?=base_url()?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?=base_url()?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets/js/adminlte.min.js"></script>
<script type="text/javascript">
    //Changement de mot de passe oublié
    $(document).ready(function(){
        $('#recover-form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url:"<?= base_url()?>recover/changePassword",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function () {
                    $('#btn-recover').attr('disabled', 'disabled');   
                },
                success:function (data) {
                    if (data.error){
                        if (data.password_error != ''){
                            $('#password_error').html(data.password_error);
                        } else {
                            $('#password_error').html('');
                        }
                        if (data.confirmPassword_error != ''){
                            $('#confirmPassword_error').html(data.confirmPassword_error);
                        } else {
                            $('#confirmPassword_error').html('');
                        }
                        $('#success_message').html('');
                    }
                    if (data.success){
                        $('#success_message').html(data.success);
                        $('#password_error').html('');
                        $('#confirmPassword_error').html('');
                        
                        $('#recover-form')[0].reset();
                        $('#passwordConfirm').attr('disabled', true); 
                        $('#password').attr('disabled', true);
                        $('#btn-recover').fadeOut(1500); 
                    }
                    $('#btn-recover').attr('disabled', false);
                }
            });
        });
    });
</script>
</body>
</html>
