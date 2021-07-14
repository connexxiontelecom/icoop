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
                        <hr>
						<div class="row p-2 mb-2">
							<div class="col-md-12 col-lg-12">
								<div class="form-group">
                                    <label for="">Savings</label>
                                    <input type="text" name="savings_amount" id="savings_amount" class="form-control" placeholder="Savings" readonly>
                                </div>
							</div>
							<div class="col-md-12 col-lg-12">
								<div class="form-group">
                                    <label for="">Ecumbrance Amount</label>
                                    <input type="text" id="encumbrance_amount" name="encumbrance_amount" class="form-control" placeholder="Encumbrance Amount" readonly>
                                    <input type="hidden" id="encumbrance" name="encumbrance" class="form-control" placeholder="Encumbrance Amount">
                                    <input type="hidden" id="psr" name="psr" class="form-control" placeholder="PSR" >
                                    <input type="hidden" id="psr_rate" name="psr_rate" class="form-control" placeholder="PSR Rate" >
                                </div>
							</div>
						</div>
                            
                               
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
        var max_limit = 0;
        var min_limit = 0;
        var psr_value = 0;
        var psr_rate = 0;
        var psr = 0;
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
                psr_value = psr == 1 ? (psr_rate/100)*parseInt(money.replace(/,/g, '')) : 0;
                $('#encumbrance_amount').val(parseInt(psr_value).toLocaleString() );
                $('#encumbrance').val(parseInt(psr_value) );
                $('#psr').val(psr );
                $('#psr_rate').val(psr_rate );
               
               if(parseFloat(money.replace(/,/g, '')) < parseFloat(min_limit) ){
                Toastify({
                    text: `Ooop! This amount is less than min amount. Enter higher amount.`,
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
               }else {
                $('#submitLoanBtn').prop('disabled',false);
               }

               if(parseFloat(money.replace(/,/g, '')) > parseFloat(max_limit) ){
                   Toastify({
                       text: `Ooop! This amount is greater than max amount. Enter a lesser amount.`,
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
               }else {
                   $('#submitLoanBtn').prop('disabled',false);
               }
               
              if(psr == 1){
                  let reqired_encum = (psr_rate/100)*parseFloat(money.replace(/,/g, ''));
                  if(reqired_encum > parseFloat(savings)){
                      Toastify({
                          text: `Ooop! Your current savings cannot handle this loan.`,
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
                        max_limit = handler.max_credit_limit;
                        min_limit = handler.min_credit_limit;
                        interest_method = handler.interest_method;
                        psr = handler.psr;
                        psr_rate = handler.psr_value;
                        let mi_limit = formatNumbers(handler.min_credit_limit);
                        let mx_limit = formatNumbers(handler.max_credit_limit);
                        $('#interest_method').val(interest_method);
                        let text = handler.loan_terms +"<br> Maximum Credit: "+ mx_limit+" <br> Minimum Credit: "+ mi_limit + " <br> PSR: "+ psr_rate+"%"
                        $('#loan_terms').html(text);
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
                        savings = data.cooperator_savings;
                        $('#savings_amount').val(parseInt(savings).toLocaleString());
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
            url: '<?php echo site_url('/get-savings') ?>',
            type: 'post',
            data: {
                'staff_id': staff_id,
            },
            dataType: 'json',
            success:function(response){
                savings = response.savings;
               $('#savings_amount').val(savings.toLocaleString());
               
            }
        });
        }
        function formatNumbers(x) {
            return x.toString().replace(/\B(?<!\.\d*)(?=(\d{3})+(?!\d))/g, ",");
        }
        
    </script>
<?= $this->endSection() ?>
