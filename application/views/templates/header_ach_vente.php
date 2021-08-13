<?php
$session_data = $this->session->userdata('fiato_logged_in');

$data['id_abonne'] = $session_data['id_abonne'];
//$data['email_abonne'] = $session_data['email_abonne'];
$data['prenom_abonne'] = $session_data['prenom_abonne'];
$data['nom_abonne'] = $session_data['nom_abonne'];
$data['role_utilisateur'] = $session_data['role_utilisateur'];
$data['photo_abonne'] = $session_data['photo_abonne'];

?>
<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="fr-fr" data-website-id="1" data-oe-company-name="FIATOBTC">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="mobile-web-app-capable" content="yes"/>
    <meta name="generator" content="<?= $title_page; ?>"/>
    <meta name="description" content="<?= $description; ?>"/>
    <meta name="keywords" content="<?= $keywords ?>"/>

    <!--<meta name="google-site-verification" content="pgjyH0qvN69B0m_HrTKV6h8TVnbRXp5etEHo19unPy4"/>
    -->

    <title><?= $title_page; ?> | <?= $title; ?></title>
    <link type="image/x-icon" rel="shortcut icon" href="<?= base_url() ?>assets/img/core/faveicon.ico"/>
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- flag-icon-css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/3.3.0/css/flag-icon.min.css">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/adminlte.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>assets/css/fiatobtcStyle.css">


    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

    <!-- Toastr -->
    <link rel="stylesheet" href="<?= base_url() ?>assets/plugins/toastr/toastr.min.css">
    <!-- Theme style -->
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
        .color-palette {
            height: 35px;
            line-height: 35px;
            text-align: right;
            padding-right: .75rem;
        }

        .color-palette.disabled {
            text-align: center;
            padding-right: 0;
            display: block;
        }

        .color-palette-set {
            margin-bottom: 15px;
        }

        .color-palette span {
            display: none;
            font-size: 12px;
        }

        .color-palette:hover span {
            display: block;
        }

        .color-palette.disabled span {
            display: block;
            text-align: left;
            padding-left: .75rem;
        }

        .color-palette-box h4 {
            position: absolute;
            left: 1.25rem;
            margin-top: .75rem;
            color: rgba(255, 255, 255, 0.8);
            font-size: 12px;
            display: block;
            z-index: 7;
        }

        .fiatobtc-theme-main {
            background-color: #273c75;
            color: white;
        }

        .fiatobtc-second-theme {
            background-color: #0572AD;
            color: white;
        }

        #div-social i {
            color: white;
            transition: all ease-in-out .4s;
        }

        #div-social i:hover {
            color: red;
            transform: scale(1.1);
        }

        .div-footer-top h1, p {
            transition: all ease-in-out .6s;
        }

        .div-footer-top h1:hover {
            transform: scale(1.1);
        }

        .div-footer-top p:hover {
            transform: scale(1.1);
        }

        <!--
        a.gflag {
            vertical-align: middle;
            font-size: 16px;
            padding: 1px 0;
            background-repeat: no-repeat;
            background-image: url(//gtranslate.net/flags/16.png);
        }

        a.gflag img {
            border: 0;
        }

        a.gflag:hover {
            background-image: url(//gtranslate.net/flags/16a.png);
        }

        #goog-gt-tt {
            display: none !important;
        }

        .goog-te-banner-frame {
            display: none !important;
        }

        .goog-te-menu-value:hover {
            text-decoration: none !important;
        }

        body {
            top: 0 !important;
        }

        #google_translate_element2 {
            display: none !important;
        }

        -->
    </style>
</head>

