<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Savings Exceptions
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Savings Exceptions
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Saving Exceptions
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
				<h2>Savings Exceptions</h2>
			
			</div>
			
			
			<div class="body">
				
				
				<form method="POST" enctype="multipart/form-data">
					
					<fieldset>
						<div class="row clearfix">
							<div class="col-lg-6 col-md-12">
								
								
								
								<div class="form-group">
									<?php $months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December'); ?>
									
									<label  for="application_payroll_group_id"> <b> Select Month: </b></label>
									
									<select class="custom-select" required name="month">
										
										<?php foreach ($months as $key => $month): ?>
											<option value="<?=$key ?>" <?php  if(date('n') == $key){ echo "selected";}?>> <?=$month; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								
								<div class="form-group">
									
									<label  for="application_payroll_group_id"> <b>Year: </b></label>
									
									<select class="custom-select" required name="year">
								
										<?php foreach ($years as $year): ?>
											<option value="<?=$year['exception_year'] ?>"> <?=$year['exception_year']; ?></option>
										<?php endforeach; ?>
									</select>
								</div>
								
								<?= csrf_field() ?>
								<div class="form-group">
									<button type="submit" class="btn btn-info btn-block">Retrieve</button>
								</div>
							</div>
						
						
						</div>
					</fieldset>
				
				
				</form>
			
			</div>
		
		
		
		
		</div>
		
		<?php if(!empty($check)): ?>
			<div class="col-lg-12">
				<div class="card">
					
					
					<div class="header">
						<h2>Exceptions for  <?=$m; ?>,  <?=$y; ?></h2>
						<ul class="header-dropdown dropdown">
							
							<li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
						
						</ul>
						
						
					</div>
					<div class="body">
						<div class="table-responsive">
							<?php  if(!empty($exceptions)): ?>
								<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
									<thead>
									<tr>
										<th><strong># </strong></th>
										<th><strong>Staff Id</strong></th>
										<th><strong>Name</strong></th>
										<th><strong>Transaction Date</strong></th>
										<th style="text-align: right"><strong>Amount</strong></th>
										<th><strong>Comments</strong></th>
									
									
									
									</tr>
									</thead>
									
									<tbody>
									
									<?php $sn = 1;
										
										foreach ($exceptions as $exception): ?>
											<tr>
												
												<td><?=$sn; ?></td>
												<td><?=$exception['exception_staff_id']; ?></td>
												<td><?=$exception['exception_staff_name']; ?></td>
												<td><?=$exception['exception_transaction_date']; ?></td>
												<td style="text-align: right"><?=number_format($exception['exception_amount']); ?></td>
												<td><?=$exception['exception_reason']; ?></td>
											
											
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

<?= $this->endSection() ?>
