<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
Payment List
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
Payment List
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
Payment List
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
				<h2>Payment List</h2>
			
			</div>
			<div class="body">
				<div class="table-responsive">
					<table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
						<thead>
						<tr>
							<th>#</th>
							<th>Bank Name</th>
							<th> Account No.</th>
							<th> Amount </th>
							<th> GL</th>
							<th> Date</th>
							<th> Status</th>
							<th>Action</th>
						</tr>
						</thead>
						
						<tbody>
						<?php $sn = 1; foreach ($entries as $entry): ?>
							<tr>
								
								<td><?=$sn; ?></td>
								<td><?=$entry->bank_name ?? '' ?></td>
								<td><?=$entry->account_no ?? '' ?></td>
								<td class="text-right"><?= number_format($entry->entry_payment_amount ?? 0,2) ?></td>
								<td><?=$entry->glcode ?? '' ?></td>
								<td><?= !is_null($entry->entry_payment_payable_date) ? date('d-M-Y', strtotime($entry->entry_payment_payable_date)) : '-' ?></td>
								<td>
                                    <?php if($entry->entry_payment_approved == 1 && $entry->entry_payment_verified == 1) : ?>
                                        <label for="" class="badge badge-success">Paid</label>
                                    <?php endif; ?>
                                    <?php if($entry->entry_payment_approved == 0 && $entry->entry_payment_verified == 1) : ?>
                                        <label for="" class="badge badge-danger">Not paid</label>
                                    <?php endif; ?>
                                    <?php if($entry->entry_payment_approved == 0 && $entry->entry_payment_verified == 0) : ?>
                                        <label for="" class="badge badge-warning">Processing</label>
                                    <?php endif; ?>
                                </td>
								<td>
									<a href="<?= site_url('/third-party/payment-entry/'.$entry->third_party_payment_entry_id) ?>">View</a>
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


