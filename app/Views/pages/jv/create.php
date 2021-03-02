<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
New Journal Voucher
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
New Journal Voucher 
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
New Journal Voucher
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>
    <style>
        td.details-control {
            background: url('assets/images/details_open.png') no-repeat center center;
            cursor: pointer;
        }
        tr.shown td.details-control {
            background: url('assets/images/details_close.png') no-repeat center center;
        }
    </style>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />

<link rel="stylesheet" href="assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>
<link rel="stylesheet" href="assets/css/toastify.min.css"/>

<!--<link rel="stylesheet" type="text/css" href="/assets/css/datatable.min.css"> -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="row clearfix">
    
    <div class="col-lg-12">
        <div class="card">
            <div class="header">
                <h2>New Journal Voucher</h2>
            </div>
            <a href="<?= site_url('/add-new-chart-of-account') ?>" class="btn btn-sm btn-primary float-right mb-3">Add New Account</a>
            <div class="body">
            <h5 class="sub-title">New Journal Entry</h5>
                    <form action="<?php site_url('new-journal-voucher')?>" method="post">
                        <?= csrf_field() ?>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Date</label>
                                            <input type="date" placeholder="Date" class="form-control" name="issue_date">
                                            
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-6">
                                        <div class="form-group">
                                            <label for="">Entry #</label>
                                            <input type="text"  name="entry_no" value="<?=$jv_entry; ?>" readonly placeholder="Entry #" class="form-control">
                                           
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
						
						<div class="row clearfix">
							<div class="row">
								<div class="col-sm-6">
									
									<div class="card">
										<div class="header">
											<h2>Credit</h2>
										</div>
										
										<div class="card-body">
											<div id="credits">
										
												<div id="credit1">
											
													<button style="margin-bottom: 5%" type="button" onclick="delete_div(this)"  class="btn btn-danger"><i class="fa fa-minus-square"></i></button>
											
											<div class="row">
												
												<div class="col-lg-4 col-md-4">
													<div class="form-group">
														<label  for="application_payroll_group_id"> <b> Account: </b></label>
														<select name="credit_account[]" id="credit_account1" class="custom-select">
															<option disabled selected>Select account</option>
															<?php foreach($accounts as $account) : ?>
																<option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?? ''?> - <?= $account['glcode'] ?? ''?> </option>
															<?php endforeach; ?>
														</select>
													</div>
												</div>
												
												<div class="col-lg-4 col-md-4">
													<div class="form-group">
														<label  for="application_payroll_group_id"> <b> Credit Narration: </b></label>
														<input type="text" name="credit_narration[]" id="credit_narration1" class="form-control" placeholder="Narration">
													
													</div>
												</div>
												
												<div class="col-lg-4 col-md-4">
													<div class="form-group">
														<label  for="application_payroll_group_id"> <b> Credit Amount: </b></label>
														<input type="text" class="number form-control" id="credit_amount1" placeholder="Credit Amount" value="0"  name="credit_amount[]">
													</div>
												</div>
											</div>
											</div>
										
												
												<div class="form-group" id="clone_button" style="float: right">
													
													<button type="button" onclick="clone_div_cr(this)"   class="btn btn-success"><i class="fa fa-plus-square"> </i></button>
												
												
												</div>
											</div>
										</div>
									</div>
									
								</div>
								
								<div class="col-sm-6">
									
									<div class="card">
										<div class="header">
											<h2>Debit</h2>
										</div>
										
										<div class="body">
											
											<div id="debits">
												
												<div id="debit1">
													
													<button style="margin-bottom: 5%" type="button" onclick="delete_div(this)"  class="btn btn-danger"><i class="fa fa-minus-square"></i></button>
													
													<div class="row">
														
														<div class="col-lg-4 col-md-4">
															<div class="form-group">
																<label  for="application_payroll_group_id"> <b> Account: </b></label>
																<select name="debit_account[]" id="debit_account1" class="custom-select">
																	<option disabled selected>Select account</option>
																	<?php foreach($accounts as $account) : ?>
																		<option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?? ''?> - <?= $account['glcode'] ?? ''?> </option>
																	<?php endforeach; ?>
																</select>
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="form-group">
																<label  for="application_payroll_group_id"> <b> Debit Narration: </b></label>
																<input type="text" name="debit_narration[]" id="debit_narration1" class="form-control" placeholder="Narration">
															
															</div>
														</div>
														
														<div class="col-lg-4 col-md-4">
															<div class="form-group">
																<label  for="application_payroll_group_id"> <b> Debit Amount: </b></label>
																<input type="text" class="number form-control" id="debit_amount1" placeholder="Credit Amount" value="0"  name="debit_amount[]">
															</div>
														</div>
													</div>
												</div>
												
												
												<div class="form-group" id="clone_dr_button" style="float: right">
													
													<button type="button" onclick="clone_div_dr(this)"   class="btn btn-success"><i class="fa fa-plus-square"> </i></button>
												
												
												</div>
											</div>
											
										</div>
									</div>
									
								</div>
							</div>
						</div>
						
						
                      
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="table-responsive">
                                    <table class="table  invoice-detail-table">
                                        <thead>
                                        <tr class="thead-default">
                                            <th>Account</th>
                                            <th>Debit</th>
                                            <th>Credit</th>
                                            <th>Narration</th>
                                            <th>Name</th>
                                        </tr>
                                        </thead>
                                        <tbody id="products">
                                                <tr class="item">
                                                <td>
                                                    <div class="form-group">
                                                        <select name="account[]" class="text-white  account js-example-basic-single select-account form-control">
                                                            <option disabled selected>Select account</option>
                                                            <?php foreach($accounts as $account) : ?>
                                                                    <option value="<?= $account['glcode'] ?>"><?= $account['account_name'] ?? ''?> - <?= $account['glcode'] ?? ''?> </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="0.01" placeholder="Debit Amount" class="form-control debit-amount" value="0"  name="debit_amount[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" step="0.01" placeholder="Credit Amount" class="form-control credit-amount" value="0"  name="credit_amount[]">
                                                    </div>
                                                </td>
                                                <td>
                                                    <input type="text" name="narration[]" class="form-control" placeholder="Narration">
                                                </td>
                                                <td>
                                                    <input type="text" name="name[]" class="form-control" placeholder="Name">
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <button class="btn btn-mini btn-primary add-line"> <i class="ti-plus mr-2"></i> Add Line</button>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-12 col-sm-12 col-lg-12">
                                <table class="table  invoice-detail-table">
                                    <tr>
                                        <td colspan="3" class="text-right"><strong style="font-size:14px; text-transform:uppercase; text-align: right;">Total:</strong></td>
                                        <td class="text-right drTotal">0.00

                                        </td>
                                        <td class="text-center crTotal"> 00

                                        </td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                        <td class="text-center"></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="btn-group d-flex justify-content-center">
                                    <input type="hidden" id="drTotalHidden">
                                    <input type="hidden" id="crTotalHidden">
                                    <a href="" class="btn btn-mini btn-danger"><i class="ti-close mr-2"></i>Cancel</a>
                                    <button type="submit" class="btn btn-primary save-entry btn-mini"><i class="ti-check mr-2"> Save</i></button>
                                </div>
                            </div>
                        </div>
                    </form>
            </div>
    </div>
