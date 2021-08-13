<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper ">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container mt-5">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="mt-2">Ordres d'achats de Fiat Contre Crypto</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                        </li>
                    </ol>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container">
            <h5 class="mb-2">Boite d'infos</h5>
            <div class="row">

                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="fa fa-check"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Traitées</span>
                            <span class="info-box-number"><?= $traitees;?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">En cours</span>
                            <span class="info-box-number"><?= $encours;?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-danger"><i class="far fa-envelope"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Rejétées</span>
                            <span class="info-box-number"><?= $cancel;?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-primary"><i class="far fa-star"></i></span>
                        <div class="info-box-content">
                            <span class="info-box-text">Total</span>
                            <span class="info-box-number"><?= $total;?></span>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Hash Acheteur</th>
                                    <th>Produit</th>
                                    <th>Quantité Achetée</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($commandes as $row):?>
                                    <tr>
                                        <td>
                                            <img src="<?= base_url()?>assets/img/users/<?= $row->photo_abonne ?>" class="img-circle img-thumbnail" style="width: 50px; height: 50px">
                                        </td>
                                        <td><?= date('d M  Y', strtotime($row->date_envoi_cbe)) ?></td>
                                        <td><?= $row->hashAcheteur ?></td>
                                        <td><?= $row->product ?></td>
                                        <td><?= $row->qte_totale ?></td>
                                      
                                        <?php if($row->statut_buy_exchange=='process'):?>
                                            <td class="text-warning">En cours</td>
                                        <?php elseif($row->statut_buy_exchange=='cancel') :?>
                                            <td class="text-danger">Rejeté</td>
                                        <?php elseif($row->statut_buy_exchange=='confirm') :?>
                                            <td class="text-success">Accepté</td>
                                        <?php endif;?>

                                        <td><a href="<?= site_url('exchange/detailOrdersAchatFiatCrypto/'.$row->id_buying)?>" class="btn btn-sm btn-info">Détails</a></td>
                                    </tr>
                                <?php endforeach;?>
                                </tbody>
                                <tfoot>
                                  <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Hash Acheteur</th>
                                    <th>Produit</th>
                                    <th>Quantité Achetée</th>
                                    <th>Status</th>
                                    <th></th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
</div>
<!-- /.row -->
</div><!-- /.container-fluid -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->