

<section id="section-footer" style="width: 100%;height: 370px; font-family: arial" class="mb-0 pb-0">
        <div class="container text-center" id="cont-footer">
            <div class="div-footer-top pt-5">
                <h1>Adresse et contacts</h1>
                <p><i class="fas fa-map-marker-alt item"></i>&nbsp; Lubumbashi, RDC / +243 97 56 55 201<br></p>
                <p class="mt-4"><i class="fas fa-map-marker-alt item"></i>&nbsp; Kampala, OUGANDA / +256 792 418 437<br></p>
                <p class="mt-3"><i class="fas fa-envelope item"></i>&nbsp; contact@fiatobtc.com</p>
            </div>
            <div id="div-social" class="p-1 mb-2" style="">
                <a href="https://Facebook.com/fiatobtc/" target="_blank"><i class="fab fa-facebook social text-lg mr-2" style="color: rgb(53,22,241); transition: all ease-in-out .4s"></i></a>
                <a href="https://t.me/joinchat/HIqjiih-l7U-xYXE" target="_blank"><i class="fab fa-telegram-plane social text-lg mr-2" style="color: #2603f9; transition: all ease-in-out .4s"></i></a>
                <a href="https://api.whatsapp.com/send?phone=243971359902" target="_blank"><i class="fab fa-whatsapp social text-lg" style="color: rgb(47,163,29); transition: all ease-in-out .4s"></i></a>
            </div>
            <div id="div-copyright" class="mb-0 pb-0">
                <p>FiaToBtc &copy; Copyright 
                    <script>
                        document.write(new Date().getFullYear());
                    </script> | Tous droits réservés
                </p>
            </div>
        </div>
</section>
</div>
<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url() ?>assets/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->

<!-- Bootstrap4 Duallistbox -->
<script src="<?= base_url() ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- SweetAlert2 -->

<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>

<script src="<?= base_url() ?>assets/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url() ?>assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- FiaToBTC App -->
<script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
<script src="<?= base_url() ?>assets/js/demo.js"></script>
<script src="<?= base_url() ?>assets/js/copy.js"></script>
<script src="<?= base_url() ?>assets/js/paste.js"></script>


<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
      "info": true
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>


<script type="text/javascript">
     $(function() {
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });
        $('.operationAchatVente').click(function() {
            $(document).Toasts('create', {
                class:'bg-warning',
                body: 'Vous devez vous connecter ou bien vous inscrire avant de commencer toute les opérations d\achat ou de vente .',
                title: 'FiaToBTC',
                subtitle: 'Demande de connexion',
                image: '<?= base_url()?>assets/img/core/FiatoBTcLogo.png',
                imageAlt: 'FiaToBTC',
            })
        });

        $('.exchangeNonDispo').click(function(){
             $(document).Toasts('create', {
                class:'bg-info',
                body: 'Cette fonctionnalité est encore indisponible sur notre plate-forme, son fonctionnement sera activé dans quelques jours, Merci de patienter .',
                title: 'FiaToBTC',
                subtitle: 'Opération Indisponible',
                image: '<?= base_url()?>assets/img/core/FiatoBTcLogo.png',
                imageAlt: 'FiaToBTC',
            });
        });


    });   
</script>

<script>
    //SELECT
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

  });
</script>

