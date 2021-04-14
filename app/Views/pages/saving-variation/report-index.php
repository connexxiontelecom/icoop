<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Report(Savings)
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Report(Savings)
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Report(Savings)
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
				<h2>Savings (Report)</h2>
			</div>
			
			
			<div class="col-md-12">
				
				<div class="row clearfix">
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?= site_url('/saving-variations/report') ?>">
								<div class="body">
									<div class="d-flex align-items-center">
										<div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="fa fa-briefcase"></i></div>
										<div class="ml-4">
											<span>Saving Variations Report</span>
										</div>
									</div>
								
								</div>
							</a>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?php echo base_url('savings_report'); ?>">
								
								<div class="body">
									
									<div class="d-flex align-items-center">
										<div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="icon-notebook"></i></div>
										<div class="ml-4">
											<span>Savings Balance Report</span>
										
										
										</div>
									</div>
								
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?php echo base_url('analysis_report'); ?>">
								
								<div class="body">
									
									<div class="d-flex align-items-center">
										<div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="icon-notebook"></i></div>
										<div class="ml-4">
											<span>Analysis Report</span>
										</div>
									</div>
								
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?php echo base_url('withdrawal_report'); ?>">
								
								<div class="body">
									
									<div class="d-flex align-items-center">
										<div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="icon-notebook"></i></div>
										<div class="ml-4">
											<span>Withdrawal Report</span>
										</div>
									</div>
								
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?php echo base_url('payroll_contribution_report'); ?>">
								
								<div class="body">
									
									<div class="d-flex align-items-center">
										<div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="icon-notebook"></i></div>
										<div class="ml-4">
											<span>Payroll Contribution Report</span>
										</div>
									</div>
								
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?php echo base_url('external_savings_report'); ?>">
								
								<div class="body">
									
									<div class="d-flex align-items-center">
										<div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="icon-notebook"></i></div>
										<div class="ml-4">
											<span>External Contribution Report</span>
										</div>
									</div>
								
								</div>
							</a>
						</div>
					</div>
					
					<div class="col-lg-4 col-md-6 col-sm-12">
						
						<div class="card">
							<a href="<?php echo base_url('journal_transfer_report'); ?>">
								
								<div class="body">
									
									<div class="d-flex align-items-center">
										<div class="icon-in-bg bg-indigo text-white rounded-circle"><i class="icon-notebook"></i></div>
										<div class="ml-4">
											<span>Journal Transfer Report</span>
										</div>
									</div>
								
								</div>
							</a>
						</div>
					</div>
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

<?= $this->endSection() ?>
