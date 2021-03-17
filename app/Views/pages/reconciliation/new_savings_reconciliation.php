<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Savings Reconciliation
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Savings Reconciliation
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Savings Reconciliation
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
				<h2>New Savings Reconciliation</h2>
			</div>
			
			<div class="body">
				<form method="POST" enctype="multipart/form-data">
					
					<fieldset>
						<div class="row clearfix">
							<div class="col-lg-7 col-md-12">
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Staff ID or Name: </b></label>
									<input type="text" class="form-control"  id="search_account"  onblur="get_ct()"   required  name="staff_id" placeholder="Enter staff ID or  name">
								
								
								
								</div>
								
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Contribution Type: </b></label>
									
									<select class="custom-select" id="ct_id" required name="ct_id" onchange="get_account_balance()">
										<option disabled selected> -- Select Contribution Type --</option>
										
									</select>
								</div>
								<div class="alert alert-warning alert-dismissible" role="alert" id="balance_warning">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<i class="fa fa-warning"></i> <span id="b_t"></span>
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
										<input type="text" class="number form-control"  required  name="amount" id="withdraw_amount"  placeholder="Enter Amount">
										
										
										<input type="hidden" id="withdraw_balance" name="balance" >
										
										
									</div>
									
									<div class="alert alert-danger alert-dismissible" role="alert" id="withdraw_warning">
										<!--                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
										<i class="fa fa-warning"></i> Debit Amount is Greater than Savings Balance
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
										<button type="submit" id="withdraw_submit" disabled class="btn btn-info btn-block">Submit</button>
										
									
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
function change_label(){
    let transaction_type = document.getElementById('transaction_type').value;

    if(transaction_type == 1){ //credit
        $('#ac_ac').show();
        $("#action_ac").empty();
        $("#action_ac").append('Debit Account:');
        $('#withdraw_submit').show();
        $('#withdraw_submit').attr('disabled', false);
        $('#withdraw_warning').hide();

    } if(transaction_type == 2){ //debit

        let withdraw_amount = parseFloat($('#withdraw_amount').val().replace(/,/g, ''));

        let withdraw_balance = parseFloat($('#withdraw_balance').val());
        if(withdraw_amount <= withdraw_balance){
            $('#withdraw_submit').attr('disabled', false);
            $('#withdraw_warning').hide();


        }

        if(withdraw_amount > withdraw_balance){
            // $('#withdraw_submit').hide();
            $('#withdraw_submit').attr('disabled', true);
            $('#withdraw_warning').show();
            $("#c_t").empty();
            $('#charge_warning').hide();

        }
        
        $('#ac_ac').show();
        $("#action_ac").empty();
        $("#action_ac").append('Credit Account:');
   

    }
    
    if(transaction_type == 0){
        $('#ac_ac').hide();
        $('#withdraw_submit').hide();
	}


}
	
    $(document).ready(function() {
        $('#balance_warning').hide();
        $('#withdraw_submit').hide();
        $('#withdraw_warning').hide();
        $('#charge_warning').hide();
        $('#ac_ac').hide();





        $(function () {
            $("#search_account").autocomplete({
                source: "<?php echo base_url('search_cooperator'); ?>",
            });

            $("#withdraw_amount").keyup(function () {
                // entered_principal = entered_principal.replace(/,/g, '');
                // entered_principal = parseFloat(entered_principal);
                let withdraw_amount = parseFloat($(this).val().replace(/,/g, ''));
               
                let withdraw_balance = parseFloat($('#withdraw_balance').val());
                
                let t = $('#transaction_type').val();

                if(t == 1){
                    $('#withdraw_submit').attr('disabled', false);
                  }


                if(t == 2){
                    if(withdraw_amount <= withdraw_balance){
                        $('#withdraw_submit').attr('disabled', false);
                        $('#withdraw_warning').hide();


                    }

                    if(withdraw_amount > withdraw_balance){
                        // $('#withdraw_submit').hide();
                        $('#withdraw_submit').attr('disabled', true);
                        $('#withdraw_warning').show();
                        $("#c_t").empty();
                        $('#charge_warning').hide();

                    }
                }
               




            });
        });
    });

    function get_account_balance(){
        $("#balance_warning").hide();
        $("#withdraw_balance").val(0);
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
                    $('#withdraw_submit').hide();
                    $("#balance_warning").show();
                    $("#b_t").append(response.note);
                    $('#freeze').hide();
                }else{
                    $('#freeze').show();
                    $("#balance_warning").show();
                    $("#b_t").append(response.note);
                    $("#withdraw_balance").val(response.balance);
                    

                }

            }
        });

    }




    function get_ct(){
        let t_staff_id =  $("#search_account").val();
        let staff_id = t_staff_id.split(',')[0];
        $.ajax({
            url: '<?php echo site_url('get_ct') ?>',
            type: 'post',
            data: {
                'staff_id': staff_id,
            },
            dataType: 'json',
            success:function(response){
                $("#ct_id").empty();
                $("#ct_id").append('<option> -- Select Contribution Type --</option>');
                for (var i=0; i<response.length; i++) {
                    $("#ct_id").append('<option value="' + response[i].contribution_type_id + '">' + response[i].contribution_type_name + '</option>');
                }
                // console.log(response);
            }
        });

    }

</script>
<?= $this->endSection() ?>