<script type="text/javascript">
    //Changement du mot de passe
    $(document).ready(function(){
        $('#account_form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url:"<?= base_url()?>register/changePassword",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function () {
                    $('#btn_savepassword').attr('disabled', 'disabled');   
                },
                success:function (data) {
                    if (data.error){
                        if (data.ancient_password_error != ''){
                            $('#ancient_password_error').html(data.ancient_password_error);
                        } else {
                            $('#ancient_password_error').html('');
                        }
                        if (data.new_password_error != ''){
                            $('#new_password_error').html(data.new_password_error);
                        } else {
                            $('#new_password_error').html('');
                        }
                        if (data.confirm_new_password_error != ''){
                            $('#confirm_new_password_error').html(data.confirm_new_password_error);
                        } else {
                            $('#confirm_new_password_error').html('');
                        }
                        $('#success_message').html('');
                    }
                    if (data.success){
                        $('#success_message').html(data.success);
                        $('#ancient_password_error').html('');
                        $('#new_password_error').html('');
                        $('#confirm_new_password_error').html('');
                        $('#account_form')[0].reset();
                        $('#btn_savepassword').attr('disabled', 'disabled'); 
                    }
                    $('#btn_savepassword').attr('disabled', false);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        //Validation de produit
       $('#product_form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url:"<?= base_url()?>products/create",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function () {
                    $('#btn_saveproduct').attr('disabled', 'disabled');   
                },
                success:function (data) {
                    if (data.error){
                        if (data.designation_error != ''){
                            $('#designation_error').html(data.designation_error);
                        } else {
                            $('#designation_error').html('');
                        }
                        if (data.tauxvente_error != ''){
                            $('#tauxvente_error').html(data.tauxvente_error);
                        } else {
                            $('#tauxvente_error').html('');
                        }
                        if (data.tauxachat_error != ''){
                            $('#tauxachat_error').html(data.tauxachat_error);
                        } else {
                            $('#tauxachat_error').html('');
                        }
                        $('#btn_saveproduct').attr('disabled', 'disabled');
                        $('#success_message').html('');
                    }
                    if (data.success){
                        $('#success_message').html(data.success);
                        $('#designation_error').html('');
                        $('#tauxachat_error').html('');
                        $('#tauxvente_error').html('');
                        $('#product_form')[0].reset();
                        $('#btn_saveproduct').attr('disabled', 'disabled'); 
                        
                    }
                    $('#btn_saveproduct').attr('disabled', false);
                }
            })
        });
   })
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#edit_product_form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url:"<?= base_url()?>products/update",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function () {
                    $('#btn_saveproduct').attr('disabled', 'disabled');   
                },
                success:function (data) {
                    if (data.error){
                        if (data.designation_error != ''){
                            $('#designation_error').html(data.designation_error);
                        } else {
                            $('#designation_error').html('');
                        }
                        if (data.tauxvente_error != ''){
                            $('#tauxvente_error').html(data.tauxvente_error);
                        } else {
                            $('#tauxvente_error').html('');
                        }
                        if (data.tauxachat_error != ''){
                            $('#tauxachat_error').html(data.tauxachat_error);
                        } else {
                            $('#tauxachat_error').html('');
                        }
                    }
                    if (data.success){
                        /*$('#designation_error').html('');
                        $('#tauxachat_error').html('');
                        $('#tauxvente_error').html('');
                        $('#product_form')[0].reset();
                        $('#modal-lg').fadeOut(500);*/
                    }
                    $('#btn_saveproduct').attr('disabled', false);
                }
            });
        });
    })
</script>

<script type="text/javascript">
    //Formulaire d'édition de produits
    $(document).ready(function(){
        $('#edit_product_form').on('submit', function (event) {
            event.preventDefault();
            $.ajax({
                url:"<?= base_url()?>products/update",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function () {
                    $('#btn_saveproduct').attr('disabled', 'disabled');   
                },
                success:function (data) {
                    if (data.error){
                        if (data.designation_error != ''){
                            $('#designation_error').html(data.designation_error);
                        } else {
                            $('#designation_error').html('');
                        }
                        if (data.tauxvente_error != ''){
                            $('#tauxvente_error').html(data.tauxvente_error);
                        } else {
                            $('#tauxvente_error').html('');
                        }
                        if (data.tauxachat_error != ''){
                            $('#tauxachat_error').html(data.tauxachat_error);
                        } else {
                            $('#tauxachat_error').html('');
                        }
                    }
                    if (data.success){
                        /*$('#designation_error').html('');
                        $('#tauxachat_error').html('');
                        $('#tauxvente_error').html('');
                        $('#product_form')[0].reset();
                        $('#modal-lg').fadeOut(500);*/
                    }
                    $('#btn_saveproduct').attr('disabled', false);
                
                }
            });
        });
    })
