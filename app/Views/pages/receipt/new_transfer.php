<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
New Journal Transfer
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
New Journal Transfer
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
New Journal Transfer
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
				<h2>New Transfer</h2>
			</div>
			
			<div class="body">
				<form method="POST" enctype="multipart/form-data" id="receipt_form">
					<input type="hidden" id="withdraw_balance" name="withdraw_balance" >
					<fieldset>
						<div class="row clearfix">
							<div class="col-lg-7 col-md-12">
								<div class="form-group">
									
									<label> <b> Staff ID or Name: </b></label>
									<input type="text" class="form-control"  id="search_account"  onblur="get_cts()"   required  name="staff_id" placeholder="Enter staff ID or  name">
								
								
								
								</div>
								
								<div class="form-group">
									
									<label> <b> Contribution Type: </b></label>
									
									<select class="custom-select" id="ct_id" required name="ct_id" onchange="get_account_balance()">
										<option> -- Select Contribution Type --</option>
									
									</select>
								</div>
								<div class="alert alert-warning alert-dismissible" role="alert" id="balance_warning">
<!--									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
									<i class="fa fa-warning"></i> <span id="b_t"></span>
								</div>
								
								<div class="form-group">
									
									<label  > <b>Date: </b></label>
									<input type="date" class="form-control"  required  name="date"  placeholder="Enter date">
								
								</div>
								
								<div id="freeze">
									
									<div class="form-group">
										
										<label  > <b> Amount: </b></label>
										<input type="text" class="number form-control"  required  name="master_amount" id="withdraw_amount"  placeholder="Enter Amount">
										
										
										
										
										
										
										
									</div>
									
									<div class="alert alert-warning alert-dismissible" role="alert" id="charge_warning">
<!--										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
										<i class="fa fa-warning"></i> <span id="c_t"></span>
									</div>
									<!--                                <div class="form-group">-->
									<!--                                    <label for="application_first_name"><b>Date:</b></label>-->
									<!--                                    <input type="date"  class="form-control" placeholder="Date" name="withdraw_date" required>-->
									<!--                                </div>-->
									<input type="hidden"  class="form-control" placeholder="Date" name="withdraw_date" value="<?=date('Y-m-d') ?>" required>
									
									
									<!--                                <div class="form-group">-->
									<!--                                    <label for="application_address"><b>Narration:</b></label>-->
									<!--                                    <textarea name="withdraw_narration" id="withdraw_narration"  cols="30" rows="3" placeholder="Narration "  class="form-control no-resize"></textarea>-->
									<!--                                </div>-->
									
									
									
									<?= csrf_field() ?>
									<div class="form-group">
										
										<div class="alert alert-danger alert-dismissible" role="alert" id="withdraw_warning">
											<!--                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>-->
											<i class="fa fa-warning"></i>  Amount is Greater than Savings Balance
										</div>
									
									</div>
								</div>
							
							</div>
						
						
						</div>
						<div class="row clearfix">
							<div class="col-lg-7 col-md-12">
								
							
								
<div id="payments">
									<br>
									<b><hr></b>
									
				<div id="payment_details1">
						
						
					
							<button type="button" onclick="delete_div(this)"  class="btn btn-danger"><i class="fa fa-minus-square"></i></button>
						
						
					
								
								<div class="form-group">
									
									<label> <b> Amount: </b></label>
									<input type="text" class="number form-control"  required  name="payment_amount[]" id="payment_amount1" onkeyup="compute_balance()"  placeholder="Enter Amount">
								
								
								</div>
								<div class="form-group">
									
									<label> <b> Payment Type: </b></label>
									
									<select class="custom-select" id="payment_type1" onchange="get_ct(this)"  name="payment_type[]" required >
										<option> -- Payment Type --</option>
										<option value="1"> Loan </option>
										<option value="2"> Savings </option>
									</select>
								</div>
					
					
					<div class="form-group">
						
						<label> <b> Target: </b></label>
						
						<select class="custom-select" id="target1" name="target[]"  required>
						
						</select>
					</div>
				
				
				
				
				
				
				
				
				</div>
					
					
					
					<div class="form-group" id="clone_button" style="float: right">
					
						<button type="button" onclick="clone_div(this)"   class="btn btn-success"><i class="fa fa-plus-square"> </i></button>
								
						
					</div>
