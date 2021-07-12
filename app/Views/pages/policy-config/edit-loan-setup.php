<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Edit Loan Setup  
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
Edit Loan Setup 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Edit Loan Setup 
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <div class="container">
                <div class="row m-b-30">
                    <div class="col-lg-12 col-xl-12">
                        <h5 class="sub-title p-3 text-primary">Edit Loan</h5>
	
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
						<form action="" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
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
										<input type="text" required step="0.01" value="<?= number_format($setup->min_credit_limit,2) ?? '' ?>" name="min_credit_limit" placeholder="Min. Credit Limit"  class="number form-control">
									</div>
								</div>
								<div class="col-md-6 col-lg-6 col-sm-6">
									<div class="form-group">
										<label for="">Max. Credit Limit</label>
										<input type="text" value="<?= number_format($setup->max_credit_limit,2) ?? '' ?>" required step="0.01" name="max_credit_limit" placeholder="Max. Credit Limit"  class="number form-control">
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
										<label for="">Interest Charge Type</label>
										<select name="interest_charge_type" required id="interest_charge_type" class="form-control">
											<option disabled selected>Select interest method</option>
											<option value="1" <?php if($setup->interest_charge_type == 1): echo "selected"; endif; ?> >Flat</option>
											<option value="2"  <?php if($setup->interest_charge_type == 2): echo "selected"; endif; ?>>Monthly</option>
											<option value="3"  <?php if($setup->interest_charge_type == 3): echo "selected"; endif; ?>>Yearly</option>
										</select>
									</div>
								</div>
								
								<div class="col-md-6 col-lg-6 col-sm-6">
									<div class="form-group">
										<label for="">Interest Method</label>
										<select name="interest_method" required id="interest_method" class="form-control">
											<option disabled selected>Select interest method</option>
											<option value="1" <?php if($setup->interest_method == 1): echo "selected"; endif; ?>>Upfront</option>
											<option value="2" <?php if($setup->interest_method == 2): echo "selected"; endif; ?>>Reducing Balance</option>
											<option value="3" <?php if($setup->interest_method == 3): echo "selected"; endif; ?>>Targetted</option>
										</select>
									</div>
								</div>
							
							</div>
							
							<div class="row">
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
											<option value="1" <?php if($setup->status == 1): echo "selected"; endif; ?>>Active</option>
											<option value="2" <?php if($setup->status == 2): echo "selected"; endif; ?>>Block</option>
										</select>
									</div>
								</div>
								<div class="col-md-6 col-lg-6 col-sm-6">
									<div class="form-group">
										<label for="">Payable</label>
										<select name="payable" id="payable" class="form-control">
											<option selected disabled>Select payable</option>
											<option value="1" <?php if($setup->payable == 1): echo "selected"; endif; ?>>Cash</option>
											<option value="2" <?php if($setup->payable == 2): echo "selected"; endif; ?>>Vendor</option>
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
								
								<button class="btn btn-sm btn-round btn-primary"><i class="ti-check mr-2"></i>Save changes</button>
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
    <script>
        $(document).ready(function(){
            // $('.js-example-basic-single').select2();
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
                    console.log('i am working fa');
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