</script>

<script type="text/javascript">
    //ANNULATION ET VALIDATION DE COMMANDES D'ACHATS
    $(document).ready(function(){
        $('#btn_cancel').click(function(){
            var request = $('#numero_commande').val();
            $.ajax({
                    url:"<?= base_url()?>buying/cancelCommand",
                    method:'POST',
                    data:{
                    request: request
                    },
                    success: function(data){
                    $('#success_message').html('<div class="alert alert-success">Commande la commande a été rejetée avec succès</div>');
                    
                    $('#btn_cancel').fadeOut(1500);
                    $('#btn_validate').fadeOut(1500);
                    }
                })
            });

            $('#btn_validate').click(function(){
            var code_hash=$('#code_hash').val();
            if (code_hash=='') {
                alert('Veuillez saisir ou coller le Hash avant de valider la commande !')
            }else{
            var request = $('#numero_commande').val();
            var id_abonne = $('#id_abonne').val();
            var key_parain = $('#key_parain').val();

            $.ajax({
                    url:"<?= base_url()?>buying/validCommand",
                    method:'POST',
                    data:{
                    request: request,
                    id_abonne: id_abonne,
                    key_parain : key_parain,
                    code_hash: code_hash
                    },
                    success: function(data){
                    $('#success_message').html('<div class="alert alert-success">Commande la commande a été validée avec succès</div>');
                    
                    $('#group-hashcode').fadeOut(1500);
                    $('#btn_cancel').fadeOut(1500);
                    $('#btn_validate').fadeOut(1500);
                    }
                })
                }
                
            });
        })

</script>
<script type="text/javascript">
    //Reglement bonus
    $(document).ready(function(){
        //Regler
        $('.btn_regler_bonus').click(function(){
            var id_bonus= $(this).data("idbonus");
            $.ajax({
                url:"<?php echo base_url()?>buying/reglerBonus",
                method:"POST",
                data:{id_bonus:id_bonus},

                success:function (data) {
                    $('#success_message').html('<div class="alert alert-success">Le bonus a été réglé</div>');
                }
            });
        });

        //Reclamer
        $('.btn-reclamer-bonus').click(function(){
            var  bonus_id= $(this).data("bonusid");
            $.ajax({
                url:"<?php echo base_url()?>buying/reclamerBonus",
                method:"POST",
                data:{bonus_id:bonus_id},

                success:function (data) {
                    $('#success_bonus').html('<div class="alert alert-success">La reclamation sur ce bonus a été envoyé, une fois traité le <strong>statut</strong> de votre bonus changera en <strong>Réglé</strong>. Merci de patienter !</div>');
                }
            });
        });
    })
</script>
<script type="text/javascript">
    $(document).ready(function(){
        //VALIDATION ET CONFIRMATION DE COMMANDES DE VENTES
        $('#btn_cancel_sales').click(function(){
            var request = $('#id_paiement').val();
            $.ajax({
                    url:"<?= base_url()?>sales/cancelCommand",
                    method:'POST',
                    data:{
                    request: request
                    },
                    success: function(data){
                    $('#success_message_sales').html('<div class="alert alert-success">Commande la commande a été rejetée avec succès</div>');
                    
                    $('#btn_cancel_sales').fadeOut(1500);
                    $('#btn_validate_sales').fadeOut(1500);
                    }
                })
            });

            $('#btn_validate_sales').click(function(){
            var request = $('#id_paiement').val();
            $.ajax({
                    url:"<?= base_url()?>sales/validCommand",
                    method:'POST',
                    data:{
                    request: request
                    },
                    success: function(data){
                    $('#success_message_sales').html('<div class="alert alert-success">Commande la commande a été validée avec succès</div>');
                    
                    $('#btn_cancel_sales').fadeOut(1500);
                    $('#btn_validate_sales').fadeOut(1500);
                    }
                })
            });
        })
