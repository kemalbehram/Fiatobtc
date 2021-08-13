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
<!-- Select2 -->
<script src="<?= base_url() ?>assets/plugins/select2/js/select2.full.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- FiaToBTC App -->
<script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
<script src="<?= base_url() ?>assets/js/demo.js"></script>
<script src="<?= base_url() ?>assets/js/paste.js"></script>

<script type="text/javascript">
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

<script type="text/javascript">
    //FORMULAIRE D'ACHAT
    $(document).ready(function(){

        load_unseen_notificationVentes();
        $('#buying_form').on('submit', function (event) {
            event.preventDefault();
            var quantity = $('#usd_qte').val();
            if(quantity<20){
                alert('La quantité minimale est fixée à 20 USD');
            }else{
                $.ajax({
                url:"<?= base_url()?>buying/createCommand",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                beforeSend:function () {
                    $('#btnSaveCMD').attr('disabled', 'disabled');   
                },
                success:function (data) {
                    if (data.error){
                        if (data.qte_usd_error != ''){
                            $('#qte_usd_error').html(data.qte_usd_error);
                        } else {
                            $('#qte_usd_error').html('');
                        }

                        if (data.frais_commission_error != ''){
                            $('#frais_commission_error').html(data.frais_commission_error);
                        } else {
                            $('#frais_commission_error').html('');
                        }

                        if (data.total_a_payer_error != ''){
                            $('#total_a_payer_error').html(data.total_a_payer_error);
                        } else {
                            $('#total_a_payer_error').html('');
                        }

                        if (data.adresse_btc_error != ''){
                            $('#adresse_btc_error').html(data.adresse_btc_error);
                        } else {
                            $('#adresse_btc_error').html('');
                        }

                        if (data.moyen_paiement_error != ''){
                            $('#moyen_paiement_error').html(data.moyen_paiement_error);
                        } else {
                            $('#moyen_paiement_error').html('');
                        }

                        if (data.id_transaction_error != ''){
                            $('#id_transaction_error').html(data.id_transaction_error);
                        } else {
                            $('#id_transaction_error').html('');
                        }

                        $('#success_message').html('');
                    }
                    if (data.success){
                        $('#success_message').html(data.success);
                        $('#qte_usd_error').html('');
                        $('#frais_commission_error').html('');
                        $('#total_a_payer_error').html('');
                        $('#adresse_btc_error').html('');
                        $('#moyen_paiement_error').html('');
                        $('#id_transaction_error').html('');
                        $('#buying_form')[0].reset();
                        $('#btnSaveCMD').attr('disabled', 'disabled');
                        load_unseen_notificationVentes();
                    }
                    $('#btnSaveCMD').attr('disabled', false);
                }
            });
            }
        });
        
        //Notifications sur les achats
        function load_unseen_notificationVentes(view = '') {
            $.ajax({
                url: "<?= base_url()?>buying/loadVenteAchatNotification",
                method: "POST",
                data: {view: view},
                dataType: "json",
                success: function (data) {
                    $('.dropdown-menu-vente').html(data.notification);
                    if (data.unseen_notification > 0) {
                        $('.count-vente').html(data.unseen_notification);
                    }
                }
            });
        }
        
        $(document).on('click', '.dropdown-toggle-count-vente', function () {
            $('.count-vente').html('');
            load_unseen_notificationVentes('yes');
        })
        /*setInterval(function () {
            load_unseen_notificationVentes();
        },10000);*/


    });
</script>

<script type="text/javascript">
//CONVERTISSEUR VENTE
    $(document).ready(function () {
            var commission=0;
            var total=0;
            var url= "<?= base_url()?>sales/cmd_convert";
            $('#sales_qte_usd').keyup(function(){
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
                            $('#sales_qte_btc').val(data);
                              commission = request * 5.5 / 100;  
                            $('#frais_commission_vente').val(commission);

                            total=parseFloat(request); 
                            $('#total_vente').val(total);
                            }
                        });
                    }else{
                        $('#sales_qte_btc').val('');
                        $('#frais_commission_vente').val('');
                        $('#total_vente').val('');
                    }
                }else{
                $('#sales_qte_btc').val('');
                $('#frais_commission_vente').val('');
                $('#total_a_payer').val('');
           }
           if (request=='') {
            $('#btc_qte').val('');
            $('#frais_commission').val('');
            $('#total_vente').val('');
           }
      });
    });
</script>
<script type="text/javascript">
    //CONVERTISSEUR USD TO BTC
    $(document).ready(function () {
            var url= "<?= base_url()?>buying/usd_btc";
            $('#buying_price').keyup(function(){
                var query= $(this).val();
                if (query != '') {
                    if (query>0) {
                          $.ajax({
                            url:url,
                            method:'POST',
                            data:{
                            query: query
                            },
                            success: function(data){
                            $('#buying_result').val(data); 
                            }
                        });
                    }else{
                        $('#buying_result').val('');
                    }
                }else{
                $('#buying_result').val('');
           }
           if (query=='') {
            $('#buying_result').val('');
           }
      });

        //TEST DE QUANTITE ACHAT
        $('#usd_qte').change(function(){
            var data = $(this).val();
            if (data == ''){
                $('#msg-quantity').html('');
            }
            if (data<20) {
                $('#msg-quantity').html('La quantité minimale est fixée à 20 USD');
            }else
                if(data>10000){
                $('#msg-quantity').html('La quantité maximale est fixée à 10000 USD');
                }
            else{
                $('#msg-quantity').html('');
            }
        });

         //TEST DE QUANTITE VENTE
        $('#sales_qte_usd').change(function(){
            var data = $(this).val();
            if (data == ''){
                $('#msg-quantity').html('');
            }
            if (data<20) {
                $('#msg-quantity').html('La quantité minimale est fixée à 20 USD');
            }else
                if(data>10000){
                $('#msg-quantity').html('La quantité maximale est fixée à 10000 USD');
                }
            else{
                $('#msg-quantity').html('');
            }
        });



    })
</script>

<script type="text/javascript">
    //CONVERTISSEUR USD TO BTC
    $(document).ready(function () {
            var commission=0;
            var total=0;
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

                            if(request <= 1000){
                              commission = request * 10 / 100;  
                            }
                            if (request >= 1001 && request <= 10000) {
                                commission = request * 9.5 / 100;
                            }
                            if (request > 10000) {
                                commission = request * 9 / 100; 
                            }

                            $('#frais_commission').val(commission);

                            total=parseFloat(commission) + parseFloat(request); 
                            $('#total_a_payer').val(total);
                            }
                        });
                    }else{
                        $('#btc_qte').val('');
                        $('#frais_commission').val('');
                        $('#total_a_payer').val('');
                    }
                }else{
                $('#btc_qte').val('');
                $('#frais_commission').val('');
                $('#total_a_payer').val('');
           }
           if (request=='') {
            $('#btc_qte').val('');
            $('#frais_commission').val('');
            $('#total_a_payer').val('');
           }
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
</body>
</html>