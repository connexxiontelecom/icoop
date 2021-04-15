<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Balance Sheet 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Balance Sheet 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Balance Sheet
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
                <h2>Balance Sheet</h2>
            </div>
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <form action="<?= site_url('/balance-sheet') ?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-sm-12 col-md-8 col-lg-8">
                                <div class="input-group mb-3 ml-5">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">From</span>
                                    </div>
                                    <input type="date" name="from" class="form-control" aria-label="From">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">To</span>
                                    </div>
                                    <input type="date" name="to" class="form-control" aria-label="To">
                                    <button class="btn  btn-primary" type="submit">Submit</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>

<?= $this->endSection() ?>
