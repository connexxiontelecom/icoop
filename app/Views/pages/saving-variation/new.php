<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    New Saving Variation
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   New Saving Variation
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
     New Saving Variation
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.mixn.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <div class="container">
				
				
					<h6 class="sub-title p-3  text-uppercase"> New Saving Variation</h6>
			
					<form enctype="multipart/form-data" action="<?= site_url('/saving-variations/new') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
						<div class="row clearfix">
					<div class="col-lg-6 col-md-12 col-xl-6">
                              <?= csrf_field() ?>
						
									<div class="form-group">
										<strong for="">Staff ID</strong>
										<input required type="text" name="staff_id" id="search_account"  onblur="getSavings()" placeholder="Enter staff ID or  name"  class="form-control">
									
									</div>
						
						<div class="form-group response">
							<strong for="">Contribution Type</strong>
							<select name="contribution_type" id="contribution_type" required id="contribution_type" class="form-control">
								<option selected disabled>--Select contribution type--</option>
								<?php foreach($contribution_types as $ct): ?>
                                    <option value="<?= $ct['contribution_type_id'] ?? '' ?>"><?= $ct['contribution_type_name']  ?? '' ?></option>
                                <?php endforeach; ?>
							</select>
						</div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <strong for="">Month</strong>
                                <select name="month" id="month" class="form-control">
                                    <option disabled selected>--Select month--</option>
                                    <option value="1">January</option>
                                    <option value="2">February</option>
                                    <option value="3">March</option>
                                    <option value="4">April</option>
                                    <option value="5">May</option>
                                    <option value="6">June</option>
                                    <option value="7">July</option>
                                    <option value="8">August</option>
                                    <option value="9">September</option>
                                    <option value="10">October</option>
                                    <option value="11">November</option>
                                    <option value="12">December</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <strong for="">Year</strong>
                                <select name="month" id="month" class="form-control">
                                    <option disabled selected>--Select year--</option>
                                    <?php for($i = date('Y')+5; $i>=date('Y'); $i--) : ?>
                                        <option value="<?=$i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        
                        </div>	
                        <div class="form-group">
                            <label for="">Amount</label>
                            <input type="text" placeholder="Amount" class="form-control">
                        </div>					
						
                                    <hr>
                                    <div class="form-group d-flex justify-content-center" id="submitBtnWrapper">
                                        <button class="btn btn-sm btn-primary" id="submitLoanBtn"><i class="ti-check mr-2"></i>Submit</button>
                                    </div>
                                
                            </div>
                    <div class="col-lg-5 offset-1 col-md-12 col-xl-5 offset-1">
	
						<div class="row p-2 mb-2" style="background:#2D3541;">
							<div class="col-md-12 col-lg-12">
								<h6 class="text-uppercase text-white">Savings</h6>
							</div>
						</div>
                        <div id="savingsTable"></div>                               
                    </div>
				</div>
					</form>
					
            
				
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script>
    $(document).ready(function(){
        $(document).on('change','#contribution_type', function(e){
            e.preventDefault();
                $.ajax({
                    type: "GET",
                    url: '/get-payment-details/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        $('#savingsTable').html(html);
                        //console.log(html);
                        /* var handler = $.parseJSON(html);
                        duration = handler.max_repayment_periods;
                        amount = handler.max_credit_limit;
                        interest_method = handler.interest_method;
                        $('#interest_method').val(interest_method);
                        $('#loan_terms').text(handler.loan_terms);
                        $('#duration').val('');
                        $('#amount').val(''); */
                    }
                });
        });
    });
</script>
<?= $this->endSection() ?>
