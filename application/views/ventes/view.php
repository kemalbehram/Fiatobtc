<div class="hold-transition login-page">
<div class="login-box">
    <div class="login-logo">
        <a title="Page d'accueil" href="<?=base_url()?>"><b>FiaTo</b>BTC</a>
    </div>
    <!-- /.login-logo -->

    <div class="card">
        <div class="card-header text-center">
                    <h1>Vendez avec crypto-monnaie</h1>
                    <p style="font-style: italic;">to <strong><?= $marchantname; ?></strong></p>
            </div>
        <div class="card-body login-card-body">
            <form> 
                <label for="amount">Montant (<?= $rcurrency; ?>)</label>
                    <h1><?= $results['amount'] ?> <?= $rcurrency ?></h1>
                    <hr>
                    <a href="<?= $results['status_url'] ?>" class="btn btn-success btn-block" target="_blanc">Vendez Maintenant</a>
            </form>
        </div>
       
    </div>
</div>

</div>