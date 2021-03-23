<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Loan Application 
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Loan Application
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Loan Application 
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
				<h2>Loan Application </h2>
			
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th>#</th>
							<th> Staff ID</th>
							<th> Staff Name</th>
							<th> Date</th>
							<th> Amount </th>							
							<th> Status</th>
						</tr>
						</thead>
						<tbody>
                        <?php $i =1; foreach($loans as $loan): ?>
                            <tr>
                                <td><?= $i++ ?></td>
                                <td><?= $loan->staff_id ?? '' ?></td>
                                <td><?= $loan->cooperator_first_name ?? '' ?> <?= $loan->cooperator_last_name ?? '' ?></td>
                                <td><?= date('d M, Y', strtotime($loan->applied_date)) ?></td>
                                <td><?= number_format($loan->amount,2) ?></td>
                                <td>
                                    <?php if($loan->verify == 0 && $loan->approve == 0) :  ?>
                                        Unverified
                                    <?php elseif($loan->verify == 1 && $loan->approve == 0): ?>
                                        Verified
                                    <?php elseif($loan->verify == 1 && $loan->approve == 1): ?>
                                        Approved
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
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
