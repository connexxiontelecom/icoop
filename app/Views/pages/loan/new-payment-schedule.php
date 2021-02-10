<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Payment Schedule (Member)
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Payment Schedule (Member) 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Payment Schedule (Member) 
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
<link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.min.css" rel="stylesheet">
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>Payment Schedule (Member)</h2>
            </div>
            <div class="body">
                
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                <form  action="<?= site_url('/loan/new-payment-schedule') ?>" autocomplete="off" method="POST" data-parsley-validate="">
                        <?= csrf_field() ?>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th colspan="7">
                                                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" type="button">Select Payment</button>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td colspan="7">
                                            <div class="row">
                                                 <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Date</label>
                                                            <input type="date" required name="payable_date" id="payable_date" placeholder="dd-mm-yyy" class=" form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="">Bank</label>
                                                            <select required name="bank" id="bank" class="form-control ">
                                                                <option selected disabled>--Select bank--</option>
                                                                <?php foreach($coopbank as $bank) : ?>
                                                                    <option value="<?= $bank->bank_id ?>"><?= $bank->bank_name ?? '' ?> - (<?= $bank->account_no ?? '' ?>)</option>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                        </td>
                                    </tr>
                                        <tr class="bg-info">
                                            <td class="text-nowrap">S/No</td>
                                            <td>Member ID</td>
                                            <td>Beneficiary</td>
                                            <td>Account No.</td>
                                            <td>Loan Type</td>
                                            <td>Amount</td>
                                            <td>Action</td>
                                        </tr>
                                        <?= csrf_field() ?>
                                        
                                            <?php $i = 1; $sum = 0; foreach($cart as $car) : ?>
                                                <tr>
                                                    <td>
                                                        <?= $i++ ?>
                                                    </td>
                                                    <td>
                                                        <?= $car->cooperator_staff_id  ?? '' ?>
                                                        <input type="hidden" name="loan_id[]" value="<?= $car->loan_id ?? '' ?>" >
                                                    </td>
                                                    <td>
                                                        <?= $car->cooperator_first_name ?? '' ?> <?= $car->cooperator_last_name ?? '' ?>
                                                        <input type="hidden" name="coop_id[]" value="<?= $car->cooperator_staff_id ?? '' ?>">
                                                    </td>
                                                    <td><?= $car->bank_name ?? '' ?> - <?= $car->cooperator_account_number ?? '' ?></td>
                                                    <td> <?= $car->loan_description ?? '' ?> </td>
                                                    <td class="text-right"> <?= '₦'.number_format($car->amount,2) ?> 
                                                        <input type="hidden" name="amount[]" <?= $sum += $car->amount ?? 0 ?> value="<?= $car->amount ?? 0 ?>">
                                                        <input type="hidden" name="loan_type[]" value="<?= $car->loan_type ?? '' ?>">
                                                    </td>
                                                    <td> 
                                                        <a href="<?= site_url('/loan/remove-from-cart/'.$car->loan_id) ?>" title="Remove from cart" class="text-danger"><i class="fa fa-trash"></i></a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                            <tr>
                                                <td colspan="5" class="text-right"><strong>Total:</strong></td>
                                                <td class="text-right"><?= '₦'.number_format($sum,2) ?></td>
                                            </tr>
                                            <?php if(count($cart)): ?>
                                            <tr>
                                                <td colspan="7">
                                                    <button type="submit" class="btn btn-sm btn-primary float-right">Add Schedule</button>
                                                </td>
                                            </tr>
                                            <?php endif; ?>
                                       
                                        
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
 <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title h4" id="myLargeModalLabel">Payment Schedule</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row clearfix">
                    <div class="col-lg-12 col-md-12">
                        <form  action="<?= site_url('/loan/add-payment-to-cart') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="addToCartForm">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-12">
                                <label for="">Payment to Disburse</label>
                                <table width="100%" class="table table-stripped">
                                    <tr class="bg-info">
                                        <th >#</th>
                                        <th >Staff ID</th>
                                        <th >Full Name</th>
                                        <th >Loan Type</th>
                                        <th >Amount</th>
                                    </tr>
                                    <tr>
                                        <td colspan="6"><strong>Loan applications...</strong></td>
                                    </tr>
                                    <?php if(count($approved_loans) > 0) : ?>
                                        <?php foreach($approved_loans as $loan): ?>
                                        
                                            <tr>
                                                <th scope="row"> 
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" name="approved_loans[]" value="<?= $loan->loan_app_id ?>" class="form-check-input ml-2">
                                                    </div>
                                                </th>
                                                <td><?= $loan->staff_id ?>
                                                    <input type="hidden" name="coop_id[]" value="<?= $loan->staff_id ?>">
                                                    <input type="hidden" name="loan_id[]" value="<?= $loan->loan_id ?>">
                                                </td>
                                                <td><?= $loan->cooperator_first_name ?? '' ?> <?= $loan->cooperator_last_name ?? '' ?></td>
                                                <td>
                                                    <?= $loan->loan_description ?? '' ?> 
                                                    <input type="hidden" name="loan_type[]" value="">
                                                </td>
                                                <td>
                                                    ₦<?= number_format($loan->amount ?? 0,2) ?>
                                                    <input type="hidden" name="amount[]" value="<?= $loan->amount ?? 0 ?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                            <tr>
                                            <td colspan="6">
                                            <p>There's no current loan application.</p>
                                            </td>
                                            </tr>
                                    <?php endif ?>
                                    <tr>
                                        <td colspan="6"><strong>Withdraw applications...</strong></td>
                                    </tr>
                                    <?php if(count($withdraws) > 0) : ?>
                                        <?php foreach($withdraws as $withdraw): ?>
                                            <tr>
                                                <th scope="row"> 
                                                    <div class="form-group form-check">
                                                        <input type="checkbox" name="withdraws[]" class="form-check-input ml-2">
                                                    </div>
                                                </th>
                                                <td><?= $withdraw->withdraw_staff_id ?>
                                                    <input type="hidden" name="withdraw_staff_id[]" value="<?= $withdraw->withdraw_staff_id ?>">
                                                    <input type="hidden" name="withdraw_id[]" value="<?= $withdraw->withdraw_id ?>">
                                                </td>
                                                <td><?= $withdraw->cooperator_first_name ?? '' ?> <?= $withdraw->cooperator_last_name ?? '' ?></td>
                                                <td>
                                                    <?= $withdraw->withdraw_narration ?? '' ?> 
                                                    <input type="hidden" name="loan_type[]" value="">
                                                </td>
                                                <td>
                                                    ₦<?= number_format($withdraw->withdraw_amount ?? 0,2) ?>
                                                    <input type="hidden" name="withdraw_amount[]" value="<?= $withdraw->withdraw_amount ?? 0 ?>">
                                                </td>
                                                <td>
                                                    ₦<?= number_format($withdraw->withdraw_amount ?? 0,2) ?>
                                                    <input type="hidden" name="withdraw_amount[]" value="<?= $withdraw->withdraw_amount ?? 0 ?>">
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else : ?>
                                            <tr>
                                            <td colspan="6">
                                            <p>There's no current withdraw application.</p>
                                            </td>
                                            </tr>
                                    <?php endif; ?>
                                    <?php if( count($withdraws) > 0  || count($approved_loans) > 0 ) : ?>
                                        <tr>
                                            <td colspan="6">
                                                <button type="submit" class="btn btn-sm btn-primary float-right">Add to Cart</button>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </div>
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
<script src="/assets/js/parsley.min.js"></script>
<script>
$(document).ready(function(){
     $('#addToCartForm').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
        })
        .on('form:submit', function() {
            return true; 
        });
});
</script>
<?= $this->endSection() ?>
