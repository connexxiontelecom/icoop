<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Loan Setup  
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   Loan Setup
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
    Loan Setup
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="<?=site_url() ?>assets/css/parsley.min.css" rel="stylesheet">
    <link href="<?=site_url() ?>assets/css/select2.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="<?=site_url() ?>assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="<?=site_url() ?>assets/css/toastify.min.css"/>
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <div class="container">
                <div class="row m-b-30">
         

                    <div class="col-lg-12 col-xl-12 bg-light">
                        <h6 class="text-primary p-3 sub-title text-uppercase ">Loan Types</h6>
						<a style="float: right" href="<?= base_url('/policy-config/new-loan-setup') ?>" class="btn btn-primary"> <i class="fa fa-plus"></i> New Loan Setup</a>
	
						<div class="table-responsive">
							<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                                    <tr>
										<th scope="col">#</th>
										<th scope="col">Loan Description</th>
										<th scope="col">Qualification Age</th>
										<th scope="col">Min. Credit Limit.</th>
										<th scope="col">Max. Credit Limit.</th>
										<th scope="col">Max. Repayment Periods</th>
										<th scope="col">Interest Rate</th>
										<th scope="col">Interest Method</th>
										<th scope="col">Status</th>
										<th scope="col">Payable</th>
										<th scope="col">Loan GL Account No.</th>
										<th scope="col">Loan Unearned Int. GL Account No.</th>
										<th scope="col">Loan Int. Income GL Account No.</th>
										<th scope="col">Loan Terms</th>
										<th scope="col">Action</th>
                                    </tr>
                                <tbody>
                                <?php $serial = 1; ?>
                                <?php foreach($loansetups as $setup) : ?>
                                    <tr>
                                        <td scope="col"><?= $serial++ ?></td>
                                        <td scope="col"><?= $setup->loan_description ?></td>
                                        <td scope="col"><?= $setup->age_qualification ?> month(s)</td>
                                        <td scope="col" class="text-right"><?= number_format($setup->min_credit_limit,2) ?></td>
                                        <td scope="col" class="text-right"><?= number_format($setup->max_credit_limit,2) ?></td>
                                        <td scope="col"><?= $setup->max_repayment_periods ?></td>
                                        <td scope="col"><?= $setup->ls_interest_rate ?>%</td>
                                        <td scope="col"><?php if($setup->interest_method == 1){ echo "Flat"; }else if($setup->interest_method == 2){ echo "Monthly"; }else{ echo "Yearly"; }?></td>
                                        <td scope="col"><?= $setup->status == 1 ? 'Active' : 'Blocked' ?></td>
                                        <td scope="col"><?= $setup->payable == 1 ? 'Cash' : 'Vendor' ?></td>
                                        <td scope="col"><?= $setup->loan_gl_account_no ?> - <?= $setup->account_name ?? '' ?></td>
                                        <td scope="col"><?= $setup->loan_unearned_int_gl_account_no ?> - <?= $setup->account_name ?? '' ?></td>
                                        <td scope="col"><?= $setup->loan_int_income_gl_account_no ?> - <?= $setup->account_name ?? '' ?></td>
                                        <td scope="col"><?= $setup->loan_terms ?></td>
                                        <td>
                                            <a href="javascript:void(0);" data-toggle="modal" data-target="#loanSetup<?= $setup->loan_setup_id ?>" class="btn btn-sm btn-primary text-white"><i class="fa fa-pencil-square-o"></i></a>
                                            <div class="modal fade" id="loanSetup<?= $setup->loan_setup_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalCenterTitle">Edit Loan Setup</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                        <form action="<?= site_url('edit-loan-setup') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
                                                            <?= csrf_field() ?>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Loan Description</label>
                                                                            <input required type="text" name="loan_description" value="<?= $setup->loan_description ?? '' ?>" placeholder="Loan Description"  class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Qualification Age</label>
                                                                        <div class="input-group mb-3">
                                                                            <input required type="number" class="form-control" value="<?= $setup->age_qualification ?? '' ?>" placeholder="Qualification Age" name="qualification_age"  >
                                                                            <div class="input-group-append">
                                                                                <span class="input-group-text">months</span>
                                                                            </div>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                        <div class="fancy-checkbox">
                                                                            <label><input type="checkbox" name="psr" <?= $setup->psr == 1 ? 'checked' : '' ?> value="<?= $setup->psr ?? '' ?>" id="edit_psr"><span>PSR?</span></label>
                                                                        </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">PSR Value</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="number" step="0.01" <?= $setup->psr != 1 ? 'disabled' : '' ?> value="<?= $setup->psr_value ?? '' ?>" class="form-control" placeholder="PSR Value" id="edit_psr_value" name="psr_value" >
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text">(%)</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Min. Credit Limit</label>
                                                                            <input type="number" required step="0.01" value="<?= $setup->min_credit_limit ?? '' ?>" name="min_credit_limit" placeholder="Min. Credit Limit"  class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Max. Credit Limit</label>
                                                                            <input type="number" value="<?= $setup->max_credit_limit ?? '' ?>" required step="0.01" name="max_credit_limit" placeholder="Max. Credit Limit"  class="form-control">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Max. Repayment Periods</label>
                                                                            <input type="number" required value="<?= $setup->max_repayment_periods ?? '' ?>"  name="max_repayment_periods" placeholder="Max. Repayment Periods"  class="form-control">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Interest Rate</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="number" required step="0.01" value="<?= $setup->ls_interest_rate ?? '' ?>" class="form-control" placeholder="Interest Rate" name="interest_rate" >
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text">(%)</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Interest Method</label>
                                                                            <select name="interest_method" required id="interest_method" class="form-control">
                                                                                <option disabled selected>Select interest method</option>
                                                                                <option value="1">Flat</option>
                                                                                <option value="2">Monthly</option>
                                                                                <option value="3">Yearly</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="fancy-checkbox">
                                                                            <label><input type="checkbox" <?= $setup->commitment == 1 ? 'checked' : ''  ?>  name="commitment" id="commitment"><span>Commitment?</span></label>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <label for="">Commitment Value</label>
                                                                            <div class="input-group mb-3">
                                                                                <input type="number" <?= $setup->commitment != 1 ? 'disabled' : ''  ?> value="<?= $setup->commitment_value ?? '' ?>"  step="0.01"  class="form-control" placeholder="Commitment Value" name="commitment_value" id="commitment_value">
                                                                                <div class="input-group-append">
                                                                                    <span class="input-group-text">(%)</span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Status</label>
                                                                            <select name="status" id="status" class="form-control">
                                                                                <option selected disabled>Select status</option>
                                                                                <option value="1">Active</option>
                                                                                <option value="2">Block</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Payable</label>
                                                                            <select name="payable" id="payable" class="form-control">
                                                                                <option selected disabled>Select payable</option>
                                                                                <option value="1">Cash</option>
                                                                                <option value="2">Vendor</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Loan GL Account No.</label> 
                                                                            <select required name="loan_gl_account_number" id="loan_gl_account_number" class="form-control js-example-basic-single" >
                                                                                <option disabled selected>Select Loan GL Account No.</option>
                                                                                <?php foreach($accounts as $account) : ?>
                                                                                    <option <?= $setup->loan_gl_account_no == $account['glcode'] ? 'selected' : ''  ?> value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Loan Unearned Int. GL Account No.</label>
                                                                            <select required name="loan_unearned_int_gl_account_no" id="loan_unearned_int_gl_account_no" class="form-control js-example-basic-single" >
                                                                                <option disabled selected>Select Loan Unearned Int. GL Account No</option>
                                                                                <?php foreach($accounts as $account) : ?>
                                                                                    <option <?= $setup->loan_unearned_int_gl_account_no == $account['glcode'] ? 'selected' : ''  ?> value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Loan Int. Income GL Account No.</label>
                                                                            <select required name="loan_int_income_gl_account_no" id="loan_int_income_gl_account_no" class="form-control js-example-basic-single">
                                                                                <option disabled selected>Select Loan Int. Income GL Account No.</option>
                                                                                <?php foreach($accounts as $account) : ?>
                                                                                    <option <?= $setup->loan_int_income_gl_account_no == $account['glcode'] ? 'selected' : ''  ?> value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
                                                                                <?php endforeach; ?>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6 col-lg-6 col-sm-6">
                                                                        <div class="form-group">
                                                                            <label for="">Loan Terms</label>
                                                                            <input type="hidden" value="<?= $setup->loan_setup_id ?>" name="loan_id">
                                                                            <textarea name="loan_terms" id="loan_terms" class="form-control" style="resize:none;" placeholder="Loan Terms"><?= $setup->loan_terms ?? '' ?></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <div class="form-group d-flex justify-content-center">
                                                                <button type="button" class="btn btn-round btn-default" data-dismiss="modal">Close</button>
                                                                    <button class="btn btn-sm btn-round btn-primary"><i class="ti-check mr-2"></i>Save changes</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<!--<script src="--><?//=site_url() ?><!--assets/bundles/vendorscripts.bundle.js"></script>-->

