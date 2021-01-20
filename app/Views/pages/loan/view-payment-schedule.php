<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
View Payment Schedule  
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
View Payment Schedule  
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
View Payment Schedule 
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
<div class="card">
    <div class="header">
        <h2>Payment Schedule Detail</h2>
        <div class="row">
            <div class="col-md-6 col-lg-6">
            <div class="body">
                            <table class="table card-table mb-0">
                                <tbody>
                                    <tr>
                                        <td class="font-weight-bold">Full Name</td>
                                        <td class="text-right">ci</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Bank</td>
                                        <td class="text-right"><?= $schedule->bank_name ?? '' ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Account No.</td>
                                        <td class="text-right"><?= $schedule['account_no'] ?? '' ?></span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Payable Date</td>
                                        <td class="text-right">date</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Branch</td>
                                        <td class="text-right"><?= $schedule->branch ?? '' ?></span>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
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
