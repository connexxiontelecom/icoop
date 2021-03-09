<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
    New Loan Application
<?= $this->endSection() ?>
<?= $this->section('current_page') ?>
   New Loan Application
<?= $this->endSection() ?>

<?= $this->section('page_crumb') ?>
    New Loan Application
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <link href="/assets/css/parsley.min.css" rel="stylesheet">
    <link href="/assets/css/toastify.min.css" rel="stylesheet">
<?= $this->endSection() ?>


<?= $this->section('content') ?>

    <div class="card">
        <div class="card-block">
            <div class="container">
				
				
					<h6 class="sub-title p-3  text-uppercase">New Loan Application</h6>
			
					<form enctype="multipart/form-data" action="<?= site_url('/loan/new') ?>" autocomplete="off" method="POST" data-parsley-validate="" id="loanSetupForm">
						<div class="row clearfix">
					<div class="col-lg-6 col-md-12 col-xl-6">
                              <?= csrf_field() ?>
                                    <div class="row p-2 mb-2" style="background:#2D3541;">
                                        <div class="col-md-12 col-lg-12">
                                            <h6 class="text-uppercase text-white">Staff Details</h6>
                                        </div>
                                    </div>
						
									<div class="form-group">
										<strong for="">Staff ID</strong>
										<input required type="text" name="staff_id" id="search_account"  onblur="getSavings()" placeholder="Enter staff ID or  name"  class="form-control">
									
									</div>
						
						<div class="form-group response">
							<strong for="">Loan Type</strong>
							<select name="loan_type" required id="loan_type" class="form-control">
								<option selected disabled>--Select loan type--</option>
								<?php foreach($loan_types as $type) : ?>
									<option value="<?= $type['loan_setup_id'] ?>"><?= $type['loan_description'] ?></option>
								<?php endforeach; ?>
							</select>
							<input type="hidden" name="interest_method" id="interest_method">
						</div>
						
<!--                                    <div class="row bg-light">-->
<!--                                        <div class="col-md-12 col-lg-12 col-sm-12">-->
<!--                                        -->
<!--                                        </div>-->
<!--                                    </div>-->
						
						<div class="form-group">
							<strong for="">Duration (months)</strong>
							<input type="number" required class="form-control" placeholder="Duration" id="duration" name="duration" >
						
						</div>
						
						<div class="form-group">
							<strong for="">Amount</strong>
							<input type="text" required  name="amount" id="amount" placeholder="Amount"  class="number form-control">
						</div>
						
						<div class="form-group">
							<strong for="">File (.PDF)</strong>
							<input type="file"  name="attachment" id="attachment" >
						</div>
                                 
                                    <div class="row bg-light">
                                        <div class="col-md-12 col-lg-12 col-sm-12 response">
                                        
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-md-12 col-lg-12 col-sm-12 response">
                                        
                                        </div>
                                    </div>
                                    <div class="row bg-light">
                                        <div class="col-md-12 col-lg-12 col-sm-12 response">
                                        
                                        </div>
                                    </div>
                                    <div class="row  p-2 mb-2" style="background:#2D3541;">
                                        <div class="col-md-12 col-lg-12">
                                            <h6 class="text-uppercase text-white">Guarantor & Terms</h6>
                                        </div>
                                    </div>
						<div class="form-group">
							<strong for="">Guarantor ID <small>(1)</small></strong>
							<input type="text" required  name="guarantor_1" id="guarantor_1" placeholder="Guarantor ID 1"  class="form-control">
							<small class="float-right" id="guarantor_wrapper_1"><label for="" class="badge badge-info" id="guarantor_badge_1">Guarantor</label></small>
						</div>
						<div class="form-group">
							<strong for="">Guarantor ID <small>(2)</small> </strong>
							<input type="text" required  name="guarantor_2" id="guarantor_2" placeholder="Guarantor ID 2"  class="form-control">
							<small class="float-right" id="guarantor_wrapper_2"><label for="" class="badge badge-info" id="guarantor_badge_2">Guarantor</label></small>
						</div>
						
						<div class="form-group">
							<div class="fancy-checkbox" style="margin-top:30px;">
								<label><input type="checkbox" required name="terms_conditions"><span>Agree to terms and condition</span></label>
							</div>
						</div>
                                    <div class="row bg-light">
                                        <div class="col-md-6 col-lg-6 col-sm-6 response">
                                        
                                        </div>
                                        <div class="col-md-6 col-lg-6 col-sm-6 response">
                                        

                                    </div>
                                    <div class="row ">
                                            <div class="col-md-12 col-sm-12 col-lg-12 response ">
                                            
                                            </div>
                                    </div>
                                    </div>
                                    
                                    <hr>
                                    <div class="form-group d-flex justify-content-center" id="submitBtnWrapper">
                                        <button class="btn btn-sm btn-primary" id="submitLoanBtn"><i class="ti-check mr-2"></i>Submit</button>
                                    </div>
                                
                            </div>
                    <div class="col-lg-5 offset-1 col-md-12 col-xl-5 offset-1">
	
						<div class="row p-2 mb-2" style="background:#2D3541;">
							<div class="col-md-12 col-lg-12">
								<h6 class="text-uppercase text-white">Loan Terms</h6>
							</div>
						</div>
						<p id="loan_terms">
						</p>
                            
                               
                            </div>
				</div>
					</form>
					
            
				
            </div>
        </div>
    </div>