<!--<script src="--><?//=site_url() ?><!--assets/bundles/datatablescripts.bundle.js"></script>-->
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
    <script src="<?=site_url() ?>assets/js/parsley.min.js"></script>
    <script src="<?=site_url() ?>assets/js/select2.min.js"></script>
    <script>
        $('.simpletable').DataTable();
        $(document).ready(function(){
          
            $('.js-example-basic-single').select2();
            $("#psr").on('change', function() {
                if ($("#psr").is(':checked')){
                    $('#psr_value').prop("disabled", false);
                    $('#psr_value').prop('required',true);
                }else {
                    $('#psr_value').prop("disabled", true);
                }
            });
            $("#edit_psr").on('change', function() {
                if ($("#edit_psr").is(':checked')){
                    $('#edit_psr_value').prop("disabled", false);
                    $('#edit_psr_value').prop('required',true);
                }else {
                    $('#edit_psr_value').prop("disabled", true);
                }
            });
            $("#commitment").on('change', function() {
                if ($("#commitment").is(':checked')){
                    $('#commitment_value').prop("disabled", false);
                    $('#commitment_value').prop('required',true);
                }else {
                    $('#commitment_value').prop("disabled", true);
                }
            });
            $('#loanSetupForm').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                return true; // Don't submit form for this demo
            });
        });
    </script>
<?= $this->endSection() ?>
