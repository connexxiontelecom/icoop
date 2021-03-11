<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Approve Journal Transfers
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Approve Journal Transfers
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Approve Journal Transfers
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
				<h2>Approve Journal Transfer</h2>
			
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th>#</th>
							<th>Staff ID</th>
							<th> Staff Name</th>
							<th> Date</th>
							<th> Amount </th>
							<th> Source</th>
							
							<th>Action</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $sn = 1; foreach ($jtms as $jtm): ?>
							<tr>
								
								<td><?=$sn; ?></td>
								<td><?=$jtm['jtm_staff_id']; ?></td>
								<td><?=$jtm['cooperator_first_name']." ".$jtm['cooperator_last_name']; ?></td>
								<td><?=$jtm['jtm_date']; ?></td>
								<td><?=number_format($jtm['jtm_amount'], 2); ?></td>
								<td><?=$jtm['contribution_type_name'] ?></td>
								
								<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#ApproveModal<?=$jtm['jtm_id'] ?>"><i class="fa fa-check"></i></button>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$jtm['jtm_id'] ?>"> <i class="fa fa-times"></i></button>
								
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
		
		
		<?php $sn = 1; foreach ($jtms as $jtm): ?>
			<div class="modal fade" id="ApproveModal<?=$jtm['jtm_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4" id="myLargeModalLabel">Approve Transfer</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" action="">
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Staff ID:</label>
											<input class="form-control" value="<?=$jtm['jtm_staff_id']; ?>" name="pg_name" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Staff Name:</label>
											<input class="form-control" value="<?=$jtm['cooperator_first_name']." ".$jtm['cooperator_last_name']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								
								<div class="row clearfix">
									<div class="col-lg-6 col-md-6">
								
										<div class="form-group">
											<label>Receipt Amount:</label>
											<input class="form-control" value="<?=number_format($jtm['jtm_amount']); ?>" disabled readonly>
										</div>
									</div>
									
									
									
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Source:</label>
											<input class="form-control" value="<?=$jtm['contribution_type_name'] ?> " disabled readonly>
										</div>
									</div>
									
								</div>
								
								<div class="row clearfix">
							
									
									<div class="col-lg-6 col-md-6">
										
										<div class="form-group">
											<label>Transaction Date:</label>
											<input class="form-control" value="<?=$jtm['jtm_date']; ?>" disabled readonly>
										</div>
									</div>
									
									
								
								</div>
								
								<div class="row clearfix">
									<div class="col-lg-12 col-md-12">
										
										<div class="form-group">
											<label>Target:</label>
											
										</div>
										
										
										<div class="table-responsive">
											<table class="table table-hover">
												<thead>
												<tr>
													<th>#</th>
													<th>Target</th>
													<th style="text-align: right">Amount</th>
												</tr>
												</thead>
												<tbody>
												
												<?php $t = 1; foreach ($jtm['target'] as $target):
													if($target['jtd_type'] == 1): //loan
													
													?>
												
												<tr>
													<td scope="row"><?=$t; ?></td>
													<td><?=$target['loan_description']; ?></td>
													<td style="text-align: right"><?=number_format($target['jtd_amount'], 2); ?></td>
													
												</tr>
												<?php  endif;
												
												if($target['jtd_type'] == 2): //loan
												?>
													
													<tr>
														<td scope="row"><?=$t; ?></td>
														<td><?=$target['contribution_type_name']; ?></td>
														<td style="text-align: right"><?=number_format($target['jtd_amount'], 2); ?></td>
													
													</tr>
												<?php endif;?>
											<?php $t++; endforeach; ?>
												</tbody>
												
											</table>
											
										</div>
									</div>
									
									
								
								</div>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="header">
											<p> <small><b>Initiated By:</b> <?=$jtm['jtm_by']; ?></small></p>
											<p><small><b>Date:</b> <?=$jtm['jtm_a_date']; ?></small></p>
										</div>
									</div>
								
								
								
								</div>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="header">
											<p> <small><b>Verified By:</b> <?=$jtm['jtm_verify_by']; ?></small></p>
											<p><small><b>Verified Date:</b> <?=$jtm['jtm_verify_date']; ?></small></p>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Verification Comments:</label>
											<textarea   cols="30" rows="3" placeholder="Comments " disabled class="form-control no-resize"> <?=$jtm['jtm_verify_comment']; ?></textarea>
										</div>
									</div>
								
								</div>
								
								<input type="hidden" name="jtm_status" value="2">
								
								<input type="hidden" name="jtm_id" value="<?=$jtm['jtm_id']; ?>">
								
								<div class="form-group">
									<label for="application_address">Comment:</label>
									<textarea name="jtm_approve_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
								</div>
								
								<?= csrf_field() ?>
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Approve</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		
		
		<?php $sn = 1; foreach ($jtms as $jtm): ?>
			<div class="modal fade" id="deleteModal<?=$jtm['jtm_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4" id="myLargeModalLabel">Disqualify Transfer</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" action="">
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Staff ID:</label>
											<input class="form-control" value="<?=$jtm['jtm_staff_id']; ?>" name="pg_name" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Staff Name:</label>
											<input class="form-control" value="<?=$jtm['cooperator_first_name']." ".$jtm['cooperator_last_name']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								
								<div class="row clearfix">
									<div class="col-lg-4 col-md-4">
										
										<div class="form-group">
											<label> Amount:</label>
											<input class="form-control" value="<?=number_format($jtm['jtm_amount']); ?>" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-2 col-md-2">
										
										<div class="form-group">
											<label>Transaction Date:</label>
											<input class="form-control" value="<?=$jtm['jtm_date']; ?>" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6">
										<div class="form-group">
											<label>Source:</label>
											<input class="form-control" value="<?=$jtm['contribution_type_name'] ?> " disabled readonly>
										</div>
									</div>
								
								</div>
								
								<div class="row clearfix">
									<div class="col-lg-12 col-md-12">
										
										<div class="form-group">
											<label>Target:</label>
										
										</div>
										
										
										<div class="table-responsive">
											<table class="table table-hover">
												<thead>
												<tr>
													<th>#</th>
													<th>Target</th>
													<th>Amount</th>
												</tr>
												</thead>
												<tbody>
												
												<?php $t = 1; foreach ($jtm['target'] as $target):
													if($target['jtd_type'] == 1): //loan
														
														?>
														
														<tr>
															<td scope="row"><?=$t; ?></td>
															<td><?=$target['loan_description']; ?></td>
															<td><?=number_format($target['jtd_amount'], 2); ?></td>
														
														</tr>
													<?php  endif;
													
													if($target['jtd_type'] == 2): //loan
														?>
														
														<tr>
															<td scope="row"><?=$t; ?></td>
															<td><?=$target['contribution_type_name']; ?></td>
															<td><?=number_format($target['jtd_amount'], 2); ?></td>
														
														</tr>
													<?php endif;?>
													<?php $t++; endforeach; ?>
												</tbody>
											
											</table>
										
										</div>
									</div>
								
								
								
								</div>
								
								
									<div class="row clearfix">
										<div class="col-lg-6 col-md-12">
											<div class="header">
												<p> <small><b>Initiated By:</b> <?=$jtm['jtm_by']; ?></small></p>
												<p><small><b>Date:</b> <?=$jtm['jtm_a_date']; ?></small></p>
											</div>
										</div>
									
									
									
									</div>
									<div class="row clearfix">
										<div class="col-lg-6 col-md-12">
											<div class="header">
												<p> <small><b>Verified By:</b> <?=$jtm['jtm_verify_by']; ?></small></p>
												<p><small><b>Verified Date:</b> <?=$jtm['jtm_verify_date']; ?></small></p>
											</div>
										</div>
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Verification Comments:</label>
											<textarea   cols="30" rows="3" placeholder="Comments " disabled class="form-control no-resize"> <?=$jtm['jtm_verify_comment']; ?></textarea>
										</div>
									</div>
								
								</div>
								<input type="hidden" name="jtm_status" value="3">
								
								<input type="hidden" name="jtm_id" value="<?=$jtm['jtm_id']; ?>">
								
								<div class="form-group">
									<label for="application_address">Comment:</label>
									<textarea name="jtm_discard_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
								</div>
								
								<?= csrf_field() ?>
								<div class="form-group">
									<button type="submit" class="btn btn-danger btn-block">Disqualify</button>
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
<script src="assets/js/pages/forms/form-wizajtd.js"></script>
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


