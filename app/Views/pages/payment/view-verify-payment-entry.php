<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
View Payment Entry
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
View Payment Entry
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
View Payment Entry 
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
                <h2>View Payment Entry</h2>
            </div>
            <div class="body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                    <form action="<?= $entry_master->entry_payment_verified == 0  ? site_url('/third-party/view-verify-payment-entry') : site_url('/third-party/approved-payment-entry') ?>" method="post" autocomplete="off">
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
                                        <td><strong><?= $entry_master->bank_name ?? '' ?> </strong></td>
                                        <td class="text-nowrap">Amount</td>
                                        <td><strong>  <?= number_format($entry_master->entry_payment_amount,2) ?? '' ?></strong></td>
                                    
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Account No.</td>
                                        <td><strong>  <?= $entry_master->account_no ?? '' ?></strong></td>
                                        <td class="text-nowrap">Reference No.</td>
                                        <td><strong>  <?= $entry_master->entry_payment_cheque_no ?? '' ?></strong></td>                                    
                                    </tr>
                                    <tr>
                                        <td class="text-nowrap">Branch</td>
                                        <td><strong>  <?= $entry_master->branch ?? '' ?></strong></td>
                                        <td class="text-nowrap">Payment Date</td>
                                        <td><strong><?= date('d-m-Y', strtotime($entry_master->entry_payment_payable_date)) ?? '' ?></strong></td>
                                    </tr>                                  
                                    <tr>
                                        <td class="text-nowrap">Sort Code</td>
                                        <td><strong><?= $entry_master->sort_code ?? '' ?></strong></td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12">
                        <div class="header">
                            <h2>Payment Entry Details</h2>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <td>S/No</td>
                                        <td>Payee Name</td>
                                        <td>Payee Bank</td>
                                        <td>Reference No.</td>
                                        <td>Payable Date</td>
                                        <td>Payment Amount</td>
                                        <td>Action</td>
                                    </tr>
                                    <?php $serial = 1; $sum = 0; foreach($entry_detail as $d) : ?>
                                        <tr>
                                            <td><?= $serial++ ?></td>
                                            <td><?= $d->entry_payment_d_payee_name ?? '' ?></td>
                                            <td>
                                                <?= $d->entry_payment_d_payee_bank ?? '' ?>
                                            </td>
                                            <td><?= $d->entry_payment_d_reference_no ?? '' ?> </td>
                                            <td><?= date('d F, Y', strtotime($d->entry_payment_payable_date)) ?? '' ?> </td>
                                            <td class="text-right"><?= number_format($d->entry_payment_d_amount,2) ?? '' ?> </td>
                                            <input type="hidden" name="sum" value="<?= $sum += $d->entry_payment_d_amount ?? 0?>">
                                            <input type="hidden" name="entry_master" value="<?= $d->entry_payment_master_id ?? ''  ?>">
                                            <td><a href="= site_url('/loan/return-schedule-payment/'.$d->loan_id) ?>">Return</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td colspan="6" class="text-right">
                                            <strong>Total:</strong>
                                        </td>
                                        <td><?= '₦'.number_format($sum,2) ?></td>
                                    </tr>
                                   
                                    <tr>
                                        <td colspan="7">
                                            <div class="form-group">
                                                <label for="">Date</label>
                                                <input type="date" name="date_verified" required placeholder="dd-mm-yyyy" class="form-control col-md-4">
                                                
                                            </div>
                                             <?php if(count($entry_detail) > 0) : ?>
                                                    <div class="d-flex justify-content-center">
                                                        <?php if($entry_master->entry_payment_verified == 0) : ?>
                                                            <div class="btn-group">
                                                                <button class="btn btn-danger btn-sm" type="submit" >Return Entry</button>
                                                                <button class="btn btn-primary btn-sm text-right"  type="submit">Verify Entry</button>
                                                            </div>

                                                        <?php else : ?>
                                                            <div class="btn-group">
                                                                <button class="btn btn-danger btn-sm" type="submit" >Return Entry</button>
                                                                <button class="btn btn-primary btn-sm text-right"  type="submit">Approve Entry</button>
                                                            </div>
                                                        <?php endif; ?>
                                                   </div>
                                             <?php endif; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        </div>
                            
                        </form>
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