</div>
								
								<div class="form-group">
									<button type="submit" id="transfer_submit" class="btn btn-info btn-block">Submit</button>
								
								
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

    let clones_id = [1];
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
                let withdraw_balance = parseFloat($('#withdraw_balance').val());
               
                // alert(withdraw_balance);
                if(withdraw_amount <= withdraw_balance){
                    $('#withdraw_submit').show();
                    $('#withdraw_warning').hide();
              
                    $('#transfer_submit').show();
                    $('#payments').show();
                  

                    // alert(withdraw_balance);
                }

                if(withdraw_amount > withdraw_balance){
                    $('#withdraw_submit').hide();
                    $('#withdraw_warning').show();
                    $('#transfer_submit').hide();
                    $('#payments').hide();
                    $("#c_t").empty();
                    $('#charge_warning').hide();
                    //alert(withdraw_balance);
                }




            });

            $("#receipt_form").submit(function (e) {
          
            e.preventDefault();

                let master_amount = parseFloat($('#withdraw_amount').val().replace(/,/g, ''));

                let master_inputs = $("#payments").find("select, input");
                //console.log(master_inputs.length);
                let index;
                let payment_amount = 0;
                for (index = 0; index < master_inputs.length; ++index) {
                    if (master_inputs[index].name === 'payment_amount[]') {
                        // console.log('i changed target');

                        payment_amount =  parseFloat(master_inputs[index].value.replace(/,/g, '')) + payment_amount;

                        
                    }

                    
                }

                if(payment_amount === master_amount){
                    if(master_amount !== 0){

                        if((payment_amount < master_amount)) {
                            alert('Sum of detail amount must equal master amount')
                        }

                        if(payment_amount > master_amount){
                            alert('Detail amount cannot be greater than master amount')
                        }

                        if(payment_amount === master_amount) {
                            //using jquery to submit the form here, would cause a recursive error. test at your peril.
                            document.getElementById("receipt_form").submit();

                        }

                    }

                    else{
                        alert('Master amount cannot be 0')
                    }
                }

                if(payment_amount !== master_amount){
                    if(master_amount !== 0){

                        if((payment_amount < master_amount)) {
                            alert('Sum of detail amount must equal master amount')
                        }

                        if(payment_amount > master_amount){
                            alert('Detail amount cannot be greater than master amount')
                        }

                        if(payment_amount === master_amount) {
                            //using jquery to submit the form here, would cause a recursive error. test at your peril.
                            document.getElementById("receipt_form").submit();

                        }

                    }

                    else{
                        alert('Master amount cannot be 0')
                    }
                }

                //console.log(payment_amount);


            });
            
            
        });
    });


    function clone_div() {
        let master_amount = parseFloat($('#withdraw_amount').val().replace(/,/g, ''));
        let master_inputs = $("#payments").find("select, input");
        //console.log(master_inputs.length);
        let index;
        let payment_amount = 0;
        for (index = 0; index < master_inputs.length; ++index) {
            if (master_inputs[index].name === 'payment_amount[]') {
                // console.log('i changed target');
                payment_amount =  parseFloat(master_inputs[index].value.replace(/,/g, '')) + payment_amount;
              }
        }

        if(payment_amount >= master_amount){
            alert('Cannot add new fields detail sum already equal to master sum ')

        }
        if(payment_amount < master_amount){
            let elem = document.getElementById('payment_details1');
            if (elem.style.display === 'none') {
                elem.style.display = 'block';
            }
            else {
                // Create a copy of it
                let clone = elem.cloneNode(true);
                // Update the ID and add a class
                let count_clones = clones_id.length;
                let count_cloness = count_clones + 1;

                let n = clones_id.includes(count_cloness);

                while(n === true){
                    count_cloness = count_cloness + 1;
                    n = clones_id.includes(count_cloness);
                }

                clone.id = 'payment_details'+count_cloness;
                // document.getElementById('work_experiences').appendChild(clone);
                let payments = document.getElementById('payments');

                let clone_button = document.getElementById('clone_button');
                //clone.insertBefore(work_experience_button);
                payments.insertBefore(clone, clone_button)
                clones_id.push(count_cloness)

                let new_elem = document.getElementById('payment_details'+count_clones);
                // Inject it into the DOM


                // inputs = elem.getElementsByTagName('textarea');
                // for (index = 0; index < inputs.length; ++index) {
                //     // if(inputs[index].type == 'textarea')
                //     inputs[index].value = '';
                // }
                // var textarea = elem.getElementsByTagName('textarea');
                // textarea.value = '';

                // console.log(new_elems);
                elem.after(new_elem);


                //document.getElementById('temp_id').id = "target"+count_cloness ;
                //document.getElementById('payment_type1').id = "payment_type"+count_cloness ;
                //console.log(clones_id);



                let new_id = 'payment_details'+count_cloness;

                let inputs = $("#" + new_id).find("select, input");
                let index;
                for (index = 0; index < inputs.length; ++index) {
                    if (inputs[index].name === 'target[]') {
                        // console.log('i changed target');
                        inputs[index].id = "target" + count_cloness;
                        inputs[index].value = '';
                    }

                }

                for (index = 0; index < inputs.length; ++index) {
                    if (inputs[index].name === 'payment_type[]') {
                        //console.log('i changed payment type');
                        inputs[index].id = "payment_type" + count_cloness;
                        inputs[index].value = '';
                    }
                }

                for (index = 0; index < inputs.length; ++index) {
                    if (inputs[index].name === 'payment_amount[]') {
                        inputs[index].id = "payment_amount" + count_cloness;
                        inputs[index].value = '';
                    }
                }



            }

        }
        //console.log(payment_amount);
        
        
        
       
    }

    function delete_div(e) {
        let id = e.parentElement.id;
        if (id === 'payment_details1') {
            // let elem = document.getElementById('payment_details1');
            // let inputs = elem.getElementsByTagName('input');
            // let index;
            // for (index = 0; index < inputs.length; ++index) {
            //     if (inputs[index].type == 'text')
            //         inputs[index].value = '';
            // }
            // inputs = elem.getElementsByTagName('input');
            // for (index = 0; index < inputs.length; ++index) {
            //     if (inputs[index].type == 'date')
            //         inputs[index].value = '';
            // }
			//
            // inputs = elem.getElementsByTagName('textarea');
            // for (index = 0; index < inputs.length; ++index) {
            //     // if(inputs[index].type == 'textarea')
            //     inputs[index].value = '';
            // }
            // // var textarea = elem.getElementsByTagName('textarea');
            // // textarea.value = '';
            // elem.style.display = 'none';
			alert('cannot remove');
        } else {

            let id_array = id.replace( /^\D+/g, '');
            id_array = parseInt(id_array);
           // alert(id_array)
            const index = clones_id.indexOf(id_array);
            if (index > -1) {
                clones_id.splice(index, 1);
            }
			//console.log(clones_id);
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
                $("#balance_warning").show();
                $("#b_t").append(response.note);
                $("#withdraw_balance").val(response.balance);
                console.log(response)
            }
        });
	
    }

    function get_ct(e){
        let t_staff_id =  $("#search_account").val();
        
        let staff_id = t_staff_id.split(',')[0];
        
        let element_id = e.id;

        element_id = element_id.replace( /^\D+/g, '');
        
        let payment_type = parseInt(e.value);
        
        //console.log(element_id);
        
        if(payment_type === 1){ //loan type
            $.ajax({
                url: '<?php echo site_url('get_al') ?>',
                type: 'post',
                data: {
                    'staff_id': staff_id,
                },
                dataType: 'json',
                success:function(response){
                    //console.log(response);
                    let target_id = "target"+element_id
                    $("#"+target_id).empty();
                    $("#"+target_id).append('<option> -- Select Active Loans --</option>');
                    for (var i=0; i<response.length; i++) {
                        $("#"+target_id).append('<option value="' + response[i].loan_id + '">' + response[i].loan_description +' (Principal: '+ response[i].loan_principal +',  Outstanding: '+ response[i].loan_balance + ')'+ '</option>');

                        //$("#"+target_id).append('<option value="' + response[i].loan_id + '">' + response[i].loan_description + '</option>');
                    }

                }
            });
        
		}

        if(payment_type === 2){ //savings type
            $.ajax({
                url: '<?php echo site_url('get_ct') ?>',
                type: 'post',
                data: {
                    'staff_id': staff_id,
                },
                dataType: 'json',
                success:function(response){
                    //console.log(response);
                    let target_id = "target"+element_id
                    $("#"+target_id).empty();
                    $("#"+target_id).append('<option> -- Select Contribution Type --</option>');
                    for (var i=0; i<response.length; i++) {
                        $("#"+target_id).append('<option value="' + response[i].contribution_type_id + '">' + response[i].contribution_type_name + '</option>');
                    }
                   
                }
            });

        }
      
     

    }
    
    function compute_balance(){
        
        let master_amount = parseFloat($('#withdraw_amount').val().replace(/,/g, ''));
        
        let master_inputs = $("#payments").find("select, input");
        //console.log(master_inputs.length);
        let index;
        let payment_amount = 0;
        for (index = 0; index < master_inputs.length; ++index) {
            if (master_inputs[index].name === 'payment_amount[]') {
                // console.log('i changed target');
                // let cVal = master_inputs[index].value;
				//
                // master_inputs[index].value = cVal.toLocaleString();
                // console.log(master_inputs[index].value)
               payment_amount =  parseFloat(master_inputs[index].value.replace(/,/g, '')) + payment_amount;
               
               if(payment_amount > master_amount){
					alert('Detail sum amount exceeds master amount ')
                   master_inputs[index].value = '';
			   }else{

                   var currentVal =  master_inputs[index].value;
                   var testDecimal = testDecimals(currentVal);
                   if (testDecimal.length > 1) {
                       //console.log("You cannot enter more than one decimal point");
                       currentVal = currentVal.slice(0, -1);
                   }
                   master_inputs[index].value = replaceCommas(currentVal);
                   
                   
                   //master_inputs[index].value = 'aaaaa';
                   //console.log(master_inputs[index].value.toLocaleString());
			   }
            }

        }
        //console.log(payment_amount);
	}

    function testDecimals(currentVal) {
        var count;
        currentVal.match(/\./g) === null ? count = 0 : count = currentVal.match(/\./g);
        return count;
    }

    function replaceCommas(yourNumber) {
        var components = yourNumber.toString().split(".");
        if (components.length === 1)
            components[0] = yourNumber;
        components[0] = components[0].replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if (components.length === 2)
            components[1] = components[1].replace(/\D/g, "");
        return components.join(".");
    }


   


    function get_cts(){
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


