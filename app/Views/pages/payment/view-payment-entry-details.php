<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
View Payment Entry Details
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
View Payment Entry Details
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
View Payment Entry Details
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
                <h2>View Payment Entry Details</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                    <form action="javascript:void(0);" method="post" autocomplete="off">
                        <?= csrf_field() ?>
                        
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th colspan="4"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-nowrap" width="150">Bank Name</td>
                                        <td><strong><?= $entry->bank_name ?? '' ?> </strong></td>
                                        <td class="text-nowrap">Amount</td>
                                        <td><strong>  <?= number_format($entry->entry_amount,2) ?? '' ?></strong></td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Account No.</td>
                                        <td><strong>  <?= $entry->account_no ?? '' ?></strong></td>
                                        <td class="text-nowrap">Reference No.</td>
                                        <td><strong>  <?= $entry->entry_reference_no ?? '' ?></strong></td>                                    
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Branch</td>
                                        <td><strong>  <?= $entry->branch ?? '' ?></strong></td>
                                        <td class="text-nowrap">Payment Date</td>
                                        <td><strong><?= date('d M, Y', strtotime($entry->entry_payment_date)) ?></strong></td>
                                    </tr>                                  
                                    <tr>
                                        <td class="text-nowrap">Sort Code</td>
                                        <td><strong><?= $entry->sort_code ?? '' ?></strong></td>
                                        <td class="text-nowrap">Attachment</td>
                                        <td>
                                            <?php if(!is_null($entry->entry_attachment)) : ?>
                                                <a href="/assets/uploads/withdrawals/<?= $entry->entry_attachment ?>" target="_blank" ><strong>Download Attachment</strong></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>                                    
                                    <tr>
                                        <td class="text-nowrap">Narration</td>
                                        <td><strong><?= $entry->entry_narration ?? '' ?></strong></td>
                                    </tr>                                    
                                </tbody>
                            </table>
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
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
    
<?= $this->endSection() ?>