</script>
<script type="text/javascript">
    //TRANSLATE
    function googleTranslateElementInit2() {
        new google.translate.TranslateElement({pageLanguage: 'fr', autoDisplay: false}, 'google_translate_element2');
    }
</script>
<script type="text/javascript"
        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit2"></script>

<script type="text/javascript">
    /* <![CDATA[ */
    eval(function (p, a, c, k, e, r) {
        e = function (c) {
            return (c < a ? '' : e(parseInt(c / a))) + ((c = c % a) > 35 ? String.fromCharCode(c + 29) : c.toString(36))
        };
        if (!''.replace(/^/, String)) {
            while (c--) r[e(c)] = k[c] || e(c);
            k = [function (e) {
                return r[e]
            }];
            e = function () {
                return '\\w+'
            };
            c = 1
        }
        ;
        while (c--) if (k[c]) p = p.replace(new RegExp('\\b' + e(c) + '\\b', 'g'), k[c]);
        return p
    }('6 7(a,b){n{4(2.9){3 c=2.9("o");c.p(b,f,f);a.q(c)}g{3 c=2.r();a.s(\'t\'+b,c)}}u(e){}}6 h(a){4(a.8)a=a.8;4(a==\'\')v;3 b=a.w(\'|\')[1];3 c;3 d=2.x(\'y\');z(3 i=0;i<d.5;i++)4(d[i].A==\'B-C-D\')c=d[i];4(2.j(\'k\')==E||2.j(\'k\').l.5==0||c.5==0||c.l.5==0){F(6(){h(a)},G)}g{c.8=b;7(c,\'m\');7(c,\'m\')}}', 43, 43, '||document|var|if|length|function|GTranslateFireEvent|value|createEvent||||||true|else|doGTranslate||getElementById|google_translate_element2|innerHTML|change|try|HTMLEvents|initEvent|dispatchEvent|createEventObject|fireEvent|on|catch|return|split|getElementsByTagName|select|for|className|goog|te|combo|null|setTimeout|500'.split('|'), 0, {}))
    /* ]]> */
