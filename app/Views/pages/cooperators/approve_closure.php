<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Approve Account Closure
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Approve Account Closure
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Approve Account Closure
<?= $this->endSection() ?>

<?= $this->section('extra-styles') ?>


<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedcolumns.bootstrap4.min.css">
<link rel="stylesheet" href="assets/vendor/jquery-datatable/fixedeader/dataTables.fixedheader.bootstrap4.min.css">

<link rel="stylesheet" href="assets/vendor/sweetalert/sweetalert.css"/>

<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row clearfix">
	<div class="col-lg-12">
		<div class="card">
			<div class="header">
				<h2>Approve Account Closure</h2>
			
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th>#</th>
							<th>Staff ID</th>
							<th> Staff Name</th>
							<th> Date </th>
							
							
							<th>Action</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $sn = 1; foreach ($acs as $ac): ?>
							<tr>
								
								<td><?=$sn; ?></td>
								<td><?=$ac['ac_staff_id']; ?></td>
								<td><?=$ac['cooperator_first_name']." ".$ac['cooperator_last_name']; ?></td>
								<td><?=$ac['ac_a_date']; ?></td>
								
								
								<td>
									<button type="button" class="btn btn-success" data-toggle="modal" data-target="#approveModal<?=$ac['ac_id'] ?>"><i class="fa fa-check"></i></button>
									<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$ac['ac_id'] ?>"> <i class="fa fa-times"></i></button>
								
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
		
		
		<?php $sn = 1; foreach ($acs as $ac): ?>
			<div class="modal fade" id="approveModal<?=$ac['ac_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4" id="myLargeModalLabel">approve Account Closure</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">×</span>
							</button>
						</div>
						<div class="modal-body">
							<form method="post" id="approveForm<?=$ac['ac_id']; ?>" action="">
								<div class="row clearfix">
									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>Staff ID:</label>
											<input class="form-control" value="<?=$ac['ac_staff_id']; ?>"  disabled readonly>
										</div>
									</div>
									<input type="hidden" name="ac_staff_id" value="<?=$ac['ac_staff_id']; ?>">
									
								</div>
								
								<div class="row clearfix">
									
									
									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>Staff Name:</label>
											<input class="form-control" value="<?=$ac['cooperator_first_name']." ".$ac['cooperator_last_name']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								<div class="row clearfix">
									
									
									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>Effective Date:</label>
											<input class="form-control" value="<?=$ac['ac_effective_date']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								<div class="row clearfix">
									
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Phone Number:</label>
											<input class="form-control" value="<?=$ac['ac_phone']; ?>" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Email:</label>
											<input class="form-control" value="<?=$ac['ac_email']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								
								<div class="row clearfix">
									<div class="col-lg-12 col-md-12">
										<div class="header">
											<p> <small><b>Initiated By:</b> <?=$ac['ac_by']; ?></small></p>
											<p><small><b> Date:</b> <?=$ac['ac_a_date']; ?></small></p>
										</div>
									</div>
								
								
								
								</div>
								
								<div class="row clearfix">
									<div class="col-lg-12 col-md-12">
										<div class="header">
											<p> <small><b>Verified By:</b> <?=$ac['ac_verify_by']; ?></small></p>
											<p><small><b> Date:</b> <?=$ac['ac_verify_date']; ?></small></p>
										</div>
									</div>
								
								
								
								</div>
								
								<input type="hidden" name="ac_status" value="2">
								
								<input type="hidden" name="ac_id" value="<?=$ac['ac_id']; ?>">
								
								<div class="form-group">
									<label for="application_address">Comment:</label>
									<textarea name="ac_approve_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
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
		
		
		<?php $sn = 1; foreach ($acs as $ac): ?>
			<div class="modal fade" id="deleteModal<?=$ac['ac_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title h4" id="myLargeModalLabel">Disqualify Account Closure</h5>
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
											<input class="form-control" value="<?=$ac['ac_staff_id']; ?>" name="pg_name" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Staff Name:</label>
											<input class="form-control" value="<?=$ac['cooperator_first_name']." ".$ac['cooperator_last_name']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								<div class="row clearfix">
									
									
									<div class="col-lg-12 col-md-12">
										<div class="form-group">
											<label>Effective Date:</label>
											<input class="form-control" value="<?=$ac['ac_effective_date']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								
								<div class="row clearfix">
									
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Phone Number:</label>
											<input class="form-control" value="<?=$ac['ac_phone']; ?>" disabled readonly>
										</div>
									</div>
									
									<div class="col-lg-6 col-md-12">
										<div class="form-group">
											<label>Email:</label>
											<input class="form-control" value="<?=$ac['ac_email']; ?>" disabled readonly>
										</div>
									</div>
								</div>
								<div class="row clearfix">
									<div class="col-lg-6 col-md-12">
										<div class="header">
											<p> <small><b>Initiated By:</b> <?=$ac['ac_by']; ?></small></p>
											<p><small><b> Date:</b> <?=$ac['ac_a_date']; ?></small></p>
										</div>
									</div>
								
								
								
								</div>
								
								
								<div class="row clearfix">
									<div class="col-lg-12 col-md-12">
										<div class="header">
											<p> <small><b>Verified By:</b> <?=$ac['ac_verify_by']; ?></small></p>
											<p><small><b> Date:</b> <?=$ac['ac_verify_date']; ?></small></p>
										</div>
									</div>
								
								
								
								</div>
								
								<input type="hidden" name="ac_status" value="3">
								
								<input type="hidden" name="ac_id" value="<?=$ac['ac_id']; ?>">
								
								<div class="form-group">
									<label for="application_address">Comment:</label>
									<textarea name="ac_discarded_comment"   cols="30" rows="3" placeholder="Comments "  class="form-control no-resize"></textarea>
								</div>
								
								<?= csrf_field() ?>
								<div class="form-group">
									<button type="submit" class="btn btn-info btn-block">Discard</button>
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
<script src="assets/vendor/sweetalert/sweetalert.min.js"></script><!-- SweetAlert Plugin Js -->
<script>
    $(document).ready(function(){
        $('.simpletable').DataTable();
		
		<?php foreach ($acs as $ac): ?>
        $("#approveForm<?=$ac['ac_id']; ?>").submit(function (e) {

            e.preventDefault();

            swal({
                title: "Warning?",
                text: "This action is irreversible, it collapses all savings into one saving!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#dc3545",
                confirmButtonText: "Yes, Proceed!",
                closeOnConfirm: false
            }, function () {
                // swal("Deleted!", "Your imaginary file has been deleted.", "success");
				
				document.getElementById('approveForm<?=$ac['ac_id']; ?>').submit();
            });

            

            //console.log(payment_amount);


        });
        <?php endforeach; ?>
    });
</script>
<?= $this->endSection() ?>


