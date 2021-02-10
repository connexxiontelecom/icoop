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
	<div class="card">
		<div class="header">
			<h2>Loan Ledger</h2>
				<ul class="header-dropdown dropdown">
				
				<li><a href="javascript:void(0);" class="full-screen"><i class="icon-frame"></i></a></li>
			
			</ul>
		</div>
		<div class="body">
			
			
			<div class="row">
				<div class="col-sm-4">
					<ul class="list-unstyled">
						<li class="m-b-15">
							<div><kbd>Staff ID:</kbd> <small><?=$cooperator->cooperator_staff_id; ?></small></div>
							
												</li>
						<li class="m-b-15">
							<div><kbd>Name:</kbd> <small><?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?></small>
							</div>
							
						</li>
						<li class="m-b-15">
							<div><kbd> Total Savings:</kbd> <small><?=number_format($savings, 2) ?></small></div>
							
						
						</li>
						
						<li class="m-b-15">
							<div><kbd>Bank Details:</kbd> <small><?=$cooperator->bank_name.' ['.$cooperator->cooperator_account_number.']'; ?></small>
							</div>
						
						</li>
						
						<li class="m-b-15">
							<div><kbd>Total Encumbered Savings:</kbd> <small><?=number_format('0', 2); ?></small></div>
						
						</li>
						<li class="m-b-15">
							<div><kbd>Encumbered Amount:</kbd> <small><?=0 ?></small>
							</div>
						
						</li>
						
					</ul>
				</div>
				<div class="col-sm-4">
					<ul class="list-unstyled">
						<li class="m-b-15">
							<div><kbd>Loan Type:</kbd> <small><?=$loan_details->loan_description; ?></small></div>
						
						</li>
						<li class="m-b-15">
							<div><kbd>Loan Principal:</kbd> <small><?=number_format($loan_details->amount, 2); ?></small></div>
						
						</li>
						
						<li class="m-b-15">
							<div><kbd>Interest Rate:</kbd> <small><?=$loan_details->ls_interest_rate; ?></small>
							</div>
						
						</li>
						
						<li class="m-b-15">
							<div><kbd> Expected Interest:</kbd> <small><?=0 ?></small></div>
						
						
						</li>
						
						<li class="m-b-15">
							<div><kbd> Payment Duration:</kbd> <small><?=$loan_details->duration." "; ?>Month(s)</small></div>
						
						
						</li>
						<li class="m-b-15">
							<div><kbd> New Duration:</kbd> <small><?=0; ?></small>
							</div>
						
						</li>
						
						
					</ul>
				</div>
				<div class="col-sm-4">
					<ul class="list-unstyled">
						
						<li class="m-b-15">
							<div><kbd> Application Date:</kbd> <small><?=$loan_details->applied_date; ?></small>
							</div>
						
						</li>
						
						<li class="m-b-15">
							<div><kbd>Verified Date:</kbd> <small><?=$loan_details->verify_date; ?></small></div>
						
						</li>
						<li class="m-b-15">
							<div><kbd>Verified By:</kbd> <small><?=0 ?></small></div>
						
						</li>
						<li class="m-b-15">
							<div><kbd>Approved Date:</kbd> <small><?=$loan_details->approve_date; ?></small>
							</div>
						
						</li>
						
						
						<li class="m-b-15">
							<div><kbd>Approved By:</kbd> <small><?=0 ?></small>
							</div>
						
						</li>
						
						<li class="m-b-15">
							<div><kbd> Disbursed Date:</kbd> <small><?=$loan_details->disburse_date; ?></small></div>
						
						
						</li>
						<li class="m-b-15">
							<div><kbd> Loan Start Date:</kbd> <small><?=$loan_details->disburse_date; ?></small></div>
						
						
						</li>
						
					</ul>
				</div>
				
				
			</div>
		
			
		
			
			<div class="table-responsive">
				<?php  if(!empty($ledgers)): ?>
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th><strong># </strong></th>
							<th><strong>Date</strong></th>
							<th><strong>Narration</strong></th>
							<th style="text-align: right"><strong>Dr</strong></th>
							<th style="text-align: right"><strong>Cr</strong></th>
							<th style="text-align: right"><strong>Balance</strong></th>
						
						
						
						</tr>
						</thead>
						
						<tbody>
						
						
						
						<?php $sn = 1;
							$total_cr = 0;
							$total_dr = 0;
							
							
							foreach ($ledgers as $ledger):
								
								$total_dr = $ledger->amount;
								$disbursed_date = $ledger->disburse_date;
								$bf = $ledger->amount;
							
							endforeach;
						
						?>
						
						
						
						<tr>
							<td> # </td>
							<td><?=$disbursed_date; ?></td>
							<td><?="Loan Disbursed"; ?></td>
							<td style="text-align: right"><?=number_format($total_dr, 2); ?></td>
							<td style="text-align: right"><?=number_format(0, 2); ?></td>
							<td style="text-align: right"> <?=number_format($total_dr, 2); ?></td>
						</tr>
						
						
						
						<?php    foreach ($ledgers as $ledger): ?>
							<tr>
								
								<td><?=$sn; ?></td>
								<td><?=$ledger->lr_date; ?></td>
								<td><?=$ledger->lr_narration; ?></td>
								
								<td style="text-align: right"><?php
										if($ledger->lr_dctype == 2):
											$dr = $ledger->lr_amount;
											$cr = 0;
											$total_dr = $dr + $total_dr;
											
											echo number_format($ledger->lr_amount, 2);
										
										else:
											echo number_format(0, 2);
										
										endif;
									
									?></td>
								<td style="text-align: right">
									<?php
										if($ledger->lr_dctype == 1):
											
											$cr = $ledger->lr_amount;
											$dr = 0;
											$total_cr = $cr + $total_cr;
											
											echo number_format($ledger->lr_amount, 2);
										
										else:
											echo number_format(0, 2);
										
										endif;
									
									?>
								</td>
								
								<td style="text-align: right">
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
							<td style="text-align: right"><strong>Total:</strong> <?=number_format( $total_dr, 2); ?></td>
							<td style="text-align: right"><strong>Total:</strong> <?=number_format($total_cr, 2 ); ?></td>
							<td style="text-align: right"> <strong>Balance:</strong> <?=number_format($total_dr - $total_cr, 2); ?></td>
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
