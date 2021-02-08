<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Loans - <?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?>
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Loans - <?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?>
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Loans - <small> <?=$cooperator->cooperator_staff_id; ?> </small>
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
				<h2>Outstanding Loans - View Ledger</h2>
			
			</div>
			
			
			<div class="body">
				
				
				<div class="col-lg-12">
					
					<div class="header">
						<h2>View Ledger (<?=$ls['loan_description']; ?>)</h2>
					
					</div>
					<div class="body">
						<div class="table-responsive">
							<?php  if(!empty($ledgers)): ?>
								<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
									<thead>
									<tr>
										<th><strong># </strong></th>
										<th><strong>Date</strong></th>
										<th><strong>Narration</strong></th>
										<th><strong>Dr</strong></th>
										<th><strong>Cr</strong></th>
										<th><strong>Balance</strong></th>
									
									
									
									</tr>
									</thead>
									
									<tbody>
									<?php if($bf > 0): ?>
										<tr>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td> <strong>BF:</strong> <?=number_format($bf); ?></td>
										</tr>
									
									<?php endif; ?>
									
									
									<?php $sn = 1;
										$total_cr = 0;
										$total_dr = 0;
										if($bf == 0):
											$bf = $ledgers[0]['amount'];
											$total_dr = $ledgers[0]['amount'];
											?>
											
											
											
											<tr>
												<td> # </td>
												<td><?=$ledgers[0]['disburse_date']; ?></td>
												<td><?="Loan Disbursed"; ?></td>
												<td><?=$ledgers[0]['amount']; ?></td>
												<td>0</td>
												<td> <?=number_format($ledgers[0]['amount'], 2); ?></td>
											</tr>
										
										
										<?php				endif;
									
									?>
									
									
									<?php    foreach ($ledgers as $ledger): ?>
										<tr>
											
											<td><?=$sn; ?></td>
											<td><?=$ledger['lr_date']; ?></td>
											<td><?=$ledger['lr_narration']; ?></td>
											
											<td><?php
													if($ledger['lr_dctype'] == 2):
														$dr = $ledger['lr_amount'];
														$cr = 0;
														$total_dr = $bf + $dr + $total_dr;
														
														echo number_format($ledger['lr_amount'], 2);
													
													else:
														echo '0';
													
													endif;
												
												?></td>
											<td>
												<?php
													if($ledger['lr_dctype'] == 1):
														
														$cr = $ledger['lr_amount'];
														$dr = 0;
														$total_cr = $cr + $total_cr;
														
														echo number_format($ledger['lr_amount'], 2);
													
													else:
														echo '0';
													
													endif;
												
												?>
											</td>
											
											<td>
												<?php $bf = ($bf + $dr) - $cr;
													echo number_format($bf, 2);
												?>
											
											</td>
										
										
										</tr>
										<?php $sn++; endforeach; ?>
									
									<tr>
										<td></td>
										<td></td>
										<td></td>
										<td><strong>Total:</strong> <?=number_format( $total_dr, 2); ?></td>
										<td><strong>Total:</strong> <?=number_format($total_cr, 2 ); ?></td>
										<td> <strong>Balance:</strong> <?=number_format($total_dr - $total_cr, 2); ?></td>
									</tr>
									</tbody>
								</table>
							<?php  else:
								
								echo "No data Available";
							endif; ?>
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