<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
    <script src="/assets/js/parsley.min.js"></script>
    <script src="/assets/js/toastify.min.js"></script>
    <script src="/assets/js/axios.min.js"></script>
    <script src="/assets/js/simple.money.format.js"></script>
    <script>
        var duration = 0;
        var amount = 0;
        var savings = 0;
        var guarantor = null;
        var staff = null;
        var guarantor_2 = null;
        var interest_method = null;
        $(document).ready(function(){
            $('#guarantor_wrapper_1').hide();
            $('#guarantor_wrapper_2').hide();
            $('#submitLoanBtn').attr('disabled','disabled');
            $('.money').simpleMoneyFormat();
            
          /*  $(document).on('blur', '#guarantor_1', function(e){
               e.preventDefault();
               if($(this).val() != ''){
                $.ajax({
                    type: "GET",
                    url: '/get-guarantor/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        if(html.length == 0){
                            $('#guarantor_badge_1').val('');
                        }else{
                            $('#guarantor_wrapper_1').show();
                            $('#guarantor_badge_1').html(handler.cooperator.cooperator_first_name+" "+handler.cooperator.cooperator_last_name);
                        }
                    }
                    });
               }
           }); */
           $(document).on('blur', '#guarantor_2', function(e){
               e.preventDefault();
               if($(this).val() != ''){
                $.ajax({
                    type: "GET",
                    url: '/get-guarantor/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        if(html.length == 0){
                            $('#guarantor_badge_2').val('');
                        }else{
                            $('#guarantor_wrapper_2').show();
                            $('#guarantor_badge_2').html(handler.cooperator.cooperator_first_name+" "+handler.cooperator.cooperator_last_name);
                        }
                    }
                    });
               }
           });
           $(document).on('blur', '#duration', function(e){
               e.preventDefault();
               if(parseInt($(this).val()) > duration){
                Toastify({
                    text: "Ooop! The duration you entered cannot be more than the maximum repayment periods for the selected loan type.",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top", 
                    position: "right", 
                    backgroundColor: "linear-gradient(to right, #FF0000, #FFE8AC)",
                    stopOnFocus: true, 
                    onClick: function(){} 
                    }).showToast();
                    $('#submitLoanBtn').attr('disabled',true);
               }else{
                $('#submitLoanBtn').attr('disabled',false);
               }
           });
           $(document).on('blur', '#amount', function(e){
               e.preventDefault();
               var money = $(this).val();
               if(parseInt(money.replace(/,/g, '')) > amount || parseInt(money.replace(/,/g, '')) > savings){
                Toastify({
                    text: "Ooop! Amount must not exceed maximum credit limit for the selected loan type or your savings is not up to this amount.",
                    duration: 3000,
                    newWindow: true,
                    close: true,
                    gravity: "top", 
                    position: "right", 
                    backgroundColor: "linear-gradient(to right, #FF0000, #FFE8AC)",
                    stopOnFocus: true, 
                    onClick: function(){} 
                    }).showToast();
                    $('#submitLoanBtn').prop('disabled',true);
               }else{
                $('#submitLoanBtn').prop('disabled',false);
               }
           });
           $(document).on('change', '#loan_type', function(e){
               e.preventDefault();
               if($(this).val() != ''){
                $.ajax({
                    type: "GET",
                    url: '/get-loan-type/'+$(this).val(),
                    cache: false,
                    success: function(html){
                        var handler = $.parseJSON(html);
                        duration = handler.max_repayment_periods;
                        amount = handler.max_credit_limit;
                        interest_method = handler.interest_method;
                        $('#interest_method').val(interest_method);
                        $('#loan_terms').text(handler.loan_terms);
                        $('#duration').val('');
                        $('#amount').val('');
                    }
                    });
               }
           });
            $('#loanSetupForm').parsley().on('field:validated', function() {
                var ok = $('.parsley-error').length === 0;
                $('.bs-callout-info').toggleClass('hidden', !ok);
                $('.bs-callout-warning').toggleClass('hidden', ok);
            })
            .on('form:submit', function() {
                return true; 
            });

            $("#search_account").autocomplete({
                source: "<?php echo base_url('/loan/search-cooperator'); ?>",
                select: function( event , ui ) {
                   axios.post('/cooperator/account-status', {term:ui.item.label})
                   .then(res=>{
                        var data = res.data.cooperator;
                        if(data.cooperator_status == 2){
                            $('#submitLoanBtn').show();
                        }else{
                            $('#submitLoanBtn').hide();
                            Toastify({
                            text: "Ooop! This account is frozen.",
                            duration: 3000,
                            newWindow: true,
                            close: true,
                            gravity: "top", 
                            position: "right", 
                            backgroundColor: "linear-gradient(to right, #FF0000, #FFE8AC)",
                            stopOnFocus: true, 
                            onClick: function(){} 
                            }).showToast();

                        }
                   })
                   .catch(error=>{
                        $('#submitLoanBtn').attr('disabled','true');
                   });
                }
            });
            $("#guarantor_1").autocomplete({
                source: "<?php echo base_url('/loan/search-cooperator'); ?>",
            });
            $("#guarantor_2").autocomplete({
                source: "<?php echo base_url('/loan/search-cooperator'); ?>",
            });
        });

        function getSavings(){
            var staff = $('#search_account').val();
            let staff_id = staff.split(',')[0];
            $.ajax({
            url: '<?php echo site_url('get-savings') ?>',
            type: 'post',
            data: {
                'staff_id': staff_id,
            },
            dataType: 'json',
            success:function(response){
                savings = response.savings.pd_amount;
            }
        });
        }
    </script>
<?= $this->endSection() ?>
