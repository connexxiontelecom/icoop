<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Approve Payment Entry
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Approve Payment Entry
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Approve Payment Entry 
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
<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<!--<link rel="stylesheet" href="--><?//=site_url() ?><!--assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">-->
<!--<link rel="stylesheet" href="--><?//=site_url() ?><!--assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">-->
<!--<link rel="stylesheet" href="--><?//=site_url() ?><!--assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">-->
<!--<link rel="stylesheet" href="--><?//=site_url() ?><!--assets/vendor/sweetalert/sweetalert.css"/>-->
<!---->
<!--<link rel="stylesheet" href="--><?//=site_url() ?><!--assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">-->
<!--<link rel="stylesheet" href="--><?//=site_url() ?><!--assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">-->
<!--<link rel="stylesheet" href="--><?//=site_url() ?><!--assets/css/toastify.min.css"/>-->

<link rel="stylesheet" type="text/css" href="<?=site_url() ?>assets/css/datatable.min.css">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Approve Payment Entry</h2>
            </div>
            <div class="card-body">
                <div class="row clearfix">
                    <div class="table-responsive">
						<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Bank Name</th>
                            <th>Amount</th>
                            <th>Reference No.</th>
                            <th>Date</th>
                            <th>Sort Code</th>
                            <th>Action</th>
                        </tr>
						</thead>

                        <tbody>
                            <?php $i = 1; foreach($entry_master as $app) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $app->bank_name ?? '' ?></td>
                                    <td class="text-right"><?= number_format($app->entry_payment_amount ?? 0) ?></td>
                                    <td><?= $app->entry_payment_cheque_no ?? '' ?></td>
                                    <td><?= date('d M, Y', strtotime($app->entry_payment_payable_date)) ?> </td>
                                    <td><?= $app->sort_code ?? '' ?> </td>
                                    <td>
                                        <a href="<?= base_url('/third-party/view-verify-payment-entry/'.$app->entry_payment_master_id) ?>" class="btn btn-primary btn-sm">View</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                        </tfoot>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="<?=site_url() ?>assets/bundles/vendorscripts.bundle.js"></script>

<script src="<?=site_url() ?>assets/bundles/datatablescripts.bundle.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="<?=site_url() ?>assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="<?=site_url() ?>assets/js/common.js"></script>
<script src="<?=site_url() ?>assets/js/pages/tables/jquery-datatable.js"></script>
<script src="<?=site_url() ?>assets/js/axios.min.js"></script>
<script src="<?=site_url() ?>assets/js/toastify.min.js"></script>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
<script>
    $('.simpletable').DataTable();

</script>
    
<?= $this->endSection() ?>
