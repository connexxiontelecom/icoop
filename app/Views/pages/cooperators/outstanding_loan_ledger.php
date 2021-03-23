<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Outstanding Loans - <?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?>
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Outstanding Loans - <?=$cooperator->cooperator_first_name.' '.$cooperator->cooperator_last_name; ?>
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Outstanding Loans - <small> <?=$cooperator->cooperator_staff_id; ?> </small>
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
                <h2>Outstanding Loans</h2>

            </div>
					
				<div class="card-body">
					<div class="col-lg-12">
					<div class="table-responsive">
				        <?php  if(!empty($ledgers)): ?>
							<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
								<thead>
								<tr>
									<th><strong>S/N </strong> </th>
									<th><strong>Loan Type </strong></th>
									<th style="text-align: right"><strong>Principal Amount</strong></th>
									<th style="text-align: right"><strong>Interest</strong></th>
									<th style="text-align: right"><strong>Amount Paid</strong></th>
								
									<th style="text-align: right"><strong>Outstanding</strong></th>
									<th style="text-align: right"><strong>Encumbered</strong></th>
									<th style="text-align: right"><strong>View</strong></th>
						
						
								</tr>
								</thead>
						
								<tbody>
						
						        <?php $sn =1;    foreach ($ledgers as $ledger): ?>
									<tr>
										<td><?=$sn; ?></td>
										<td><?=$ledger['loan_description']; ?></td>
										<td style="text-align: right"><?=number_format($ledger['loan_principal'], 2); ?></td>
										<td style="text-align: right"><?=number_format($ledger['loan_total_interest'], 2); ?></td>
										<td style="text-align: right"><?=number_format($ledger['loan_total_cr'], 2); ?></td>
										
										<td style="text-align: right"><?=number_format($ledger['loan_balance'], 2); ?>
										<td style="text-align: right"><?=number_format($ledger['loan_encumbrance'], 2) ?></td>
										<td> <form method="post">
												<input type="hidden" name="loan_year" value="a">
												<input type="hidden" name="loan_id" value="<?=$ledger['loan_type']; ?>">
										
												<button type="submit" class="btn btn-info btn-block"><i class="fa fa-eye"></i></button>
									
											</form></td>
							
							
							
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
