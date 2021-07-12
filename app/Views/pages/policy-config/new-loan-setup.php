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
<link href="/assets/css/parsley.min.css" rel="stylesheet">
<link href="/assets/css/select2.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

<div class="card">
	<div class="card-block">
		<div class="container">
			<div class="row m-b-30">
				<div class="col-lg-12 col-xl-12">
					<h6 class="sub-title p-3 text-primary text-uppercase">Loan Setup</h6>
					<?php if(session()->has('errors')):
						$errors = session()->get('errors');
						foreach ($errors as $error):
							?>
							<div class="alert alert-danger alert-dismissible fade show" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								<i class="mdi mdi-check-all mr-2"></i><strong><?php print_r($error); ?> !</strong>
							</div>
						<?php endforeach; endif; ?>
					<form action="<?= site_url('loan-setup') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
						<?= csrf_field() ?>
						<div class="row">
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Loan Description</label>
									<input required type="text" name="loan_description" placeholder="Loan Description"  class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Qualification Age (Months)</label>
									<input required type="number" class="form-control" placeholder="Qualification Age" name="qualification_age"  >
								
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<div class="fancy-checkbox">
										<label><input type="checkbox" name="psr" id="psr"><span>PSR?</span></label>
									</div>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">PSR Value (%)</label>
									<input type="number" step="0.01" disabled class="form-control" placeholder="PSR Value" id="psr_value" name="psr_value" >
								
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Min. Credit Limit</label>
									<input type="text" required step="0.01" name="min_credit_limit" placeholder="Min. Credit Limit"  class="number form-control">
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Max. Credit Limit</label>
									<input type="text" required step="0.01" name="max_credit_limit" placeholder="Max. Credit Limit"  class="number form-control">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Max. Repayment Periods</label>
									<input type="number" required  name="max_repayment_periods" placeholder="Max. Repayment Periods"  class="form-control">
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Interest Rate (%)</label>
									<input type="number" required step="0.01" class="form-control" placeholder="Interest Rate" name="interest_rate" >
								
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Interest Charge Type</label>
									<select name="interest_charge_type" required id="interest_charge_type" class="form-control">
										<option disabled selected>Select interest charge type</option>
										<option value="1">Flat</option>
										<option value="2">Monthly</option>
										<option value="3">Yearly</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Interest Method</label>
									<select name="interest_method" required id="interest_method" class="form-control">
										<option disabled selected>Select interest method</option>
										<option value="1">Upfront</option>
										<option value="2">Reducing Balance</option>
										<option value="3">Targetted</option>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="fancy-checkbox">
									<label><input type="checkbox" name="commitment" id="commitment"><span>Commitment?</span></label>
								</div>
								<div class="form-group">
									<label for="">Commitment Value (%)</label>
									<input type="number"  step="0.01" disabled class="form-control" placeholder="Commitment Value" name="commitment_value" id="commitment_value">
								
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
										<option value="0">Block</option>
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
									<select required name="loan_gl_account_number" id="loan_gl_account_number" class="form-control">
										<option disabled selected>Select Loan GL Account No.</option>
										<?php foreach($accounts as $account) : ?>
											<option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Loan Unearned Int. GL Account No.</label>
									<select required name="loan_unearned_int_gl_account_no" id="loan_unearned_int_gl_account_no" class="form-control">
										<option disabled selected>Select Loan Unearned Int. GL Account No</option>
										<?php foreach($accounts as $account) : ?>
											<option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Loan Int. Income GL Account No.</label>
									<select required name="loan_int_income_gl_account_no" id="loan_int_income_gl_account_no" class="form-control">
										<option disabled selected>Select Loan Int. Income GL Account No.</option>
										<?php foreach($accounts as $account) : ?>
											<option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?> - (<?= $account['glcode'] ?>)</option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="col-md-6 col-lg-6 col-sm-6">
								<div class="form-group">
									<label for="">Loan Terms</label>
									<textarea name="loan_terms" id="loan_terms" class="form-control" style="resize:none;" placeholder="Loan Terms" required></textarea>
								</div>
							</div>
						</div>
						<hr>
						<div class="form-group d-flex justify-content-center">
							<button class="btn btn-mini btn-primary"><i class="ti-check mr-2"></i>Save</button>
						</div>
					</form>
				</div>
				
				
			</div>
		</div>
	</div>
</div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="/assets/js/parsley.min.js"></script>
<script src="/assets/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        $('.js-example-basic-single').select2();
        $("#psr").on('change', function() {
            if ($("#psr").is(':checked')){
                $('#psr_value').prop("disabled", false);
                $('#psr_value').prop('required',true);
            }else {
                $('#psr_value').prop("disabled", true);
                $('#psr_value').prop("required", false);
            }
        });
        $("#edit_psr").on('change', function() {
            if ($("#edit_psr").is(':checked')){
                $('#edit_psr_value').prop("disabled", false);
                $('#edit_psr_value').prop('required',true);
            }else {
                $('#edit_psr_value').prop("disabled", true);
                $('#edit_psr_value').prop("required", false);
            }
        });
        $("#commitment").on('change', function() {
            if ($("#commitment").is(':checked')){
                $('#commitment_value').prop("disabled", false);
                $('#commitment_value').prop('required',true);
            }else {
                $('#commitment_value').prop("disabled", true);
                $('#commitment_value').prop("required", false);
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

