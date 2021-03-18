<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Loans Reconciliation
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Loans Reconciliation
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Loans Reconciliation
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>


<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>New Loan Reconciliation</h2>
			</div>
			
			<div class="body">
				<form method="POST" enctype="multipart/form-data">
					
					<fieldset>
						<div class="row clearfix">
							<div class="col-lg-7 col-md-12">
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Staff ID or Name: </b></label>
									<input type="text" class="form-control"  id="search_account"  onblur="get_loans()"   required  name="staff_id" placeholder="Enter staff ID or  name">
								
								
								
								</div>
								
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Active Loans: </b></label>
									
									<select class="custom-select" id="loan" required name="loan_id" onchange="sel(this)">
										<option disabled selected> -- Select Loan Type --</option>
										
									</select>
								</div>
								<div class="alert alert-danger alert-dismissible" role="alert" id="loan_balance_warning">
									<!--                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
									<i class="fa fa-warning"></i>Outstanding Balance: <span id="loan_balance_amount"> </span>
								</div>
								
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Transaction Type: </b></label>
									
									<select class="custom-select" id="transaction_type" required name="transaction_type" onchange="change_label()" >
										<option value="0" selected disabled> -- Select Transaction Type --</option>
										<option value="1">  Credit </option>
										<option value="2">  Debit </option>
										
									</select>
								</div>
								
								
								
								<div id="freeze">
									
									<div class="form-group">
										
										<label  for="application_payroll_group_id"> <b> Amount: </b></label>
										<input type="text" class="number form-control"  required  name="amount" id="amount"  placeholder="Enter Amount" onkeyup="compare_balance(this)">
										
										
										<input type="hidden" id="balance" name="balance">
										
										
									</div>
									
									<div class="form-group" id="mi_div">
										
										<label  for="application_payroll_group_id"> <b> MI: </b></label>
										<input type="text" class="number form-control"  required  name="mi" id="mi" onkeyup="split(this)"  placeholder="Enter Amount">
										
									
									</div>
									
									<div class="form-group" id="mpr_div">
										
										<label  for="application_payroll_group_id"> <b> MPR: </b></label>
										<input type="text" class="number form-control"  required  name="mpr" id="mpr" readonly  placeholder="Enter Amount">
										
										
									</div>
									
									
									<div class="alert alert-danger alert-dismissible" role="alert" id="reconciliation_warning">
										<!--                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
										<i class="fa fa-warning"></i> Credit amount must be less or equal loan balance
									</div>
								
									<input type="hidden"  class="form-control" placeholder="Date" name="date" value="<?=date('Y-m-d') ?>" required>
									
									
									
									<div class="form-group" id="ac_ac">
										
										<label for="action_account"> <b> <span id="action_ac"> Account : </span></b></label>
										
										<select class="custom-select" id="action_account" required name="account" >
											<option disabled selected>Select account</option>
											<?php foreach($accounts as $account) : ?>
												<option value="<?= $account['glcode'] ?>"> <?= $account['glcode'] ?? ''?> - <?= $account['account_name'] ?? ''?>  </option>
											<?php endforeach; ?>
										
										</select>
									</div>
									
<!--									<div class="form-group">-->
<!--										<label for="application_first_name"><b>File(.PDF):</b></label>-->
<!--										<input type="file"  class="form-control"  name="withdraw_file">-->
<!--									</div>-->
									
									
									<?= csrf_field() ?>
									<div class="form-group">
										<button type="submit" id="reconciliation_submit" disabled class="btn btn-info btn-block">Submit</button>
										
									
									</div>
								</div>
							
							</div>
						
						
						</div>
					</fieldset>
				
				
				</form>
			</div>
		</div>
	</div>




</div>



