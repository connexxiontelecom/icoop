<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Verify Receipts
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Verify Receipts
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Verify Receipts
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
				<h2>Verify Receipts</h2>
			
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
							<th> Bank</th>
							
							<th>Action</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $sn = 1; foreach ($rms as $rm): ?>
							<tr>
								
								<td><?=$sn; ?></td>
								<td><?=$rm['rm_staff_id']; ?></td>
								<td><?=$rm['cooperator_first_name']." ".$rm['cooperator_last_name']; ?></td>
								<td><?=$rm['rm_date']; ?></td>
								<td><?=number_format($rm['rm_amount'], 2); ?></td>
								<td><?=$rm['bank_name'] ?> - <?=$rm['branch']; ?></td>
								
								<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#verifyModal<?=$rm['rm_id'] ?>"><i class="fa fa-check"></i></button>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$rm['rm_id'] ?>"> <i class="fa fa-times"></i></button>
								
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
		
		
		<?php $sn = 1; foreach ($rms as $rm): ?>
			<div class="modal fade" id="verifyModal<?=$rm['rm_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4" id="myLargeModalLabel">Verify Receipt</h5>
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
											<input class="form-control" value="<?=$rm['rm_staff_id']; ?>" name="pg_name" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Staff Name:</label>
											<input class="form-control" value="<?=$rm['cooperator_first_name']." ".$rm['cooperator_last_name']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								
								<div class="row clearfix">
									<div class="col-lg-6 col-md-6">
								
										<div class="form-group">
											<label>Receipt Amount:</label>
											<input class="form-control" value="<?=number_format($rm['rm_amount']); ?>" disabled readonly>
										</div>
									</div>
									
									
									
									<div class="col-lg-6 col-md-6">
										
										<div class="form-group">
											<label>Bank:</label>
											<input class="form-control" value="<?=$rm['bank_name'] ?> - <?=$rm['branch']; ?>" disabled readonly>
										</div>
									</div>
									
								</div>
								
								<div class="row clearfix">
									
									
									<div class="col-lg-6 col-md-6">
										
										<div class="form-group">
											<label>Transaction Date:</label>
											<input class="form-control" value="<?=$rm['rm_date']; ?>" disabled readonly>
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
												
												<?php $t = 1; foreach ($rm['target'] as $target):
													if($target['rd_type'] == 1): //loan
													
													?>
												
												<tr>
													<td scope="row"><?=$t; ?></td>
													<td><?=$target['loan_description']; ?></td>
													<td><?=number_format($target['rd_amount'], 2); ?></td>
													
												</tr>
												<?php  endif;
												
												if($target['rd_type'] == 2): //loan
												?>
													
													<tr>
														<td scope="row"><?=$t; ?></td>
														<td><?=$target['contribution_type_name']; ?></td>
														<td><?=number_format($target['rd_amount'], 2); ?></td>
													
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
											<p> <small><b>Received By:</b> <?=$rm['rm_by']; ?></small></p>
											<p><small><b>Receipt Date:</b> <?=$rm['rm_a_date']; ?></small></p>
										</div>
									</div>
									
									
								
								</div>
								
								<input type="hidden" name="rm_status" value="1">
								
								<input type="hidden" name="rm_id" value="<?=$rm['rm_id']; ?>">
								
								<div class="form-group">
									<label for="application_address">Comment:</label>
									<textarea name="rm_verify_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
								</div>
								
								<?= csrf_field() ?>
								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-block">Verify</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
		
		
		<?php $sn = 1; foreach ($rms as $rm): ?>
			<div class="modal fade" id="deleteModal<?=$rm['rm_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4" id="myLargeModalLabel">Disqualify Receipt</h5>
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
											<input class="form-control" value="<?=$rm['rm_staff_id']; ?>" name="pg_name" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Staff Name:</label>
											<input class="form-control" value="<?=$rm['cooperator_first_name']." ".$rm['cooperator_last_name']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								
								<div class="row clearfix">
									<div class="col-lg-4 col-md-4">
										
										<div class="form-group">
											<label>Receipt Amount:</label>
											<input class="form-control" value="<?=number_format($rm['rm_amount']); ?>" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-2 col-md-2">
										
										<div class="form-group">
											<label>Date:</label>
											<input class="form-control" value="<?=$rm['rm_date']; ?>" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-6">
										
										<div class="form-group">
											<label>Bank:</label>
											<input class="form-control" value="<?=$rm['bank_name'] ?> - <?=$rm['branch']; ?>" disabled readonly>
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
												
												<?php $t = 1; foreach ($rm['target'] as $target):
													if($target['rd_type'] == 1): //loan
														
														?>
														
														<tr>
															<td scope="row"><?=$t; ?></td>
															<td><?=$target['loan_description']; ?></td>
															<td><?=number_format($target['rd_amount'], 2); ?></td>
														
														</tr>
													<?php  endif;
													
													if($target['rd_type'] == 2): //loan
														?>
														
														<tr>
															<td scope="row"><?=$t; ?></td>
															<td><?=$target['contribution_type_name']; ?></td>
															<td><?=number_format($target['rd_amount'], 2); ?></td>
														
														</tr>
													<?php endif;?>
													<?php $t++; endforeach; ?>
												</tbody>
											
											</table>
										
										</div>
									</div>
								
								
								
								</div>
								
								
								<input type="hidden" name="rm_status" value="3">
								
								<input type="hidden" name="rm_id" value="<?=$rm['rm_id']; ?>">
								
								<div class="form-group">
									<label for="application_address">Comment:</label>
									<textarea name="rm_discard_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
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