</script>
<script type="text/javascript">
    //TRAITEMENTS DES COMMANDES D'ECHANDE
    $(document).ready(function(){
        $('#montant_transfere').hide();
        $('#input-transaction-id').hide();
        $('#phone_transaction').hide();
        $('#sendPhoneNumber').hide();
        $('#sendPhoneNumber2').hide();
        $('#readmore').hide();
        $('#currencyUsdt').hide();
        $('#currencyBtc').hide();
        $('#btnSaveCMD').attr('disabled', false);

        $('#select-payment-mode').change(function () {
            var moyen = $('#select-payment-mode').val();
            if (moyen == 243) {
                $('#input-transaction-id').fadeIn(1500);
                $('#sendPhoneNumber').fadeIn(1500);
                $('#sendPhoneNumber2').fadeOut(1500);
                $('#readmore').fadeIn(1500);
                $('#phone_transaction').fadeIn(1500);
                $('#montant_transfere').fadeIn(1500);

            }else {

                $('#sendPhoneNumber').fadeOut(1500);
                $('#sendPhoneNumber2').fadeIn(1500);
                $('#input-transaction-id').fadeIn(1500);
                $('#phone_transaction').fadeIn(1500);
                $('#montant_transfere').fadeIn(1500);
                $('#readmore').fadeIn(1500);

            }
        });

        $('#input-transaction-id').keyup(function(){
            var request= $(this).val();
            if (request.length > 0) {
                $('#btnSaveCMD').attr('disabled', false);
            }else {
                $('#btnSaveCMD').attr('disabled', false);
            }
        });
        //VALIDATION DE LA COMMANDE D'ECHANGE DE CRYPTO CONTRE DU FIAT
        $('#btn_validate_exchange_crypto').click(function () {
            var request = $('#id_exchangeCryptoFiat').val();
            var email= $('#emailAbonne').val();
            var prenom = $('#prenomAbonne').val();
            $.ajax({
                url:"<?= base_url()?>exchange/validDemandeCryptoFiat",
                method:'POST',
                data:{
                    request: request,
                    email:email,
                    prenom:prenom
                },
                success: function(data){
                    $('#success_messageCryptoFiat').html('<div class="alert alert-success">La demande a été validée avec succès</div>');

                    $('#btn_cancel__exchange_crypto').fadeOut(1500);
                    $('#btn_validate_exchange_crypto').fadeOut(1500);
                }
            })
        });
        //ANNULATION DE LA COMMANDE D'ECHANGE DE CRYPTO CONTRE DU FIAT
        $('#btn_cancel__exchange_crypto').click(function () {
            var request = $('#id_exchangeCryptoFiat').val();
            var email = $('#emailAbonne').val();
            var prenom = $('#prenomAbonne').val();
            $.ajax({
                url:"<?= base_url()?>exchange/cancelDemandeCryptoFiat",
                method:'POST',
                data:{
                    request: request,
                    email:email,
                    prenom:prenom
                },
                success: function(data){
                    $('#success_messageCryptoFiat').html('<div class="alert alert-success">La demande a été réjetée avec succès</div>');

                    $('#btn_cancel__exchange_crypto').fadeOut(1500);
                    $('#btn_validate_exchange_crypto').fadeOut(1500);
                }
            })
        });

        // TRAITEMENT DES COMMANDES D'ACHAT DE CRYPTO CONTRE DU FIAT
        /*1. Validation*/

        $('#btn_validate_order_achat_cryptofiat').click(function () {
            var request = $('#id_buyingCryptoFiat').val();
            var id_exchange = $('#id_exchange').val();
            var qte_commande= $('#qte_commande').val();
            var email= $('#emailAbonne').val();
            var prenom = $('#prenomAbonne').val();
            var code_hash = $('#code_hash').val();
            if (code_hash == '') {
                alert('Veuillez coller le code Hash avant de valider');
            }else{
               $.ajax({
                    url:"<?= base_url()?>exchange/validOrdersAchatCryptoFiat",
                    method:'POST',
                    data:{
                        request: request,
                        email:email,
                        prenom:prenom,
                        code_hash:code_hash,
                        id_exchange:id_exchange,
                        qte_commande:qte_commande
                    },
                    success: function(data){
                        $('#success_message_achat_cryptoFiat').html('<div class="alert alert-success">La demande a été validée avec succès</div>');

                        $('#btn_cancel_order_achat_cryptofiat').fadeOut(1500);
                        $('#btn_validate_order_achat_cryptofiat').fadeOut(1500);
                    }
                }) 
            }
            
        });
        /*2. Annulation ECHANGE FIAT CONTRE CRYPTO*/
        //ANNULATION DE LA COMMANDE D'ECHANGE DU FIAT CONTRE CRYPTO
        $('#btn_cancel__exchange_fiat').click(function () {
            var request = $('#id_exchangeFiatCrypto').val();
            var email = $('#emailAbonne').val();
            var prenom = $('#prenomAbonne').val();
            $.ajax({
                url:"<?= base_url()?>exchange/cancelDemandeFiatCrypto",
                method:'POST',
                data:{
                    request: request,
                    email:email,
                    prenom:prenom
                },
                success: function(data){
                    $('#success_messageCryptoFiat').html('<div class="alert alert-success">La demande a été réjetée avec succès</div>');

                    $('#btn_cancel__exchange_fiat').fadeOut(1500);
                    $('#btn_validate_exchange_fiat').fadeOut(1500);
                }
            })
        });
        //VALIDATION DE LA COMMANDE D'ECHANGE DE FIAT CONTRE CRYPTO
        $('#btn_validate_exchange_fiat').click(function () {
            var request = $('#id_exchangeFiatCrypto').val();
            var email= $('#emailAbonne').val();
            var prenom = $('#prenomAbonne').val();
            $.ajax({
                url:"<?= base_url()?>exchange/validDemandeFiatCrypto",
                method:'POST',
                data:{
                    request: request,
                    email:email,
                    prenom:prenom
                },
                success: function(data){
                    $('#success_messageCryptoFiat').html('<div class="alert alert-success">La demande a été validée avec succès</div>');

                    $('#btn_cancel__exchange_fiat').fadeOut(1500);
                    $('#btn_validate_exchange_fiat').fadeOut(1500);
                }
            })
        });

    });
