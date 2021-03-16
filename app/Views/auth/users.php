<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Users
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Users
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Users
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
				<h2>Users</h2>
				
				</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th>#</th>
							<th>Name</th>
							<th>Username</th>
							<th>Status</th>
							
							<th>Action</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $sn = 1; foreach ($users as $user): ?>
							<tr>
								
								<td><?=$sn; ?></td>
								<td><?=$user['first_name'].' '.$user['last_name']; ?></td>
								<td>@<kbd><?=$user['username']; ?></kbd></td>
								<td><?php if($user['user_status'] == 1): ?> <span class="badge badge-success">Active</span> <?php endif;
								
								if($user['user_status'] == 0):?> <span class="badge badge-danger">Inactive</span> <?php endif; ?></td>
								
								<td>
									<button type="button" class="btn btn-primary" onclick="location.href='<?php echo site_url('manage_user')."/".$user['user_id'];?>'"><i class="fa fa-eye"></i></button>

								</td>
							</tr>
							<?php $sn++; endforeach; ?>
						</tbody>
					</table>
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
<script>
    $(document).ready(function(){
        $('.simpletable').DataTable();
    });
</script>
<?= $this->endSection() ?>