</div>


<?= $this->endSection() ?>

<?= $this->section('extra-scripts') ?>
<script src="assets/bundles/vendorscripts.bundle.js"></script>

<script src="assets/bundles/datatablescripts.bundle.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/dataTables.buttons.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.bootstrap4.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.colVis.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.html5.min.js"></script>
<script src="assets/vendor/jquery-datatable/buttons/buttons.print.min.js"></script>
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script src="assets/js/common.js"></script>
<script src="assets/js/pages/tables/jquery-datatable.js"></script>
<script src="assets/js/axios.min.js"></script>
<script src="assets/js/toastify.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    let clones_id = [1];
    let clones_ids = [1];
    
    function clone_div_cr() {
        let elem = document.getElementById('credit1');
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

            clone.id = 'credit'+count_cloness;
            // document.getElementById('work_experiences').appendChild(clone);
            let payments = document.getElementById('credits');

            let clone_button = document.getElementById('clone_button');
            //clone.insertBefore(work_experience_button);
            payments.insertBefore(clone, clone_button)
            clones_id.push(count_cloness)

            let new_elem = document.getElementById('credit'+count_clones);
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



            let new_id = 'credit'+count_cloness;

            let inputs = $("#" + new_id).find("select, input");
            let index;
            for (index = 0; index < inputs.length; ++index) {
                if (inputs[index].name === 'credit_account') {
                    // console.log('i changed target');
                    inputs[index].id = "credit_account" + count_cloness;
                    inputs[index].value = '';
                }

            }

            for (index = 0; index < inputs.length; ++index) {
                if (inputs[index].name === 'credit_narration[]') {
                    //console.log('i changed payment type');
                    inputs[index].id = "credit_narration" + count_cloness;
                    inputs[index].value = '';
                }
            }

            for (index = 0; index < inputs.length; ++index) {
                if (inputs[index].name === 'credit_amount[]') {
                    inputs[index].id = "credit_amount" + count_cloness;
                    inputs[index].value = '';
                }
            }



        }
        //let master_amount = parseFloat($('#master_amount').val().replace(/,/g, ''));
        //let master_inputs = $("#payments").find("select, input");
        //console.log(master_inputs.length);
       // let index;
       // let payment_amount = 0;
       //  for (index = 0; index < master_inputs.length; ++index) {
       //      if (master_inputs[index].name === 'payment_amount[]') {
       //          // console.log('i changed target');
       //          payment_amount =  parseFloat(master_inputs[index].value.replace(/,/g, '')) + payment_amount;
       //      }
       //  }

        
        //console.log(payment_amount);




    }

    function clone_div_dr() {
        let elem = document.getElementById('debit1');
        if (elem.style.display === 'none') {
            elem.style.display = 'block';
        }
        else {
            // Create a copy of it
            let clone = elem.cloneNode(true);
            // Update the ID and add a class
            let count_clones = clones_ids.length;
            let count_cloness = count_clones + 1;

            let n = clones_id.includes(count_cloness);

            while(n === true){
                count_cloness = count_cloness + 1;
                n = clones_id.includes(count_cloness);
            }

            clone.id = 'debit'+count_cloness;
            // document.getElementById('work_experiences').appendChild(clone);
            let payments = document.getElementById('debits');

            let clone_button = document.getElementById('clone_dr_button');
            //clone.insertBefore(work_experience_button);
            payments.insertBefore(clone, clone_button)
            clones_id.push(count_cloness)

            let new_elem = document.getElementById('debit'+count_clones);
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



            let new_id = 'debit'+count_cloness;

            let inputs = $("#" + new_id).find("select, input");
            let index;
            for (index = 0; index < inputs.length; ++index) {
                if (inputs[index].name === 'debit_account') {
                    // console.log('i changed target');
                    inputs[index].id = "debit_account" + count_cloness;
                    inputs[index].value = '';
                }

            }

            for (index = 0; index < inputs.length; ++index) {
                if (inputs[index].name === 'debit_narration[]') {
                    //console.log('i changed payment type');
                    inputs[index].id = "debit_narration" + count_cloness;
                    inputs[index].value = '';
                }
            }

            for (index = 0; index < inputs.length; ++index) {
                if (inputs[index].name === 'debit_amount[]') {
                    inputs[index].id = "debit_amount" + count_cloness;
                    inputs[index].value = '';
                }
            }



        }
        //let master_amount = parseFloat($('#master_amount').val().replace(/,/g, ''));
        //let master_inputs = $("#payments").find("select, input");
        //console.log(master_inputs.length);
        // let index;
        // let payment_amount = 0;
        //  for (index = 0; index < master_inputs.length; ++index) {
        //      if (master_inputs[index].name === 'payment_amount[]') {
        //          // console.log('i changed target');
        //          payment_amount =  parseFloat(master_inputs[index].value.replace(/,/g, '')) + payment_amount;
        //      }
        //  }


        //console.log(payment_amount);




    }

    function delete_div(e) {
        let id = e.parentElement.id;
        if ((id === 'credit1') || (id === 'debit1')) {
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
	
	
        var debitTotal = 0;
        var creditTotal = 0;
        $(document).ready(function(){
            $(".select-account").select2({
                placeholder: "Select account"
            });
            //updateStatus();
            var grand_total = 0;
            var invoice_total = 0;

            $('#creditTotal').text(creditTotal);
            $('#debitTotal').text(debitTotal);
            $(document).on('click', '.add-line', function(e){
                e.preventDefault();
                var new_selection = $('.item').first().clone();
                $('#products').append(new_selection);

                $(".select-account").select2({
                    placeholder: "Select account"
                });
                $(".select-account").last().next().next().remove();
            });

            //Remove line
            $(document).on('click', '.remove-line', function(e){
                e.preventDefault();
                $(this).closest('tr').remove();
                calculateTotals();
            });
            $("body").on('focusout', '.debit-amount', function(e) {
                var sum = 0;
                $(this).closest('tr').find('.credit-amount').val(0);
                sumDebit();
                sumCredit();
            });
            $("body").on('focusout', '.credit-amount', function(e) {
                var sum = 0;
                $(this).closest('tr').find('.debit-amount').val(0);
                sumDebit();
                sumCredit();
            });

        });
        function updateStatus(debit, credit){
            if(debit != credit && debit <= 0 && credit <= 0){
                $('.save-entry').attr('disabled', true);
            }else{
                $('.save-entry').attr('disabled', false);
            }
        }

        function sumDebit(){
            var sum = 0;
            $(".debit-amount").each(function(){
                sum += +$(this).val();
            });
            $(".drTotal").text(sum.toLocaleString());
            $('#drTotalHidden').val(sum);
            if($('#drTotalHidden').val() != $('#crTotalHidden').val()){
                $('.save-entry').attr('disabled', true);
            }else{
                $('.save-entry').attr('disabled', false);
            }
        }
        function sumCredit(){
            var sum = 0;
            $(".credit-amount").each(function(){
                sum += +$(this).val();
            });
            $('#crTotalHidden').val(sum);
            $(".crTotal").text(sum.toLocaleString());
            if($('#drTotalHidden').val() != $('#crTotalHidden').val()){
                $('.save-entry').attr('disabled', true);
            }else{
                $('.save-entry').attr('disabled', false);
            }
        }

    </script>
<?= $this->endSection() ?>
