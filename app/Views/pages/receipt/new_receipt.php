<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
New Receipt
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
New Receipt
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
New Receipt
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
				<h2>New Receipt</h2>
			</div>
			
			<div class="body">
				<form method="POST" enctype="multipart/form-data">
					
					<fieldset>
						<div class="row clearfix">
							<div class="col-lg-7 col-md-12">
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Staff ID or Name: </b></label>
									<input type="text" class="form-control"  id="search_account"  onblur="get_ct()"   required  name="withdraw_staff_id" placeholder="Enter staff ID or  name">
								
								
								
								</div>
								
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b>Date: </b></label>
									<input type="date" class="number form-control"  required  name="withdraw_amount" id="withdraw_amount"  placeholder="Enter Amount">
									
								</div>
								
								
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Amount: </b></label>
									<input type="text" class="number form-control"  required  name="withdraw_amount" id="withdraw_amount"  placeholder="Enter Amount">
									
									
								</div>
								
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Payment Method: </b></label>
									
									<select class="custom-select"  required name="withdraw_ct_id">
										<option disabled selected> -- Select payment method --</option>
										<option value="1"> Cheque </option>
									</select>
								</div>
								
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Coop Banks: </b></label>
									
									<select class="custom-select" id="ct_id" required name="withdraw_ct_id">
										<option disabled selected> -- Select bank --</option>
										<?php foreach ($cbs as $cb): ?>
										<option value="<?=$cb->coop_bank_id ?>"> <?=$cb->bank_name ?> - <?=$cb->branch; ?> </option>
										<?php endforeach; ?>
									</select>
						
								</div>
								
								<div id="payments">
									<br>
									<b><hr></b>
									<div id="payment_details">
						
						
					
							<button type="button" onclick="delete_div(this)"  class="btn btn-danger"><i class="fa fa-minus-square"></i></button>
						
						
					
								
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Amount: </b></label>
									<input type="text" class="number form-control"  required  name="withdraw_amount" id="withdraw_amount"  placeholder="Enter Amount">
								
								
								</div>
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b> Payment Type: </b></label>
									
									<select class="custom-select" id="ct_id" required name="withdraw_ct_id">
										<option> -- Payment Type --</option>
										<option value="1"> Loan </option>
										<option value="2"> Savings </option>
									</select>
								</div>
						
							
								
								<?= csrf_field() ?>
						
						
						
						</div>
										<div class="form-group" id="clone_button" style="float: right">
									<button type="button" onclick="clone_div(this)"   class="btn btn-success"><i class="fa fa-plus-square"> </i></button>
								
								
								</div>
								
								</div>
								
								<div class="form-group">
									<button type="submit"  class="btn btn-info btn-block">Submit</button>
								
								
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

    $(document).ready(function() {
        $('#balance_warning').hide();
        $('#withdraw_submit').hide();
        $('#withdraw_warning').hide();
        $('#charge_warning').hide();





        $(function () {
            $("#search_account").autocomplete({
                source: "<?php echo base_url('search_cooperator'); ?>",
            });

            $("#withdraw_amount").keyup(function () {
                // entered_principal = entered_principal.replace(/,/g, '');
                // entered_principal = parseFloat(entered_principal);
                let withdraw_amount = parseFloat($(this).val().replace(/,/g, ''));
                let withdraw_charge = parseFloat($('#withdraw_charge').val());
                let withdraw_balance = parseFloat($('#withdraw_balance').val());
                let charge = (withdraw_charge/100)*withdraw_amount;
                // alert(withdraw_balance);
                if(withdraw_amount <= withdraw_balance){
                    $('#withdraw_submit').show();
                    $('#withdraw_warning').hide();
                    $('#charge_warning').show();
                    $("#c_t").empty();
                    $("#c_t").append('Withdraw Charges: '+' NGN'+charge.toLocaleString());

                    // alert(withdraw_balance);
                }

                if(withdraw_amount > withdraw_balance){
                    $('#withdraw_submit').hide();
                    $('#withdraw_warning').show();
                    $("#c_t").empty();
                    $('#charge_warning').hide();
                    //alert(withdraw_balance);
                }




            });
        });
    });


    function clone_div() {
        let elem = document.getElementById('payment_details');
        if (elem.style.display == 'none') {
            elem.style.display = 'block';
        } else {
            // Create a copy of it
            let clone = elem.cloneNode(true);
            // Update the ID and add a class
            clone.id = 'payment_details1';
            // document.getElementById('work_experiences').appendChild(clone);
            let payments = document.getElementById('payments');

            let clone_button = document.getElementById('clone_button');
            //clone.insertBefore(work_experience_button);
            payments.insertBefore(clone,clone_button)
            // Inject it into the DOM
            elem.after(clone);
        }
    }

    function delete_div(e) {
        let id = e.parentElement.id;
        if (id == 'payment_details1') {
            let elem = document.getElementById('payment_details1');
            let inputs = elem.getElementsByTagName('input');
            let index;
            for (index = 0; index < inputs.length; ++index) {
                if (inputs[index].type == 'text')
                    inputs[index].value = '';
            }
            inputs = elem.getElementsByTagName('input');
            for (index = 0; index < inputs.length; ++index) {
                if (inputs[index].type == 'date')
                    inputs[index].value = '';
            }

            inputs = elem.getElementsByTagName('textarea');
            for (index = 0; index < inputs.length; ++index) {
                // if(inputs[index].type == 'textarea')
                inputs[index].value = '';
            }
            // var textarea = elem.getElementsByTagName('textarea');
            // textarea.value = '';
            elem.style.display = 'none';
        } else {
            e.parentElement.remove();
        }
    }
    
    

    function get_account_balance(){
        $("#balance_warning").hide();
        $("#withdraw_balance").val(0);
        $("#b_t").empty()
        let t_staff_id =  $("#search_account").val();
        let ct_id = $("#ct_id").val();
        let staff_id = t_staff_id.split(',')[0];

        $.ajax({
            url: '<?php echo site_url('compute_balance') ?>',
            type: 'post',
            data: {
                'staff_id': staff_id,
                'ct_id': ct_id
            },
            dataType: 'json',
            success:function(response){
                $("#balance_warning").show();
                $("#b_t").append(response.note);
                $("#withdraw_balance").val(response.balance);
                console.log(response)
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