<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script><!-- Jquery Validation Plugin Css -->
<script src="assets/vendor/jquery-steps/jquery.steps.js"></script><!-- JQuery Steps Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/forms/form-wizard.js"></script>
<script src="assets/vendor/dropify/js/dropify.js"></script>
<script src="assets/js/common.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script>
	
	function sel(sel){
		 let sey = sel.options[sel.selectedIndex].text;
		 sey = sey.split('Outstanding:')[1];
		 sey = sey.split(')')[0];
		 sey = parseFloat(sey.replace(/,/g, ''));
		 $("#balance").val(sey);
        $("#loan_balance_warning").show();
        $("#loan_balance_amount").html(sey.toLocaleString());
		 
		}
		
		function compare_balance(e){
            let amount = parseFloat(e.value.replace(/,/g, ''));
            let balance = parseFloat($('#balance').val().replace(/,/g, ''));
            let transaction_type = document.getElementById('transaction_type').value;
            if(transaction_type == 1){
                
                if(amount > balance){
                  e.value = 0;
                  alert('amount is greater than balance');
                    $('#reconciliation_submit').hide();
                    $('#reconciliation_submit').attr('disabled', true);
                  
				}
                if(amount <= balance){
                    $('#reconciliation_submit').show();
                    $('#reconciliation_submit').attr('disabled', false);
                    
				}
			}
   
   
	  
		}
		
		
		function split(e){
            let amount = parseFloat($('#amount').val().replace(/,/g, ''));
            let mi = parseFloat(e.value.replace(/,/g, ''));
            
            if(mi > amount){
                e.value = 0;
                $('#mpr').val(0);
                alert('Amount greater than balance');
                $('#reconciliation_submit').hide();
                $('#reconciliation_submit').attr('disabled', true);
			}
            if(mi <= amount){
                let mpr = amount - mi
                mpr = mpr.toLocaleString()
                $('#mpr').val(mpr);
                $('#reconciliation_submit').show();
                $('#reconciliation_submit').attr('disabled', false);
			}
   
		}

	
	function change_label(){
    let transaction_type = document.getElementById('transaction_type').value;

    if(transaction_type == 1){ //credit

        // $('#reconciliation_submit').attr('disabled', false);
        $('#reconciliation_warning').hide();
        $('#mpr_div').show();
        $('#mi_div').show();
        
        let amount = parseFloat($('#amount').val().replace(/,/g, ''));

        let balance = parseFloat($('#balance').val());

        if(amount <= balance){

            $('#reconciliation_submit').show();
            $('#reconciliation_submit').attr('disabled', false);

        }

        if(amount > balance){
            $('#amount').val(0)
           
       
            $('#reconciliation_submit').hide();
            $('#reconciliation_submit').attr('disabled', true);
            alert('amount is greater than balance');
        }

        $('#ac_ac').show();
        $("#action_ac").empty();
        $("#action_ac").append('Debit Account:');

    }
    
    
    if(transaction_type == 2){ //debit

        $('#reconciliation_submit').attr('disabled', true);
        $('#reconciliation_warning').hide();
        $('#mpr_div').hide();
        $('#mi_div').hide();
        
        
        $('#ac_ac').show();
        $("#action_ac").empty();
        $("#action_ac").append('Credit Account:');
        $('#reconciliation_submit').show();
        $('#reconciliation_submit').attr('disabled', false);
        $('#reconciliation_warning').hide();
        
        
        

   

    }
    
    if(transaction_type == 0){
        $('#ac_ac').hide();
        $('#reconciliation_submit').hide();
	}


}
	
    $(document).ready(function() {
        $('#balance_warning').hide();
        $('#reconciliation_submit').hide();
        $('#reconciliation_warning').hide();
        $('#mi-warning').hide();
        $('#mpr_div').hide();
		$('#mi_div').hide();
        $('#ac_ac').hide();
        $('#loan_balance_warning').hide();





        $(function () {
            $("#search_account").autocomplete({
                source: "<?php echo base_url('search_cooperator'); ?>",
            });

            $("#amount").keyup(function () {
                // entered_principal = entered_principal.replace(/,/g, '');
                // entered_principal = parseFloat(entered_principal);
                let amount = parseFloat($(this).val().replace(/,/g, ''));
               
                let balance = parseFloat($('#balance').val());
                
                let t = $('#transaction_type').val();

                if(t == 1){ //credit
                    let amount = parseFloat($('#amount').val().replace(/,/g, ''));

                    let balance = parseFloat($('#balance').val());

                    if(amount <= balance){

                        $('#reconciliation_submit').attr('disabled', false);
                        $('#reconciliation_warning').hide();
                        $('#mpr_div').show();
                        $('#mi_div').show();

                    }

                    if(amount > balance){
                        // $('#reconciliation_submit').hide();
                        $('#reconciliation_submit').attr('disabled', true);
                        $('#reconciliation_warning').show();
                        $("#c_t").empty();
                        $('#charge_warning').hide();

                    }
                  }


                if(t == 2){
                   
                   
                    // if(amount <= balance){
                    //     $('#reconciliation_submit').attr('disabled', false);
                    //     $('#reconciliation_warning').hide();
					//
					//
                    // }
					//
                    // if(amount > balance){
                    //     // $('#reconciliation_submit').hide();
                    //     $('#reconciliation_submit').attr('disabled', true);
                    //     $('#reconciliation_warning').show();
                    //     $("#c_t").empty();
                    //     $('#charge_warning').hide();
					//
                    // }
                }
               




            });
        });
    });

    function get_account_balance(){
        $("#balance_warning").hide();
        $("#balance").val(0);
        $("#b_t").empty()
        let t_staff_id =  $("#search_account").val();
        let ct_id = $("#ct_id").val();
        let staff_id = t_staff_id.split(',')[0];
        let type = 2;

        $.ajax({
            url: '<?php echo site_url('compute_balance') ?>',
            type: 'post',
            data: {
                'staff_id': staff_id,
                'ct_id': ct_id,
                'type': type
            },
            dataType: 'json',
            success:function(response){
                if(response.balance == 'fr'){
                    $('#reconciliation_submit').hide();
                    $("#balance_warning").show();
                    $("#b_t").append(response.note);
                    $('#freeze').hide();
                }else{
                    $('#freeze').show();
                    $("#balance_warning").show();
                    $("#b_t").append(response.note);
                    $("#balance").val(response.balance);
                    

                }

            }
        });

    }




    function get_loans(){
        let t_staff_id =  $("#search_account").val();
        let staff_id = t_staff_id.split(',')[0];
        $.ajax({
            url: '<?php echo site_url('get_al') ?>',
            type: 'post',
            data: {
                'staff_id': staff_id,
            },
            dataType: 'json',
            success:function(response){
                //console.log(response);
       
                $('#loan').empty();
                $('#loan').append('<option> -- Select Active Loans --</option>');
                for (var i=0; i<response.length; i++) {
                    $('#loan').append('<option value="' + response[i].loan_id + '">' + response[i].loan_description +' (Principal: '+ response[i].loan_principal +',  Outstanding: '+ response[i].loan_balance + ')'+ '</option>');

                    //$("#"+target_id).append('<option value="' + response[i].loan_id + '">' + response[i].loan_description + '</option>');
                }

            }
        });

    }

</script>
<?= $this->endSection() ?>


