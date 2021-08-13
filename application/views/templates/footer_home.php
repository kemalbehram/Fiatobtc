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
<script src="<?= base_url() ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Toastr -->
<script src="<?= base_url() ?>assets/plugins/toastr/toastr.min.js"></script>
<!-- FiaToBTC App -->
<script src="<?= base_url() ?>assets/js/adminlte.min.js"></script>
<script src="<?= base_url() ?>assets/js/demo.js"></script>
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