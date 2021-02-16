<?= $this->extend('layouts/master') ?>

<?= $this->section('title') ?>
View Loan Repayment Uploads
<?= $this->endSection() ?>

<?= $this->section('current_page') ?>
View Loan Reyapment Uploads
<?= $this->endSection() ?>
<?= $this->section('page_crumb') ?>
View Loan Repayment Uploads - <?=$loan_type['loan_description']; ?> For <small><?=$monthName." ,".$year; ?></small>
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
                <h2>View Loan Repayment Uploads - <?=$loan_type['loan_description']; ?> For <small><?=$monthName." ,".$year; ?></small>
            </div>
            <div class="body">
                <div class="table-responsive">
                    <table class="table table-hover js-basic-example dataTable simpletable table-custom spacing5">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Staff ID</th>
							<th>Staff Name</th>
							<th> Date </th>
							<th> Narration </th>
                            <th> Amount</th>
							<th> Remarks</th>
                            <th> Ref Code</th>
							
                           
                        </tr>
                        </thead>

                        <tbody>
                        <?php $sn = 1; foreach ($temp_lrs as $temp_lr): ?>
                            <?php
                            $color = 'white';
                            if($temp_lr['temp_lr_status'] == 1){ $color = '#ffcccb'; }
                            if($temp_lr['temp_lr_status'] == 2){ $color = '#f5ea61'; }
                            ?>
                            <tr style="background-color: <?php echo $color; ?>">

                                <td><?=$sn; ?></td>
                                <td><?=$temp_lr['temp_lr_staff_id']; ?></td>
								<td><?=$temp_lr['temp_lr_staff_name']; ?></td>
								<td><?=$temp_lr['temp_lr_transaction_date']; ?></td>
								<td><?=$temp_lr['temp_lr_narration']; ?></td>
                                <td style="text-align: right;"><?=number_format($temp_lr['temp_lr_amount'], 2); ?></td>
								<td><?php if($temp_lr['temp_lr_status'] == 1){ echo "Member Does Not Exist"; }
			                            if($temp_lr['temp_lr_status'] == 2){ echo "Member does not have an active loan running"; } ?></td>
	
								<td><?=$temp_lr['temp_lr_ref_code']; ?></td>
								
                            </tr>

                            <?php $sn++; endforeach; ?>
                        </tbody>
                    </table>
	
					<form method="post" action="<?=base_url('p_lr_upload') ?>">
		                <?= csrf_field() ?>
						<fieldset>
							<div class="row clearfix">
								<div class="col-lg-6 col-md-12 offset-3">
									<div class="form-group">
										<div class="form-row">
											<div class="col-md-6">
												<button type="submit" class="btn btn-primary btn-block">Process Upload</button>
											</div>
							
											<div class="col-md-6">
												<button type="button" onclick="location.href='<?php echo base_url('cancel_lr');?>'" class="btn btn-danger btn-block">Cancel Upload</button>
											</div>
						
										</div>
									</div>
								</div>
							</div>
					</form>

                
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