<body class="hold-transition sidebar-collapse layout-top-nav">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark elevation-2 fixed-top"
         style="background-color: #273c75; border-color:#192a56;">
        <div class="container">
            <a href="<?= base_url() ?>" class="navbar-brand" title="Page d'accueil FIATOBTC">
                <img src="<?= base_url() ?>assets/img/core/FiatoBTcLogo.png" alt="FIATOBTC Logo"
                     class="brand-image img-circle elevation-3"
                     style="opacity: .8; background-color: #192a56">
                <span class="brand-text font-weight-bold">FIATOBTC</span>
            </a>
            <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
                            <i class="fas fa-bars"></i></a>
                    </li>
                    <?php if ($data['id_abonne']): ?>
                        <li class="nav-item">
                            <a href="<?= base_url() ?>buying" class="nav-link"
                               title="Acheter les crypto monaies contre du Fiat ">ACHETER</a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link exchangeNonDispo"
                               title="Vendre les crypto monnaies contre du Fiat">VENDRE</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="#" class="nav-link operationAchatVente"
                               title="Vous dévez vous connecter ou vous inscrire ">ACHETER</a>
                        </li>
                        <li class="#" class="nav-link">
                            <a href="#" class="nav-link exchangeNonDispo"
                               title="Vous dévez vous connecter ou vous inscrire">VENDRE</a>
                        </li>
                    <?php endif; ?>

                    <li class="nav-item dropdown">
                        <a class="nav-link" data-toggle="dropdown" href="#">
                            ECHANGER &nbsp;<i class="fa fa-chevron-down"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-md-left p-0 bg-gradient-gray">
                            <a href="<?= base_url() ?>exchange/cryptoTofiat" class="dropdown-item"
                               title="Echanger les crypto-monnaies contre le fiat">Cryptos contre Fiat</a>
                            <span class="dropdown-divider"></span>
                            <a href="<?= base_url() ?>exchange/fiatTocrypto" class="dropdown-item"
                               title="Echanger les crypto-monnaies contre le fiat">Fiat contre Cryptos</a>
                            <div>
                    </li>
                </ul>
            </div>

            <ul class=" order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                <!-- Notifications Dropdown Menu -->
                <li class="nav-item dropdown">
                    <?php if ($data['id_abonne'] && $data['role_utilisateur'] != 'abonne'): ?>
                        <a class="nav-link dropdown-toggle-count" data-toggle="dropdown" href="#" title="Notifications">
                            <i class="far fa-bell dropdown-toggle-count"></i>
                            <span class="badge badge-danger navbar-badge count"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right dropdown-menu-js">
                            <span class="dropdown-header count">  Notifications</span>
                            <div class="dropdown-divider"></div>
                        </div>
                    <?php endif; ?>
                </li>
                <?php if ($data['id_abonne']): ?>
                    <li class="nav-item">
                        <a href="<?= base_url() ?>register/myaccount" class="nav-link" title="Gérer votre compte">

                            <img src="<?= base_url() ?>assets/img/users/<?= $data['photo_abonne']; ?>"
                                 alt="<?= $data['prenom_abonne']; ?>"
                                 class="brand-image img-circle elevation-2"
                                 style="opacity: .8; background-color: white">
                        </a>
                    </li>
                <?php endif; ?>
                <!--  Langues  -->
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="flag-icon flag-icon-fr"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right p-0">
                        <a href="#" class="dropdown-item active" onclick="doGTranslate('fr|fr'); return false;">
                            <i class="flag-icon flag-icon-fr mr-2"></i> Français
                        </a>
                        <a href="#" class="dropdown-item" onclick="doGTranslate('fr|en'); return false;">
                            <i class="flag-icon flag-icon-us mr-2"></i> English
                        </a>
                        <a href="#" class="dropdown-item" onclick="doGTranslate('fr|gr'); return false;">
                            <i class="flag-icon flag-icon-de mr-2"></i> German
                        </a>
                        <a href="#" class="dropdown-item" onclick="doGTranslate('fr|sw'); return false;">
                            <i class="flag-icon flag-icon-cd mr-2"></i> Kiswahili
                        </a>
                    </div>
                </li>
                &nbsp;&nbsp;

                <!--  STATUT DE COMMANDES DE VENTE ET ACHATS  -->
                <?php if ($data['id_abonne'] && $data['role_utilisateur'] != 'abonne'): ?>
                    <li class="nav-item dropdown dropdown-toggle-count-vente">
                        <a class="nav-link dropdown-toggle-count-vente" data-toggle="dropdown" href="#">
                            <i class="far fa-comments"></i>
                            <span class="badge badge-danger navbar-badge count-vente"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right dropdown-menu-vente">

                        </div>
                    </li>
                <?php endif; ?>

                <!-- Right navbar links -->
                <div class="collapse navbar-collapse order-1 order-lg-3 navbar-nav navbar-no-expand ml-auto"
                     id="navbarCollapse">
                    <ul class="navbar-nav">
                        <?php if (empty($data['id_abonne'])): ?>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>register" class="nav-link"
                                   title="Inscrivez-vous pour commencer les achats et ventes de cripto monnaies">S'INSCRIRE</a>
                            </li>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>pages/connexion" class="nav-link" title="Connectez-vous">SE
                                    CONNECTER</a>
                            </li>
                        <?php else : ?>
                            <li class="nav-item">
                                <a href="<?= base_url() ?>register/myaccount" class="nav-link"
                                   title="Gérer votre compte"><?= ucfirst($data['prenom_abonne']); ?>
                                </a>
                            </li>
                        <?php endif ?>
                    </ul>
                </div>
                <a class="navbar-toggler order-1" type="button" data-widget="pushmenu" href="#" role="button"
                   title="Menu">
                    <span class="navbar-toggler-icon"></span>
                </a>
            </ul>
        </div>
    </nav>
    <!-- /.navbar -->
    <!-- Main Sidebar Container -->
   <aside class="main-sidebar sidebar-dark-white elevation-4x " style="background-color: #192a56">
        <!-- Brand Logo -->
        <a href="<?= base_url()?>" class="brand-link">
            <img src="<?= base_url() ?>assets/img/core/FiatoBTcLogo.png" alt="FIATOBTC Logo"
                 class="brand-image img-circle elevation-3"
                 style="opacity: .8">
            <span class="brand-text font-weight-light">FIATOBTC</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <?php if($data['id_abonne']):?>
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img style="background-color: gray;" src="<?= base_url() ?>assets/img/users/<?=$data['photo_abonne'];?>" alt="<?= $data['prenom_abonne'];?>" class="img-circle elevation-2">
                </div>
                <div class="info">
                    <a href="<?= base_url()?>register/myaccount" class="d-block"><?= ucfirst($data['prenom_abonne']). '  '.ucfirst($data['nom_abonne']);?></a>
                </div>
            </div>
            <?php else:?>
            <?php endif;?>

            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                    data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                         with font-awesome or any other icon font library -->
                    <?php if($data['id_abonne'] && $data['role_utilisateur'] != 'abonne'):?>   
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">

                             

                              <li class="nav-item">
                                <a href="<?= base_url()?>products" class="nav-link" title="Produits">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Produits</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="<?= base_url()?>register/fetchAbonnes" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Abonnés</p>
                                </a>
                              </li>
                              <li class="nav-item has-treeview">
                                 <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-chart-pie"></i>
                                <p>
                                    Echange
                                    <i class="right fas fa-angle-right"></i>
                                </p>
                             </a>
                             <ul class="nav nav-treeview">
                                

                                <li class="nav-item has-treeview">
                                    <a href="<?= base_url()?>#" class="nav-link">
                                        <i class="fas fa-check nav-icon text-success"></i>
                                        <p>Ordres de ventes</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url() ?>exchange/fetchCryptoFiat" class="nav-link" title="Exchange">
                                            <i class="fas fa-chec nav-icon"></i>
                                                <p>Crypto vs. Fiat</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url() ?>exchange/fetchFiatCrypto" class="nav-link" title="Exchange">
                                                <i class="fas fa-chec nav-icon"></i>
                                                <p>Fiat vs. Crypto</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="<?= base_url()?>#" class="nav-link">
                                        <i class="fas fa-check nav-icon text-success"></i>
                                        <p>Ordres d'achat</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url() ?>exchange/fetchOrdersAchatCryptoFiat" class="nav-link" title="Exchange">
                                            <i class="fas fa-chec nav-icon"></i>
                                                <p>Crypto vs. Fiat</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url() ?>exchange/fetchOrdersAchatFiatCrypto" class="nav-link" title="Exchange">
                                                <i class="fas fa-chec nav-icon"></i>
                                                <p>Fiat vs. Crypto</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                             </ul>
                            </li>
                              <li class="nav-item">
                                <a href="<?= base_url()?>buying/fetchAll" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Achats</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="#" class="nav-link exchangeNonDispo">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Ventes</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="<?= base_url()?>buying/fechAllBonus" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Bonus</p>
                                </a>
                              </li>
                              <li class="nav-item">
                                <a href="<?= base_url()?>buying/fechAllFidelity" class="nav-link">
                                  <i class="far fa-circle nav-icon"></i>
                                  <p>Fidélité</p>
                                </a>
                              </li>
                            </ul>
                        </li>

                    <li class="nav-item has-treeview menu-open">
                    <?php endif;?>
                    <?php if($data['id_abonne']):?> 

                    <li class="nav-item has-treeview">
                        <a href="#" class="nav-link exchangeNonDispo">
                            <i class="nav-icon fas fa-check text-danger"></i>
                            <p>
                                Vendre
                                <i class="right"></i>
                            </p>
                        </a>
                    </li>
                    <li class="nav-item has-treeview">
                        <a href="<?= base_url()?>buying" class="nav-link ">
                            <i class="nav-icon fas fa-check text-warning"></i>
                            <p>
                                Acheter
                                <i class="right"></i>
                            </p>
                        </a>
                    </li>
                      <li class="nav-item has-treeview">
                            <a href="<?= base_url()?>#" class="nav-link">
                                <i class="fas fa-check nav-icon text-success"></i>
                                <p>Echanger</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>exchange/cryptoTofiat" class="nav-link" title="Exchange">
                                    <i class="fas fa-chec nav-icon"></i>
                                        <p>Crypto vs. Fiat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>exchange/fiatTocrypto" class="nav-link" title="Exchange">
                                        <i class="fas fa-chec nav-icon"></i>
                                        <p>Fiat vs. Crypto</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php else :?>
                        <li class="nav-item has-treeview">
                        <a href="#" class="nav-link exchangeNonDispo">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Vendre
                                <i class="right"></i>
                            </p>
                        </a>
                        </li>
                        <li class="nav-item has-treeview">
                        <a href="<?=base_url()?>pages/connexion" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Acheter
                                <i class="right"></i>
                            </p>
                        </a>
                        </li>
                         <li class="nav-item has-treeview">
                            <a href="<?= base_url()?>#" class="nav-link">
                                <i class="fas fa-check nav-icon text-success"></i>
                                <p>Echanger</p>
                                <i class="right fas fa-angle-left"></i>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>exchange/cryptoTofiat" class="nav-link" title="Exchange">
                                    <i class="fas fa-chec nav-icon"></i>
                                        <p>Crypto vs. Fiat</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>exchange/fiatTocrypto" class="nav-link" title="Exchange">
                                        <i class="fas fa-chec nav-icon"></i>
                                        <p>Fiat vs. Crypto</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    <?php endif;?>
                   

                    <?php if ($data['id_abonne']): ?>
                        <li class="nav-item has-treeview">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>
                                    Mon compte
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="<?= base_url() ?>register/myaccount" class="nav-link" title="Produits">
                                        <i class="fas fa-check nav-icon text-success"></i>
                                        <p>Général</p>
                                    </a>
                                </li>
                                <li class="nav-item has-treeview">
                                    <a href="<?= base_url()?>exchange/myCryptorders" class="nav-link">
                                        <i class="fas fa-check nav-icon text-success"></i>
                                        <p>Ordres d'échange</p>
                                        <i class="right fas fa-angle-left"></i>
                                    </a>
                                    <ul class="nav nav-treeview">
                                        <li class="nav-item">
                                            <a href="<?= base_url() ?>exchange/myCryptorders" class="nav-link" title="Exchange">
                                            <i class="fas fa-chec nav-icon"></i>
                                                <p>Crypto vs. Fiat</p>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="<?= base_url() ?>exchange/myCryptorders" class="nav-link" title="Exchange">
                                                <i class="fas fa-chec nav-icon"></i>
                                                <p>Fiat vs. Crypto</p>
                                            </a>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item has-treeview">
                            <a onclick="return confirm('Etes-vous sûr de vous déconnecter ?');"
                               href="<?= base_url() ?>pages/logout" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    Se déconnecter
                                    <i class="right"></i>
                                </p>
                            </a>
                        </li>

                    <?php else : ?>
                        <li class="nav-item has-treeview">
                            <a href="<?= base_url() ?>register" class="nav-link">
                                <i class="nav-icon fas fa-tree"></i>
                                <p>
                                    S'inscrire
                                    <i class="right"></i>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item has-treeview">
                            <a href="<?= base_url() ?>pages/connexion" class="nav-link">
                                <i class="nav-icon fas fa-edit"></i>
                                <p>
                                    Se connecter
                                    <i class="right"></i>
                                </p>
                            </a>
                        </li>

                    <?php endif; ?>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
</div>