</script>
<script type="text/javascript">
    //CONVERTISSEUR USD TO BTC
    $(document).ready(function () {
        var commission=0;
        var total=0;
        var taux= $('#taux_transaction').val();
        var url= "<?= base_url()?>buying/cmd_convert";

        $('#usd_qte').keyup(function(){
            var request= $(this).val();
            if (request != '') {
                if (request>0) {
                    $.ajax({
                        url:url,
                        method:'POST',
                        data:{
                            request: request
                        },
                        success: function(data){
                            $('#btc_qte').val(data);

                            commission = request * taux / 100;

                            total=parseFloat(commission) + parseFloat(request);
                            $('#total_a_payer').val(total);
                        }
                    });
                }else{
                    $('#btc_qte').val('');
                    $('#total_a_payer').val('');
                }
            }else{
                $('#btc_qte').val('');
                $('#total_a_payer').val('');
            }
            if (request=='') {
                $('#btc_qte').val('');
                $('#total_a_payer').val('');
            }
        });

        $('#btn_validate_order_achat_fiatcrypto').click(function () {
            var request = $('#id_buyingFiatCrypto').val();
            var id_exchange = $('#id_exchange').val();
            var qte_commande= $('#qte_commande').val();
            var email= $('#emailAbonne').val();
            var prenom = $('#prenomAbonne').val();
               $.ajax({
                    url:"<?= base_url()?>exchange/validOrdersAchatFiatCrypto",
                    method:'POST',
                    data:{
                        request: request,
                        email:email,
                        prenom:prenom,
                        id_exchange:id_exchange,
                        qte_commande:qte_commande
                    },
                    success: function(data){
                        $('#success_message_achat_cryptoFiat').html('<div class="alert alert-success">La demande a été validée avec succès</div>');

                        $('#btn_cancel_order_achat_fiatcrypto').fadeOut(1500);
                        $('#btn_validate_order_achat_fiatcrypto').fadeOut(1500);
                    }
                });
            
        });
        //ANNULATION DE LA COMMANDE D'ECHANGE DE CRYPTO CONTRE DU FIAT
        $('#btn_cancel_order_achat_fiatcrypto').click(function () {
            var request = $('#id_buyingFiatCrypto').val();
            var email = $('#emailAbonne').val();
            var prenom = $('#prenomAbonne').val();
            $.ajax({
                url:"<?= base_url()?>exchange/cancelOrdersAchatFiatCrypto",
                method:'POST',
                data:{
                    request: request,
                    email:email,
                    prenom:prenom
                },
                success: function(data){
                    $('#success_message_achat_cryptoFiat').html('<div class="alert alert-success">La demande a été réjetée avec succès</div>');

                    $('#btn_cancel_order_achat_fiatcrypto').fadeOut(1500);
                    $('#btn_validate_order_achat_fiatcrypto').fadeOut(1500);
                }
            })
        });
    });
</script>
</body>
</html>
