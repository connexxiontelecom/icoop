<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Approve Loans Reconciliations
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Approve Loans Reconciliations
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Approve Loans Reconciliations
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
				<h2>Approve Loans Reconciliations</h2>
			
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th>#</th>
							<th>Staff ID</th>
							<th> Staff Name</th>
							<th>Ref Code </th>
							<th> Contribution Type</th>
							<th> Transaction Type </th>
							<th style="text-align: right"> Amount</th>
							<th>Date</th>
							
							<th>Action</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $sn = 1; foreach ($reconciliations as $reconciliation): ?>
							<tr>
								
								<td><?=$sn; ?></td>
								<td><?=$reconciliation['re_staff_id']; ?></td>
								<td><?=$reconciliation['cooperator_first_name']." ".$reconciliation['cooperator_last_name']; ?></td>
								<td><?=$reconciliation['re_ref_no']; ?></td>
								<td><?=$reconciliation['loan_description']; ?></td>
								<td> <?php if($reconciliation['re_dctype'] == 1): echo 'Credit'; endif; if($reconciliation['re_dctype'] == 2): echo 'Debit'; endif; ?> </td>
								<td style="text-align: right"><?=number_format($reconciliation['re_amount']); ?></td>
								<td><?=$reconciliation['re_date']; ?></td>
								
								<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ApproveModal<?=$reconciliation['re_id'] ?>"><i class="fa fa-check"></i></button>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$reconciliation['re_id'] ?>"> <i class="fa fa-times"></i></button>
								
								</td>
							</tr>
							<?php $sn++; endforeach; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	
	<div class="col-sm-3">
		
		
		<?php $sn = 1; foreach ($reconciliations as $reconciliation): ?>
			<div class="modal fade" id="ApproveModal<?=$reconciliation['re_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4" id="myLargeModalLabel">Approve Reconciliation - <?php if($reconciliation['re_dctype'] == 2): echo 'Debit Transaction'; endif; if($reconciliation['re_dctype'] == 1): echo 'Credit Transaction'; endif; ?></h5>
							
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						
						<div class="modal-body">
							<p> <b>Ref Code: </b>  <kbd><?=$reconciliation['re_ref_no']; ?></kbd></p>
							<form method="post" action="">
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label><b>Staff ID:</b></label>
											<input class="form-control" value="<?=$reconciliation['re_staff_id']; ?>" name="pg_name" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label><b>Staff Name:</b></label>
											<input class="form-control" value="<?=$reconciliation['cooperator_first_name']." ".$reconciliation['cooperator_last_name']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label><b>Loan Type:</b></label>
											<input class="form-control" value="<?=$reconciliation['loan_description']; ?>" disabled readonly>
										</div>
									</div>
									
									
									<div class="col-lg-6 col-md-12">
										
										<div class="form-group">
											<label><b><?php if($reconciliation['re_dctype'] == 1): echo 'Account Debited'; endif; if($reconciliation['re_dctype'] == 2): echo 'Account Credited'; endif; ?>: </b></label>
											<input class="form-control" value="<?=$reconciliation['glcode'].' - '.$reconciliation['account_name']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label><b>Amount:</b></label>
									<input class="form-control" value="<?=number_format($reconciliation['re_amount']); ?>" disabled readonly>
								</div>
								
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label><b>MPR:</b></label>
											<input class="form-control" value="<?=number_format($reconciliation['re_mpr'], 2); ?>" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										
										<div class="form-group">
											<label><b>MPI:</b></label>
											<input class="form-control" value="<?=number_format($reconciliation['re_mi'], 2); ?>" disabled readonly>
										</div>
									</div>
								
								
								
								</div>
								<?php if(!empty($reconciliation['re_doc'])): ?>
									
									<div class="form-group">
										
										<button type="button" class="btn btn-primary mb-2" onclick="window.open('<?php echo base_url('.uploads/reconciliations')."/".$reconciliation['re_doc'];?>', '_blank')" ><i class="fa fa-paperclip"></i> <span>View Attachment</span></button>
									
									</div>
								
								<?php endif; ?>
								
								<input type="hidden" name="re_status" value="2">
								
								<input type="hidden" name="re_id" value="<?=$reconciliation['re_id']; ?>">
								
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="header">
											<p> <small><b>Initiated By:</b> <?=$reconciliation['re_by']; ?></small></p>
											<p><small><b>Date:</b> <?=$reconciliation['re_date']; ?></small></p>
										</div>
									</div>
									
									
								
								</div>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="header">
											<p> <small><b>Verified By:</b> <?=$reconciliation['re_verify_by']; ?></small></p>
											<p><small><b>Verified Date:</b> <?=$reconciliation['re_verify_date']; ?></small></p>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Verification Comments:</label>
											<textarea   cols="30" rows="3" placeholder="Comments " disabled class="form-control no-resize"> <?=$reconciliation['re_verify_comment']; ?></textarea>
										</div>
									</div>
								
								</div>
								
								
								<div class="form-group">
									<label for="application_address"><b>Approval Comment:</b></label>
									<textarea name="re_approved_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
								</div>
								
								<?= csrf_field() ?>
								<div class="form-group">
									<button type="submit" class="btn btn-info btn-block">Approve</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		
		
		<?php $sn = 1; foreach ($reconciliations as $reconciliation): ?>
			<div class="modal fade" id="deleteModal<?=$reconciliation['re_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4" id="myLargeModalLabel">Disqualify reconciliation - <?php if($reconciliation['re_dctype'] == 2): echo 'Debit Transaction'; endif; if($reconciliation['re_dctype'] == 1): echo 'Credit Transaction'; endif; ?></h5>
							
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<p> <b>Ref Code: </b>  <kbd><?=$reconciliation['re_ref_no']; ?></kbd></p>
							<form method="post" action="">
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label><b>Staff ID:</b></label>
											<input class="form-control" value="<?=$reconciliation['re_staff_id']; ?>" name="pg_name" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label><b>Staff Name:</b></label>
											<input class="form-control" value="<?=$reconciliation['cooperator_first_name']." ".$reconciliation['cooperator_last_name']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label><b>Loan Type:</b></label>
											<input class="form-control" value="<?=$reconciliation['loan_description']; ?>" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										
										<div class="form-group">
											<label><b><?php if($reconciliation['re_dctype'] == 1): echo 'Account Debited'; endif; if($reconciliation['re_dctype'] == 2): echo 'Account Credited'; endif; ?>: </b></label>
											<input class="form-control" value="<?=$reconciliation['glcode'].' - '.$reconciliation['account_name']; ?>" disabled readonly>
										</div>
									</div>
								
								
								
								</div>
								
								<div class="form-group">
									<label><b>Amount:</b></label>
									<input class="form-control" value="<?=number_format($reconciliation['re_amount']); ?>" disabled readonly>
								</div>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label><b>MPR:</b></label>
											<input class="form-control" value="<?=number_format($reconciliation['re_mpr'], 2); ?>" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										
										<div class="form-group">
											<label><b>MPI:</b></label>
											<input class="form-control" value="<?=number_format($reconciliation['re_mi'], 2); ?>" disabled readonly>
										</div>
									</div>
								
								
								
								</div>
								<?php if(!empty($reconciliation['re_doc'])): ?>
									
									<div class="form-group">
										
										<button type="button" class="btn btn-primary mb-2" onclick="window.open('<?php echo base_url('.uploads/reconciliations')."/".$reconciliation['re_doc'];?>', '_blank')" ><i class="fa fa-paperclip"></i> <span>View Attachment</span></button>
									
									</div>
								
								<?php endif; ?>
								
								<input type="hidden" name="re_status" value="3">
								
								<input type="hidden" name="re_id" value="<?=$reconciliation['re_id']; ?>">
								
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="header">
											<p> <small><b>Initiated By:</b> <?=$reconciliation['re_by']; ?></small></p>
											<p><small><b>Date:</b> <?=$reconciliation['re_date']; ?></small></p>
										</div>
									</div>
								
								
								
								</div>
								
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="header">
											<p> <small><b>Verified By:</b> <?=$reconciliation['re_verify_by']; ?></small></p>
											<p><small><b>Verified Date:</b> <?=$reconciliation['re_verify_date']; ?></small></p>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Verification Comments:</label>
											<textarea   cols="30" rows="3" placeholder="Comments " disabled class="form-control no-resize"> <?=$reconciliation['re_verify_comment']; ?></textarea>
										</div>
									</div>
								
								</div>
								
								<div class="form-group">
									<label for="application_address"><b>Comment:</b></label>
									<textarea name="re_discard_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
								</div>
								
								<?= csrf_field() ?>
								<div class="form-group">
									<button type="submit" class="btn btn-danger btn-block">Disapprove</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	
	
	
	
	
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
    $(document).ready(function(){
        $('.simpletable').DataTable();
    });
</script>
<?= $this->endSection() ?>



