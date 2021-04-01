<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Savings Report
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Savings Report
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Savings Report
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>


<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/bootstrap-datepicker3.min.css">


<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>Savings Report - View Report</h2>
			
			</div>
			
			
			<div class="body">
				<?php if(!empty($contribution_types)): ?>
					
					<form method="POST" enctype="multipart/form-data">
						
						<fieldset>
							<div class="row clearfix">
								<div class="col-lg-6 col-md-12">
									
									
									<div class="form-group">
										
										<label  for="application_payroll_group_id"> <b> Contribution Type: </b></label>
										
										<select class="custom-select" required name="ct_id">
											
											<?php foreach ($contribution_types as $ct): ?>
												<option value="<?=$ct['contribution_type_id'] ?>"> <?=$ct['contribution_type_name']; ?></option>
											<?php endforeach; ?>
										</select>
									</div>
									
									<div class="form-group">
										
										
											<label>Range</label>
											<div class="input-daterange input-group">
												<input type="date" class="input-sm form-control" name="start">
												<span class="input-group-addon range-to">to</span>
												<input type="date" class="input-sm form-control" name="end">
											</div>
								
									</div>
									
									<?= csrf_field() ?>
									<div class="form-group">
										<button type="submit" class="btn btn-info">Retrieve</button>
									</div>
								</div>
							
							
							</div>
						</fieldset>
					
					
					</form>
				<?php else: ?>
					
					<p> No Contribution Type Setup</p>
				
				<?php endif; ?>
			
			</div>
		
		
		
		
		</div>
		
		<?php if(!empty($check)): ?>
			<div class="col-lg-12">
				<div class="card">
					
					
					<div class="header">
						<h2>Savings Report for (<?=$ct_dt['contribution_type_name']; ?>) - </h2>
						<ul class="header-dropdown dropdown">
							
							<li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
						
						</ul>
						
						<ul class="list-unstyled">
							<li class="m-b-15">
								<div><kbd>Period:</kbd> <small><?=$from. ' - '. $to; ?></small></div>
							
							</li>
						
						
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
							<?php  if(!empty($ledgers)): ?>
								<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
									<thead>
									<tr>
										<th><strong># </strong></th>
										<th><strong>Staff ID</strong></th>
										<th><strong>Name</strong></th>
										<th style="text-align: right"><strong>BF</strong></th>
										<th style="text-align: right"><strong>Period DR</strong></th>
										<th style="text-align: right"><strong>Period CR</strong></th>
										<th style="text-align: right"><strong>Period Balance</strong></th>
										<th style="text-align: right"><strong> Balance</strong></th>
										
									
									
									
									
									</tr>
									</thead>
									
									<tbody>
								
									<?php $sn = 1;
										
										foreach ($ledgers as $ledger): ?>
											<tr>
												
												<td><?=$sn; ?></td>
												<td><?=$ledger['staff_id']; ?></td>
												<td><?=$ledger['name']; ?></td>
												<td style="text-align: right"><?=number_format($ledger['bf'], 2); ?></td>
												<td style="text-align: right"><?=number_format($ledger['total_dr'], 2); ?></td>
												<td style="text-align: right"><?=number_format($ledger['total_cr'], 2); ?></td>
												<td style="text-align: right"><?=number_format($ledger['balance'], 2); ?></td>
												<td style="text-align: right"><?=number_format($ledger['balance'] + $ledger['bf'], 2); ?></td>
												
												
											
											
											</tr>
											<?php $sn++; endforeach; ?>
									
									
									</tbody>
								</table>
							<?php  else:
								
								echo "No data Available";
							endif; ?>
						</div>
					</div>
				
				</div>
			</div>
		<?php endif; ?>
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

<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script><!-- Bootstrap Colorpicker Js -->
<script src="assets/vendor/jquery-inputmask/jquery.inputmask.bundle.js"></script><!-- Input Mask Plugin Js -->
<script src="assets/vendor/jquery.maskedinput/jquery.maskedinput.min.js"></script>
<script src="assets/vendor/multi-select/js/jquery.multi-select.js"></script><!-- Multi Select Plugin Js -->
<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script><!-- Bootstrap Tags Input Plugin Js -->

<?= $this->endSection() ?>
