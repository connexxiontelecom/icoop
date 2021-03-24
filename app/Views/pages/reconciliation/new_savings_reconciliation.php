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
							<div class="col-lg-6 col-md-12">
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
									
									<div class="form-group">
										<label for="application_first_name"><b> Transaction Date:</b></label>
										<input type="date"  class="form-control" placeholder="Date" name="date" required>
									</div>
									<div class="form-group">
										<label for="application_address"><b>Narration:</b></label>
										<textarea name="narration" id="withdraw_narration"  cols="30" rows="3" placeholder="Narration "  class="form-control no-resize"></textarea>
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
							
							<div class="col-lg-6 col-md-12" id="statement" style="height: 650px; overflow-y: auto;">
							
							
							</div>
						
						
						</div>
					</fieldset>
				
				
				</form>
			</div>
		</div>
	</div>
	
	<div class="modal fade" id="verifyModal<?=$withdrawal['withdraw_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title h4" id="myLargeModalLabel">Verify Withdrawal</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">
					<form method="post" action="">
						<div class="row clearfix">
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
									<label>Staff ID:</label>
									<input class="form-control" value="<?=$withdrawal['withdraw_staff_id']; ?>" name="pg_name" disabled readonly>
								</div>
							</div>
							
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
									<label>Staff Name:</label>
									<input class="form-control" value="<?=$withdrawal['cooperator_first_name']." ".$withdrawal['cooperator_last_name']; ?>" disabled readonly>
								</div>
							</div>
						</div>
						<div class="row clearfix">
							<div class="col-lg-6 col-md-12">
								<div class="form-group">
									<label>Contribution Type:</label>
									<input class="form-control" value="<?=$withdrawal['contribution_type_name']; ?>" disabled readonly>
								</div>
							</div>
							
							
							<div class="col-lg-6 col-md-12">
								
								<div class="form-group">
									<label>Balance:</label>
									<input class="form-control" value="<?=number_format($withdrawal['balance']); ?>" disabled readonly>
								</div>
							</div>
						</div>
						
						<div class="form-group">
							<label>Amount:</label>
							<input class="form-control" value="<?=number_format($withdrawal['withdraw_amount']); ?>" disabled readonly>
						</div>
						<?php if(!empty($withdrawal['withdraw_doc'])): ?>
							
							<div class="form-group">
								
								<button type="button" class="btn btn-primary mb-2" onclick="window.open('<?php echo base_url('.uploads/withdrawals')."/".$withdrawal['withdraw_doc'];?>', '_blank')" ><i class="fa fa-paperclip"></i> <span>View Attachment</span></button>
							
							</div>
						
						<?php endif; ?>
						
						<input type="hidden" name="withdraw_status" value="1">
						
						<input type="hidden" name="withdraw_id" value="<?=$withdrawal['withdraw_id']; ?>">
						
						<div class="form-group">
							<label for="application_address">Comment:</label>
							<textarea name="withdraw_verify_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
						</div>
						
						<?= csrf_field() ?>
						<div class="form-group">
							<button type="submit" class="btn btn-info btn-block">Verify</button>
						</div>
					</form>
				</div>
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
            // $('#withdraw_submit').attr('disabled', true);
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
        // $('#withdraw_submit').hide();
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
                        // $('#withdraw_submit').attr('disabled', true);
                        $('#withdraw_warning').show();
                        // $("#c_t").empty();
                        // $('#charge_warning').hide();

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
                    $('#statement').empty();
                    let content = '<div class="table-responsive">' +
						'<div class="header">\n' +
                        '\t\t\t\t<h2>Account Statement</h2>\n' +
                        '\t\t\t</div>' +
						'<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5" > ' +
						'<thead>\n' +
                        '                        <tr>\n' +
                        '                            <th><strong># </strong></th>\n' +
                        '                            <th><strong>Date</strong></th>\n' +
                        '                            <th style="text-align: left"><strong>Narration</strong></th>\n' +
                        '                            <th style="text-align: right"><strong>Dr</strong></th>\n' +
                        '                            <th style="text-align: right"><strong>Cr</strong></th>\n' +
                        '                            <th style="text-align: right"><strong>Balance</strong></th>\n' +
                        '\n' +
                        '\n' +
                        '\n' +
                        '                        </tr>\n' +
                        '                    </thead> '
                    let total_cr = 0;
                    let total_dr = 0;
                    let bf = 0;
                    let cr = 0;
                    let dr = 0;
					for(i=1; i<response.ledgers.length; i++){
                        content += '<tr>' +
							'<td>' +  i + '</td>' +
                            '<td>' +  response.ledgers[i].pd_transaction_date + '</td>'+
                        '<td>' +  response.ledgers[i].pd_narration + '</td>'
							
						if(response.ledgers[i].pd_drcrtype == 1){
                            cr =  response.ledgers[i].pd_amount;
                            content += '<td> 0 </td>' +
                                '<td>' + cr.toLocaleString() + '</td>'
							
							}
                        if(response.ledgers[i].pd_drcrtype == 2){
                            dr =  response.ledgers[i].pd_amount;
                            content += '<td>' +  dr.toLocaleString() + '</td>' +
                            '<td> 0 </td>'
                                                   }
                      
                       bf = (bf + cr) - dr;
                        content += '<td>' +  parseFloat(bf)  + '</td>' +
							'</tr>';
                    }
                    content += '</table> </div>'

                    $('#statement').append(content);
                    
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


