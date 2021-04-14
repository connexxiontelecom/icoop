<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Profit/Loss 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Profit/Loss 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Profit/Loss
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <style>
        td.details-control {
            background: url('assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('assets/images/details_close.png') no-repeat center center;
        }
    </style>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Profit/Loss</h2>
            </div>
            <a href="<?= site_url('/add-new-chart-of-account') ?>" class="btn btn-sm btn-primary float-right mb-3">Add New Account</a>
            <div class="body">
                <div class="col-xs-12 col-sm-12">

                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

<?= $this->endSection() ?>
