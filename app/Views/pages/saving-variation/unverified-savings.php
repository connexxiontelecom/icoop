<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    Verify Saving Variations 
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   Verify Saving Variations 
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
    Verify Saving Variations 
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/vendor/sweetalert/sweetalert.css"/>
    <link rel="stylesheet" href="/assets/css/toastify.min.css"/>
    <link rel="stylesheet" href="/assets/css/datatable.min.css"/>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-body">
            <div class="row m-b-30">
                <div class="col-lg-12 col-md-12 col-xl-12">
                    <h6 class="sub-title p-3  text-uppercase">Verify Saving Variations </h6>
                    <div class="table-responsive">
                <table class="table table-hover table-bordered" id="scheduledPaymentTable">
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>Customer Name</td>
                            <td>Amount</td>
                            <td>Date</td>
                            <td>Action</td>
                        </tr>
                    </thead>                   
                    <tbody>
                        <?php $i=1; foreach($unverified_savings as $us) : ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $us->cooperator_first_name ?></td>
                                <td><?= number_format($us->sv_amount,2) ?></td>
                                <td>-</td>
                                <td>-</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                    </tfoot>
                </table>
            </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
   <script src="/assets/bundles/vendorscripts.bundle.js"></script>

<script src="/assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="/assets/js/common.js"></script>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/toastify.min.js"></script>
    <script src="/assets/js/datatables.min.js"></script>
<script>
$(document).ready(function(){
    $('#scheduledPaymentTable').DataTable();
});
</script>
<?= $this->endSection() ?>
