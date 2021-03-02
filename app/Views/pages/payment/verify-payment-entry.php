<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Verify Payment Entry
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Verify Payment Entry
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Verify Payment Entry 
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
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Verify Payment Entry</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="table-responsive">
                    <table class="table table-bordered dataTable js-exportable simpletable" id="stateTable">
                        
                        <tr>
                            <th>#</th>
                            <th>Bank Name</th>
                            <th>Amount</th>
                            <th>Reference No.</th>
                            <th>Date</th>
                            <th>Sort Code</th>
                            <th>Action</th>
                        </tr>

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
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
    
<?= $this->endSection() ?>
