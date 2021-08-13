<div class="content-wrapper pt-5"><!-- Main content -->
    <section class="content mt-5">
        <div class="error-page pb-4">
            <h2 class="headline text-warning mt-5">404</h2>

            <div class="error-content">
                <h3><i class="fas fa-exclamation-triangle text-warning"></i> Oops! La page n'a pas été trouvée !.</h3>

                <p>
                    Nous n'avons pas trouvé la page que vous cherchez.
                    Néamoins, vous pouvez <a href="<?= base_url()?> " title="Reour à la page d'accueil">retourner à la page d'accueil</a> ou essayer d'utliser la zone de recherche.
                </p>

                <form class="search-form">
                    <div class="input-group">
                        <input type="text" name="search" class="form-control" placeholder="Search">

                        <div class="input-group-append">
                            <a type="button" name="submit" class="btn btn-warning" href="<?= base_url()?>"><i class="fas fa-search"></i>
                            </a>
                        </div>
                    </div>
                    <!-- /.input-group -->
                </form>
            </div>
            <!-- /.error-content -->
        </div>
        <!-- /.error-page -->
    </section>
    <!-- /.content -->
</div>